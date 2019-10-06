<?php
namespace Login\Controller;

use Login\Form\LoginForm;
use Login\Model\Login;
use Login\Model\Sessao;
use Zend\Mvc\Controller\AbstractActionController;

class LoginController extends AbstractActionController
{

    public function getAdapter()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        return $adapter;
    }

    public function indexAction()
    {
        $sessao = new Sessao($this->getAdapter());
        //$sessionStorage = new SessionStorage('painel');

        $form = new LoginForm();
        $form->get('submit')->setValue('Entrar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $login = new Login();
            $form->setInputFilter($login->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $login->exchangeArray($form->getData());

                $result = $sessao->login(array(
                    "login" => $login->user_name,
                    "senha" => $login->senha,
                ));

                if($result["cod"] == "1")
                {
                    return $this->redirect()->toRoute('ponto', array('action' => 'create', 'id' => $_SESSION['funcionario']->id));
                }
                else
                    return array(   'form' => $form,
                                    'msg'=> $result["msg"]);
            }
        }
        return array('form' => $form);

    }
}