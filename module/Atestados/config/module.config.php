<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Atestados\Controller\Atestados' => 'Atestados\Controller\AtestadosController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'atestados' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/atestados[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Atestados\Controller\Atestados',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'atestados' => __DIR__ . '/../view',
        ),
    ),
);