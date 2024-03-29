<?php
namespace AfastarFuncionario;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use AfastarFuncionario\Model\AfastarFuncionario;
use AfastarFuncionario\Model\AfastarFuncionarioTable;
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
                'AfastarFuncionario\Model\AfastarFuncionarioTable' =>  function($sm) {
                    $tableGateway = $sm->get('AfastarFuncionarioTableGateway');
                    $table = new AfastarFuncionarioTable($tableGateway);
                    return $table;
                },
                'AfastarFuncionarioTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new AfastarFuncionario());
                    return new TableGateway('funcionarios_afastados', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}