<?php

namespace User\Model\Factory;

use Interop\Container\ContainerInterface;
use User\Model\Estado;
use User\Model\EstadoTable;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\Factory\FactoryInterface;

class EstadoTableFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get(Adapter::class);
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Estado());

        $tableGateway = new TableGateway('estados', $adapter, null, $resultSetPrototype);

        return new EstadoTable($tableGateway);
    }
}