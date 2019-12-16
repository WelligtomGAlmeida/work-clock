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
                $flag_dia = LoginTable::verificaDia($this->adapter);
                $flag_afastamento = LoginTable::verificaAfastamento($this->adapter,$dados["login"]);

                if($flag_dia['dia'] == 0)
                {
                    return array(   "cod" => "2",
                                    "msg" => "Não é possível acessar o sistema aos Domingos!");
                }
                elseif($flag_afastamento['contador'] == 0)
                {
                    $resultado = LoginTable::verificaPermissao($this->adapter,$dados["login"],$dados["senha"]);    

                    $_SESSION['funcionario'] = $resultado;
                    $_SESSION['empresa'] = 4;
                    $_SESSION['variaveisEmpresa'] = 1;


                    return array(   "cod" => "1",
                                    "msg" => "Login realizado com sucesso!");
                }
                else
                {
                    return array(   "cod" => "2",
                                    "msg" => "Acesso negado. Funcionário Afastado!");
                }
                
                
            
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