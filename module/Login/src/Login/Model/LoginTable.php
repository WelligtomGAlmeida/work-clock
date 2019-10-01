<?php
namespace Login\Model;

use Zend\Db\TableGateway\TableGateway;
use Login\Model\Login;
use Zend\Authentication\AuthenticationService;

class LoginTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public static function login(Login $login)
    {
        $user_name = $login->user_name;
        $senha = $login->senha;

        $rowset = $this->tableGateway->select(array(
            'user_name' => $user_name, 
            'senha' => $senha
        ));

        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Usuário ou senha incorretas");
        }
        return $row;
        
        /*$auth = new AuthenticationService();

        $loginForm = new Default_Forw

        if ($loginForm->isValid()) {

            $adapter = new Zend\Auth\Adapter\DbTable(
                $db,
                'funcionarios',
                'user_name',
                'senha'
                );

            $adapter->setIdentity($loginForm->getValue('user_name'));
            $adapter->setCredential($loginForm->getValue('senha'));

            $result = $auth->authenticate($adapter);

            if ($result->isValid()) {
                //$this->_helper->FlashMessenger('Successful Login');
                $this->redirect()->toRoute('funcionarios');
                return;
            }

        }

        $this->view->loginForm = $loginForm;*/
    }
}