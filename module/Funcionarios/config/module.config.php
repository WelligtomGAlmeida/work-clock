<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Empresa\Controller\Empresa' => 'Empresa\Controller\EmpresaController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'empresa' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/empresa[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Empresa\Controller\Empresa',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'empresa' => __DIR__ . '/../view',
        ),
    ),
);