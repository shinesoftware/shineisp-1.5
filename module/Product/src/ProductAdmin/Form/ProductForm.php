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
* @package Product
* @subpackage Form
* @author Michelangelo Turillo <mturillo@shinesoftware.com>
* @copyright 2014 Michelangelo Turillo.
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @link http://shinesoftware.com
* @version @@PACKAGE_VERSION@@
*/

namespace ProductAdmin\Form;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use Base\Hydrator\Strategy\DateTimeStrategy;

class ProductForm extends Form
{

    public function init ()
    {
        $hydrator = new ClassMethods();
        // $hydrator->addStrategy('createdat', new DateTimeStrategy());
        
        $this->setAttribute('method', 'post');
        $this->setHydrator($hydrator)->setObject(new \Product\Entity\Product());
        
        $this->add(array('type' => 'hidden', 'name' => 'type_id'));
        $this->add(array('type' => 'hidden', 'name' => 'attribute_set_id'));
        
        $this->add(
                array('name' => 'submit', 
                        'attributes' => array('type' => 'submit', 
                                'class' => 'btn btn-success', 
                                'value' => _('Save'))));
        $this->add(
                array('name' => 'id', 
                        'attributes' => array('type' => 'hidden')));
    }

    /**
     * Prepare the attribute form
     *
     * @param $attributes array           
     * @return \ProductAdmin\Form\ProductForm
     */
    public function createAttributesElements (array $attributes)
    {
    	$fieldset = new \Zend\Form\Fieldset('attributes');
//     	$fieldset->setHydrator(new ClassMethods())->setObject(new \Product\Entity\ProductAttributes());
    	
        foreach ($attributes as $attribute) {
            $code = $attribute->getCode();
            $label = $attribute->getLabel();
            $type = $attribute->getType() ? $attribute->getType() : "text";
            $fieldset->add(
                    array('type' => $type, 'name' => $code, 
                            'attributes' => array('class' => 'form-control'), 
                            'options' => array('label' => _($label))));
        }
        
        $this->add($fieldset);
        
        return $this;
    }
}