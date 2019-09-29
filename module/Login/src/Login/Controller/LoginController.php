<?php
namespace Login\Controller;

use Login\Form\LoginForm;
use Zend\Controller\Action;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Auth\Adapter\DbTable;

class LoginController extends Zend\Controller\Action
{
    protected $loginTable;

    public function indexAction()
    {

        $form = new LoginForm();
        $form->get('submit')->setValue('Entrar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            


        }
        return array('form' => $form);

    }
}