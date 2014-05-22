<?php
namespace GoalioForgotPassword\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use GoalioForgotPassword\Entity\Password as Model;
use Zend\Db\Sql\Sql;

class Password extends AbstractDbMapper
{
    protected $tableName         = 'user_password_reset';
    protected $keyField          = 'request_key';
    protected $userField         = 'user_id';
    protected $reqtimeField      = 'request_time';

    public function remove($passwordModel)
    {
        $sql = new Sql($this->getDbAdapter(), $this->tableName);
        $delete= $sql->delete();
        $delete->where->equalTo($this->keyField, $passwordModel->getRequestKey());
        $statement = $sql->prepareStatementForSqlObject($delete);
        $statement->execute();
        return true;
    }

    public function findByUserId($userId)
    {
        $select = $this->select()
                       ->from($this->tableName)
                       ->where(array($this->userField => $userId));
        return $this->selectWith($select)->current();
    }

    public function findByRequestKey($key)
    {
        $select = $this->select()
                       ->from($this->tableName)
                       ->where(array($this->keyField => $key));
        return $this->selectWith($select)->current();
    }

    public function cleanExpiredForgotRequests($expiryTime=86400)
    {
        $now = new \DateTime((int)$expiryTime . ' seconds ago');

        $sql = new Sql($this->getDbAdapter(), $this->tableName);
        $delete = $sql->delete();
        $delete ->where->lessThanOrEqualTo($this->reqtimeField, $now->format('Y-m-d H:i:s'));
        $statement = $sql->prepareStatementForSqlObject($delete);
        $statement->execute();
        return true;
    }

    public function cleanPriorForgotRequests($userId)
    {
        $sql = new Sql($this->getDbAdapter(), $this->tableName);
        $delete = $sql->delete();
        $delete ->where->equalTo($this->userField, $userId);
        $statement = $sql->prepareStatementForSqlObject($delete);
        $statement->execute();
        return true;
    }

	public function findByUserIdRequestKey($userId, $token)
	{
		$select = $this->getSelect()
                       ->where(array($this->userField => $userId, $this->keyField => $token));
        return $this->select($select)->current();
	}

    protected function fromRow($row)
    {
        if (!$row) return false;
        $evr = Model::fromArray($row->getArrayCopy());
        return $evr;
    }

    public function toScalarValueArray($passwordModel)
    {
        return new \ArrayObject(array(
            $this->keyField      => $passwordModel->getRequestKey(),
            $this->userField     => $passwordModel->getUserId(),
            $this->reqtimeField  => $passwordModel->getRequestTime()->format('Y-m-d H:i:s'),
        ));
    }

    /**
     * @todo
     */
    public function persist($passwordModel)
    {
        return parent::insert($passwordModel);
    }

    public function getTableName() { return $this->tableName; }
    public function getPrimaryKey() { $this->keyField; }
    public function getPaginatorAdapter(array $params) { }
    public function getClassName() { return 'GoalioForgotPassword\Entity\Password'; }
}
