<?php

namespace User;

use User\Controller\Factory\IndexControllerFactory;
use User\Model\CidadeTable;
use User\Model\EstadoTable;
use User\Model\Factory\CidadeTableFactory;
use User\Model\Factory\EstadoTableFactory;
use User\Model\Factory\UserTableFactory;
use User\Model\UserTable;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'user' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/user',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'register'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '[/:action][/:id]',

                        ]
                    ]
                ]
            ],
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => IndexControllerFactory::class
        ]
    ],
    'service_manager' => [
        'factories' => [
            UserTable::class => UserTableFactory::class,
            CidadeTable::class => CidadeTableFactory::class,
            EstadoTable::class => EstadoTableFactory::class
        ]
    ],
    'view_manager' => [
        'template_map' => [
            'user/layout/layout' => __DIR__ . '/../view/layout/layout.phtml',

            'user/index/register' => __DIR__ . '/../view/user/index/register.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => array('ViewJsonStrategy',),
    ]
];