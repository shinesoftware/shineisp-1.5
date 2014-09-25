<?php
namespace Product\Model;

use Zend\Db\Adapter\Adapter,
    Zend\Db\TableGateway\TableGateway,
    Zend\Db\RowGateway\RowGateway,
    Zend\Db\TableGateway\Feature,
    Product\Model\ValuesCache;

/**
 * Eav class
 *
 * @author Taras Taday
 * @version 0.2.0
 */
class Eav
{
    /*
     * Name of primary table
     */
    protected $_entitiesTableName = 'eav_entity';
    protected $_entitiesTableFieldId = 'id';

    /*
     * Name of attribute table
     */
    protected $_attributesTableName = 'eav_attribute';
    protected $_attributesTableFieldId   = 'id';
    protected $_attributesTableFieldType = 'type';
    protected $_attributesTableFieldName = 'name';

    /**
     * Attributes table
     * @var TableGateway
     */
    protected $_attributesTable;
    protected $_attributes;

    /*
     * Eav TableGateway objects
     */
    protected $_eavTables = array();

    public function  __construct(TableGateway $table)
    {
        $this->_entitiesTable = $table;
        $this->_entitiesTableName = $this->getTableName($table);
        $this->_attributesTable = new TableGateway(
            $this->_attributesTableName, $table->getAdapter(), new Feature\RowGatewayFeature('id'));
    }

    public function getTableName($table)
    {
        return $table->getTable();
    }

    public function getTypeTableName($type)
    {
        return $this->_entitiesTableName . '_attributes_entity_' . strtolower($type);
    }

    public function getTypeTable($attribute)
    {
        $type = $this->getAttributeType($attribute);
        if (!isset($this->_eavTables[$type])) {
            $eavTable = new TableGateway(
                $this->getTypeTableName($type), $this->_entitiesTable->getAdapter(), new Feature\RowGatewayFeature('id'));
            $this->_eavTables[$type] = $eavTable;
        }

        return $this->_eavTables[$type];
    }

    public function getTypeTables($attributes)
    {
        $tables = array();
        foreach ($attributes as $attribute) {
            $type = $this->getAttributeType($attribute);
            if (!isset($tables[$type])) {
                $tables[$type] = $this->getTypeTable($attribute);
            }
        }
        return $tables;
    }

    public function getAttributeType($attribute)
    {
        return $attribute->{$this->_attributesTableFieldType};
    }

    public function getAttributeId($attribute)
    {
        return $attribute->{$this->_attributesTableFieldId};
    }

    public function getAttributeName($attribute)
    {
        return $attribute->{$this->_attributesTableFieldName};
    }

    public function getEntityId($row)
    {
        if (is_array($row)) {
            return $row[$this->_entitiesTableFieldId];
        } else {
            return $row->{$this->_entitiesTableFieldId};
        }
    }

    public function getAttributesTable()
    {
        return $this->_attributesTable;
    }

    public function getAttribute($id)
    {
        if (isset($this->_attributes[$id])) {
            return $this->_attributes[$id];
        } elseif (is_numeric($id)) {
            $where = array($this->_attributesTableFieldId => $id);
            $attribute = $this->_attributesTable->select($where)->current();
        } else {
            $where = array($this->_attributesTableFieldName => $id);
            $attribute = $this->_attributesTable->select($where)->current();
        }
        $this->cacheAttribute($attribute);
        return $attribute;
    }

    public function cacheAttribute($attribute)
    {
        $this->_attributes[$this->getAttributeId($attribute)] = $attribute;
        $this->_attributes[$this->getAttributeName($attribute)] = $attribute;
    }

    public function cacheAttributes($attributes)
    {
        foreach ($attributes as $attribute) {
            $this->cacheAttribute($attribute);
        }
    }

    public function getValueRow($entityRow, $attributeRow)
    {
        $typeTable = $this->getTypeTable($attributeRow);
        $attributeId = $this->getAttributeId($attributeRow);
        $where = array(
            'entity_id' => $this->getEntityId($entityRow),
            'attribute_id' => $attributeId
        );
        return $typeTable->select($where)->current();
    }

    /**
     * Return attribute value
     *
     * @param RowGateway $row entity object
     * @param RowGateway $attribute attribute object
     * @param ValuesCache $valuesCache try to use values cache
     * @param boolean $loadIfNotInCache do query if value is not in cache
     * @return mixed
     */
    public function getAttributeValue($row, $attribute, $valuesCache = null, $loadIfNotInCache = true)
    {
        if (is_string($attribute) || is_numeric($attribute)) {
            $attribute = $this->getAttribute($attribute);
        }
        $attributeId = $this->getAttributeId($attribute);
        $entityId = $this->getEntityId($row);

        if ($valuesCache) {
            if ($valuesCache->hasAttributeValue($entityId, $attributeId)) {
                return $valuesCache->getAttributeValue($entityId, $attributeId);
            } elseif (!$loadIfNotInCache) {
                return '';
            }
        }

        $valueRow = $this->getValueRow($row, $attribute);
        $value = $valueRow ? $valueRow->value : '';

        if ($valuesCache) {
            $valuesCache->setAttributeValue($entityId, $attributeId, $value);
        }

        return $value;
    }

    /**
     * Set attribute value
     *
     * @param RowGateway $entityRow entity object
     * @param RowGateway $attribute attribute object
     * @param mixed $value attribute value
     */
    public function setAttributeValue($entityRow, $attribute, $value)
    {
        if (is_string($attribute)) {
            $attribute = $this->getAttribute($attribute);
        }
        $typeTable = $this->getTypeTable($attribute);
        $valueRow = $this->getValueRow($entityRow, $attribute);
        if (!$valueRow) {
            $valueRow = new RowGateway('id', $typeTable->getTable(), $typeTable->getAdapter());
            $valueRow->attribute_id = $this->getAttributeId($attribute);
            $valueRow->entity_id = $this->getEntityId($entityRow);
        }

        $valueRow->value = $value;
        $valueRow->save();
    }

    /**
     * Load attributes values with single query
     *
     * @param ResultSet $rows
     * @param ResultSet $attributes
     * @return array
     */
    public function loadAttributes($rows, $attributes)
    {
        if (!$rows->valid()) {
            return;
        }
        $this->cacheAttributes($attributes);

        $entityIds = array();
        foreach ($rows as $row) {
            array_push($entityIds, $this->getEntityId($row));
        }

        $typeTables = $this->getTypeTables($attributes);

        $queries = array();
        foreach ($typeTables as $type => $typeTable) {
            $select = $typeTable->getSql()->select();
            $select->where(array('entity_id' => $entityIds));

            $attributeIds = array();
            foreach ($attributes as $attribute) {
                if ($type == $this->getAttributeType($attribute)) {
                    $attributeIds[] = $this->getAttributeId($attribute);
                }
            }
            $select->where(array('attribute_id' => $attributeIds));
            $queries[] = $select->getSqlString($typeTable->getAdapter()->getPlatform());
        }

        /* build query */
        $query = '(' . implode(') UNION ALL (', $queries) . ')';

        $db = $this->_entitiesTable->getAdapter();
        $valuesRows = $db->query($query, Adapter::QUERY_MODE_EXECUTE);
        $result = new ValuesCache();
        foreach ($valuesRows as $row) {
            $result->setAttributeValue($row['entity_id'], $row['attribute_id'], $row['value']);
        }
        return $result;
    }
}