<?php
namespace Funcionarios;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Funcionarios\Model\Funcionarios;
use Funcionarios\Model\FuncionariosTable;
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
                'Funcionarios\Model\FuncionariosTable' =>  function($sm) {
                    $tableGateway = $sm->get('FuncionariosTableGateway');
                    $table = new FuncionariosTable($tableGateway);
                    return $table;
                },
                'FuncionariosTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Funcionarios());
                    return new TableGateway('funcionarios', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}