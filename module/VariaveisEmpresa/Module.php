<?php
namespace VariaveisEmpresa;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use VariaveisEmpresa\Model\VariaveisEmpresa;
use VariaveisEmpresa\Model\VariaveisEmpresaTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'VariaveisEmpresa\Model\VariaveisEmpresaTable' =>  function($sm) {
                    $tableGateway = $sm->get('VariaveisEmpresaTableGateway');
                    $table = new VariaveisEmpresaTable($tableGateway);
                    return $table;
                },
                'VariaveisEmpresaTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new VariaveisEmpresa());
                    return new TableGateway('variaveis_empresa', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}