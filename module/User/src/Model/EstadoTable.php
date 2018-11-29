<?php

namespace User\Model;

use Core\Model\AbstractCoreModelTable;
use Zend\Db\Sql\Select;

class EstadoTable extends AbstractCoreModelTable
{
    public function findAll($params)
    {
        return $this->tableGateway->select($params);
    }

    public function getComboEstado()
    {
        /** @var Select $select */
        $result = $this->tableGateway->select();

        foreach ($result->toArray() as $r){
            $data[$r['estado_id']] = $r['estado_nome'];
        }

        return $data;
    }
}