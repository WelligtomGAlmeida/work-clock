<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'AfastarFuncionario\Controller\AfastarFuncionario' => 'AfastarFuncionario\Controller\AfastarFuncionarioController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'afastarFuncionario' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/afastarFuncionario[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'AfastarFuncionario\Controller\AfastarFuncionario',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'afastarFuncionario' => __DIR__ . '/../view',
        ),
    ),
);