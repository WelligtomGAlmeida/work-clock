<?php
namespace Login;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Login\Model\Login;
use Login\Model\LoginTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

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
                'Login\Model\LoginTable' =>  function($sm) {
                    $tableGateway = $sm->get('LoginTableGateway');
                    $table = new LoginTable($tableGateway);
                    return $table;
                },
                'LoginTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Login());
                    return new TableGateway('funcionarios', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public static function checkPermission(MvcEvent $e)
    {
        $sessionStorage = new SessionStorage('painel');
        $whiteList = Module::getWhiteList();
        $auth = new AuthenticationService($sessionStorage);
        
        $identity = ( $auth->hasIdentity() ) ? $auth->getIdentity() : null;
        
        $routeMatch = $e->getRouteMatch();
        $controller = $routeMatch->getParam('controller');
        $action = $routeMatch->getParam('action');
        if ( is_null($identity) ){
            ## Verifica se o controller e action está na white list
            if (  !array_key_exists($controller, $whiteList) ){
                $response = $e->getResponse(); 
                $response->setStatusCode(302); 
                $response->getHeaders()->addHeaderLine('Location', '/login'); 
                $e->stopPropagation(); 
            } else {
                $actions = $whiteList[$controller];
                if ( !is_null($actions) && !in_array($action, $actions) ){
                    $response = $e->getResponse(); 
                    $response->setStatusCode(302); 
                    $response->getHeaders()->addHeaderLine('Location', '/login'); 
                    $e->stopPropagation(); 
                }
            }
            
        }
        
    }

    public static function getWhiteList(){
        return array(
            "Login\Controller\Login" => array(
                "index",
            ),
        );
    }

    public function setLayout($e)
    {
        $matches    = $e->getRouteMatch();
        $controller = $matches->getParam('controller');
        if (false === strpos($controller, __NAMESPACE__)) {
            // not a controller from this module
            return;
        }

        // Set the layout template
        $viewModel = $e->getViewModel();
        $viewModel->setTemplate('layout/layout');
    }

    public function doAuthorization(MvcEvent $e)
    {
        $application = $e->getApplication();
        $sm = $application->getServiceManager();
        $sharedManager = $application->getEventManager()->getSharedManager();
        $router = $sm->get('router');
        $request = $sm->get('request');
        $matchedRoute = $router->match($request);
        if (!preg_match('%^/'.__NAMESPACE__.'/.*%i', $request->getUri()->getPath())) return true;
        if (null !== $matchedRoute) {
            $sharedManager->attach('Zend\Mvc\Controller\AbstractActionController','dispatch',
                function($e) use ($sm) {
                    $sm->get('ControllerPluginManager')->get('Appauth')->doAuthorization($e);
                },4
            );
        }
    }

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $eventManager->attach(MvcEvent::EVENT_ROUTE, __CLASS__ . '::checkPermission', -100);
        $eventManager->getSharedManager();
    
        /*$eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach('dispatch', array($this, 'setLayout'),2);
        $eventManager->attach('route', array($this, 'doAuthorization'),3);
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);*/
    }


}