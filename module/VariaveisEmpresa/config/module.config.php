<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'VariaveisEmpresa\Controller\VariaveisEmpresa' => 'VariaveisEmpresa\Controller\VariaveisEmpresaController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'variaveisEmpresa' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/variaveisEmpresa[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'VariaveisEmpresa\Controller\VariaveisEmpresa',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'variaveisEmpresa' => __DIR__ . '/../view',
        ),
    ),
);