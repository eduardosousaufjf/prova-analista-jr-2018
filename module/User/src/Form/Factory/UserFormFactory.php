<?php

namespace User\Form\Factory;

use User\Form\UserForm;
use User\Model\Cidade;
use User\Model\User;
use User\Model\UserTable;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class UserFormFactory implements FactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get(Adapter::class);

        $resultSetPrototypeUsuarios = new ResultSet();
        $resultSetPrototypeUsuarios->setArrayObjectPrototype(new User());
        $tableGatewayUsuarios = new TableGateway('usuario', $adapter, null, $resultSetPrototypeUsuarios);

        $resultSetPrototypeCidades = new ResultSet();
        $resultSetPrototypeCidades->setArrayObjectPrototype(new Cidade());
        $tableGatewayCidades = new TableGateway('cidades', $adapter, null, $resultSetPrototypeCidades);

        $resultSetPrototypeEstados = new ResultSet();
        $resultSetPrototypeEstados->setArrayObjectPrototype(new Estado());
        $tableGatewayEstados = new TableGateway('estados', $adapter, null, $resultSetPrototypeEstados);

        return new UserForm($tableGatewayUsuarios, $tableGatewayCidades, $tableGatewayEstados);
    }

}