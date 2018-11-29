<?php

namespace Core\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

abstract class AbstractCoreModelTable
{
    protected $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getBy(array $params)
    {
        $rowset = $this->tableGateway->select($params);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException(sprintf('Nao foi possivel achar linha '));
        }

        return $row;
    }

    public function save(array $data)
    {
        unset($data['csrf']);
        unset($data['usuario_estado_id']);
        if (isset($data['id'])) {
            $id = (int)$data['id'];

            if (!$this->getBy(['id' => $id])) {
                throw new RuntimeException(sprintf('Nao foi possivel atualizar %d, nao existe no banco', $id));
            }

            $this->tableGateway->update($data, ['id' => $id]);
            return $this->getBy(['id' => $id]);
        }

        $this->tableGateway->insert($data);
    }

    public function delete($id)
    {
        $this->tableGateway->delete(['id' => $id]);
    }
}