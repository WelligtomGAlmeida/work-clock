<?php
namespace AfastarFuncionario\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use AfastarFuncionario\Model\AfastarFuncionario;
use AfastarFuncionario\Form\AfastarFuncionarioForm;

class AfastarFuncionarioController extends AbstractActionController
{
    protected $afastarFuncionarioTable;

    public function getAfastarFuncionarioTable()
    {
        if (!$this->afastarFuncionarioTable) {
            $sm = $this->getServiceLocator();
            $this->afastarFuncionarioTable = $sm->get('AfastarFuncionario\Model\AfastarFuncionarioTable');
        }
        return $this->afastarFuncionarioTable;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'afastarFuncionario' => $this->getAfastarFuncionarioTable()->fetchAll(),
        ));
    }

    public function createAction()
    {
        $form = new AfastarFuncionarioForm();
        $form->get('submit')->setValue('Create');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $afastarFuncionario = new AfastarFuncionario();
            $form->setInputFilter($afastarFuncionario->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $afastarFuncionario->exchangeArray($form->getData());

                $this->getAfastarFuncionarioTable()->saveAfastarFuncionario($afastarFuncionario);

                // Redirect to list of afastarFuncionarios
                return $this->redirect()->toRoute('afastarFuncionario');
            }
        }
        return array('form' => $form);
    }

    public function updateAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('afastarFuncionario', array(
                'action' => 'create'
            ));
        }

        // Requisita um ALbum com id específico. Uma exceção é disparada caso
        // ele não seja encontrado, nesse caso redirecione para a págin incial.
        try {
            $afastarFuncionario = $this->getAfastarFuncionarioTable()->getAfastarFuncionario($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('afastarFuncionario', array(
                'action' => 'index'
            ));
        }

        $form  = new AfastarFuncionarioForm();
        $form->bind($afastarFuncionario);
        $form->get('submit')->setAttribute('value', 'Update');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($afastarFuncionario->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getAfastarFuncionarioTable()->saveAfastarFuncionario($afastarFuncionario);

                // Redireciona para a lista de albuns
                return $this->redirect()->toRoute('afastarFuncionario');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );

    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('afastarFuncionario');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('delete', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getAfastarFuncionarioTable()->deleteAfastarFuncionario($id);
            }

            // Redireciona para a lista de albuns
            return $this->redirect()->toRoute('afastarFuncionario');
        }

        return array(
            'id'    => $id,
            'afastarFuncionario' => $this->getAfastarFuncionarioTable()->getAfastarFuncionario($id)
        );
    }
}