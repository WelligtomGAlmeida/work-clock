<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Funcionarios\Controller\Funcionarios' => 'Funcionarios\Controller\FuncionariosController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'funcionarios' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/funcionarios[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Funcionarios\Controller\Funcionarios',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'funcionarios' => __DIR__ . '/../view',
        ),
    ),
);