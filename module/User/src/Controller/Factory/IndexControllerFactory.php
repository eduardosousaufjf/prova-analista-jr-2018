<?php

namespace User\Controller\Factory;

use Interop\Container\ContainerInterface;
use User\Controller\IndexController;
use User\Form\UserForm;
use User\Model\Cidade;
use User\Model\CidadeTable;
use User\Model\EstadoTable;
use User\Model\User;
use User\Model\UserTable;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\Factory\FactoryInterface;

class IndexControllerFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get(Adapter::class);

        /*$resultSetPrototypeUsuarios = new ResultSet();
        $resultSetPrototypeUsuarios->setArrayObjectPrototype(new User());
        $tableGatewayUsuarios = new TableGateway('usuario', $adapter, null, $resultSetPrototypeUsuarios);

        $resultSetPrototypeCidades = new ResultSet();
        $resultSetPrototypeCidades->setArrayObjectPrototype(new Cidade());
        $tableGatewayCidades = new TableGateway('cidades', $adapter, null, $resultSetPrototypeCidades);*/

        $userForm = new UserForm($container->get(UserTable::class),$container->get(CidadeTable::class),
            $container->get(EstadoTable::class));

        return new IndexController($userForm, $container->get(UserTable::class), $container->get(CidadeTable::class));
    }
}