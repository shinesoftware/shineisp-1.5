<?php
use Eav\Eav;

class EavProduct extends Eav
{
    protected $_entitiesTableFieldId = 'id'; // name of primary key of products table

    protected $_attributesTableName = 'attributes'; // name of 'attributes' table
    protected $_attributesTableFieldId   = 'attribute_id'; // name of primary key of attributes table
    protected $_attributesTableFieldType = 'attribute_type'; // field where attribute type is stored
    protected $_attributesTableFieldName = 'attribute_name'; // field where attribute name is stored
}