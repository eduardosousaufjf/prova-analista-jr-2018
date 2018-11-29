<?php

namespace User\Model\Factory;

use Interop\Container\ContainerInterface;
use User\Model\Cidade;
use User\Model\CidadeTable;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\Factory\FactoryInterface;

class CidadeTableFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get(Adapter::class);
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Cidade());

        $tableGateway = new TableGateway('cidades', $adapter, null, $resultSetPrototype);

        return new CidadeTable($tableGateway);
    }
}