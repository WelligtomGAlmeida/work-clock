<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Relatorios\Controller\Relatorios' => 'Relatorios\Controller\RelatoriosController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'relatorios' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/relatorios[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Relatorios\Controller\Relatorios',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'relatorios' => __DIR__ . '/../view',
        ),
    ),
);