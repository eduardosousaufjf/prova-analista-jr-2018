<?php

namespace User\Model;

use Core\Model\AbstractCoreModelTable;
use Zend\Db\Sql\Select;

class CidadeTable extends AbstractCoreModelTable
{
    public function findAll($params)
    {
        return $this->tableGateway->select($params);
    }

    public function getComboCidade()
    {
        /** @var Select $select */
        $result = $this->tableGateway->select();

        foreach ($result->toArray() as $r){
            $data[$r['cidade_id']] = $r['cidade_nome'];
        }

        return $data;
    }
}