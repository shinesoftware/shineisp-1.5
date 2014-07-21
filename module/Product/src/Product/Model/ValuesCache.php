<?php
namespace Product\Model;

class ValuesCache
{
    protected $_data = array();

    public function setAttributeValue($entityId, $attributeId, $value)
    {
        $this->_data[$entityId][$attributeId] = $value;
    }

    public function hasAttributeValue($entityId, $attributeId)
    {
        return isset($this->_data[$entityId][$attributeId]);
    }

    public function getAttributeValue($entityId, $attributeId)
    {
        return $this->_data[$entityId][$attributeId];
    }

    public function toArray()
    {
        return $this->_data;
    }
}