<?php
/**
* Copyright (c) 2014 Shine Software.
* All rights reserved.
*
* Redistribution and use in source and binary forms, with or without
* modification, are permitted provided that the following conditions
* are met:
*
* * Redistributions of source code must retain the above copyright
* notice, this list of conditions and the following disclaimer.
*
* * Redistributions in binary form must reproduce the above copyright
* notice, this list of conditions and the following disclaimer in
* the documentation and/or other materials provided with the
* distribution.
*
* * Neither the names of the copyright holders nor the names of the
* contributors may be used to endorse or promote products derived
* from this software without specific prior written permission.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
* "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
* LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
* FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
* COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
* INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
* BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
* LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
* CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
* LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
* ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
* POSSIBILITY OF SUCH DAMAGE.
*
* @package Cms
* @subpackage Model
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/

namespace Cms\Model;

class Layout {
	
	protected $page;
	protected $settings;
	protected $blocks;
	
	/**
	 * Layout Constructor
	 * 
	 * @param \Cms\Entity\Page $page
	 */
	public function __construct(\Cms\Entity\Page $page, \Base\Service\SettingsServiceInterface $settings){
		$this->page = $page;	
		$this->settings = $settings;	
	}
	
	/**
	 * Get the xml string and revert it as xml object
	 *  
	 * @param string $xml
	 * @return SimpleXMLElement or Null
	 */
	private function getXmlData($xml){
		
		if(!empty($xml)){
			return simplexml_load_string($xml);
		}
		
		return Null;
	}
	
	/**
	 * Get the blocks from the xml 
	 *  
	 * @param \SimpleXMLElement $xml
	 * @return multitype:
	 */
	public function getBlocks(){
		
		$xmlLayout = $this->getXmlData($this->page->getLayout());
		
		// Clear the array to avoid double results
		$this->blocks = array ();
		
		if(!empty($xmlLayout)){		
			// Adding all the commons blocks
			$xmlobject = $xmlLayout->xpath ( "default/commons/blocks" );
			$this->getBlockItems($xmlobject);
		}
		
		return $this->blocks;
	}
	
	
	
	/**
	 * Get the block items
	 *
	 * @param simple_xml $xmlobject
	 */
	private function getBlockItems($xmlobject) {
		$data = array ();
		$i = 0;
		if (count ( $xmlobject )) {
			foreach ( $xmlobject as $blocks ) {
				foreach ( $blocks->block as $block ) {
					$data [$i] ['block'] ['name'] = ( string ) $block;
					$data [$i] ['action'] = ( string ) $block ['action'];
					$data [$i] ['side'] = ( string ) $block ['side'];
					$data [$i] ['position'] = ( string ) $block ['position'];
					$i ++;
				}
			}
		}
	
		if (! empty ( $data ) && is_array ( $data )) {
			$this->blocks = array_merge ( $this->blocks, $data );
			return true;
		}
		return false;
	}
	
	/**
	 * Get template file from the xml configuration
	 *  
	 * @return string
	 */
	public function getTemplate(){
		
		$xmlLayout = $this->getXmlData($this->page->getLayout());
		
		$defaultLayout = $this->settings->getValueByParameter('Cms', 'defaultlayout');
		
		if(!empty($xmlLayout)){
			// Adding all the commons blocks
			$xmlobject = $xmlLayout->xpath ( "default" );
			
			if (! empty ( $xmlobject [0] ['layout'] )) {
				return ( string ) $xmlobject [0] ['layout'];
			}
		}
		
		return !empty($defaultLayout) ? $defaultLayout : "1column";
	}
	
}
?>