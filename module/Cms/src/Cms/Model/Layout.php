<?php
namespace Cms\Model;

class Layout {
	
	protected $page;
	protected $blocks;
	
	/**
	 * Layout Constructor
	 * 
	 * @param \Cms\Entity\Page $page
	 */
	public function __construct(\Cms\Entity\Page $page){
		$this->page = $page;	
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
				
		// Adding all the commons blocks
		$xmlobject = $xmlLayout->xpath ( "default/commons/blocks" );
		$this->getBlockItems($xmlobject);
		
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
		
		if(!empty($xmlLayout)){
			// Adding all the commons blocks
			$xmlobject = $xmlLayout->xpath ( "default" );
			
			if (! empty ( $xmlobject [0] ['template'] )) {
				return ( string ) $xmlobject [0] ['template'];
			}
		}
		
		return "1column";
	}
	
}
?>