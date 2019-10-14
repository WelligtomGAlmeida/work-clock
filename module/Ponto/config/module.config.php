<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Ponto\Controller\Ponto' => 'Ponto\Controller\PontoController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'ponto' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/ponto[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Ponto\Controller\Ponto',
                        'action'     => 'direcionaPonto',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'ponto' => __DIR__ . '/../view',
        ),
    ),
);