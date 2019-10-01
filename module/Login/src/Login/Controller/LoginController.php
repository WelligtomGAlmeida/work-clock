<?php
namespace Login\Controller;

use Exception;
use Login\Form\LoginForm;
use Login\Model\Login;
use Login\Model\Sessao;
use Login\Model\LoginTable;
use Zend\Mvc\Controller\AbstractActionController;


class LoginController extends AbstractActionController
{
    protected $loginTable;

    public function indexAction()
    {
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $sessao = new Sessao($dbAdapter);
        var_dump($sessao->login(array(
            "login" => "userhjki",
            "senha" => "sgbfisb",
        )));
        exit();
        $form = new LoginForm();
        $form->get('submit')->setValue('Entrar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $login = new Login();
            $form->setInputFilter($login->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $login->exchangeArray($form->getData());

                try{
                    LoginTable::login($login);

                }
                catch(Exception $e)
                {
                    var_dump("Ocorreu um erro: " + $e);
                    exit();
                }
                // Redirect to list of funcionarioss
                return $this->redirect()->toRoute('login');
            }
        }
        return array('form' => $form);

    }
}