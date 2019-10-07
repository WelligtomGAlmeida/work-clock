<?php
namespace Login\Model;

use Zend\Db\Sql\Sql;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

class Sessao {

    public $adapter = null;

    public function __construct($adapter){
        $this->adapter = $adapter;
    }

    public function login($dados){

            ## Serviço de autenticar e manter a sessão
            $auth = new AuthenticationService();

            ## Tabela de credenciais
            $authAdapter = new AuthAdapter($this->adapter);
            $authAdapter->setTableName('funcionarios')
                        ->setIdentityColumn('user_name')
                        ->setCredentialColumn('senha');

            ## Dados do formulário
            $authAdapter->setIdentity($dados["login"])
                        ->setCredential($dados["senha"]);

            $auth->setAdapter($authAdapter);

            ## Sessão de autenticação
            $sessionStorage = new SessionStorage('painel');
            $sessionStorage->opa = 'Aqui deu certo';
            $auth->setStorage($sessionStorage);
            
            try {
                $result = $auth->authenticate($authAdapter);
            } catch ( \Exception $ex ){
                var_dump($ex->getMessage());
                //return array("Erro ao realizar autenticação", $ex->getMessage(), array() , Mensagem::Danger);
            }

            if ( $result->isValid() ) {

                $resultado = LoginTable::verificaPermissao($this->adapter,$dados["login"],$dados["senha"]);    

                $_SESSION['funcionario'] = $resultado;

                return array(   "cod" => "1",
                                "msg" => "Login realizado com sucesso!");
            
            } else {
                //
                return array(   "cod" => "2",
                                "msg" => "Usuário ou senha incorreto!");        
            }
    }

    public static function logout(){

        $sessionStorage = new SessionStorage('painel');

        $auth = new AuthenticationService($sessionStorage);

        if ($auth->hasIdentity())
        { 
            $auth->clearIdentity(); 
        } 

    }

}