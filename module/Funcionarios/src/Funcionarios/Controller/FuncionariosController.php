<?php
namespace Funcionarios\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Funcionarios\Model\Funcionarios;
use Funcionarios\Form\FuncionariosForm;
use Funcionarios\Model\FuncionariosTable;

class FuncionariosController extends AbstractActionController
{
    protected $funcionariosTable;

    public function getFuncionariosTable()
    {
        if (!$this->funcionariosTable) {
            $sm = $this->getServiceLocator();
            $this->funcionariosTable = $sm->get('Funcionarios\Model\FuncionariosTable');
        }
        return $this->funcionariosTable;
    }

    public function getAdapter()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        return $adapter;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'funcionarios' => $this->getFuncionariosTable()->fetchAll(),
        ));
    }

    public function createAction()
    {
        $form = new FuncionariosForm();
        $form->get('submit')->setValue('Salvar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $funcionarios = new Funcionarios();
            $form->setInputFilter($funcionarios->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $funcionarios->exchangeArray($form->getData());
                $funcionarios->data_cadastro = date('Y-m-d H:i:s');
                $this->getFuncionariosTable()->saveFuncionarios($funcionarios);

                // Redirect to list of funcionarioss
                return $this->redirect()->toRoute('funcionarios');
            }
        }
        return array('form' => $form);
    }

    public function updateAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('funcionarios', array(
                'action' => 'create'
            ));
        }

        // Requisita um ALbum com id específico. Uma exceção é disparada caso
        // ele não seja encontrado, nesse caso redirecione para a págin incial.
        try {
            $funcionarios = $this->getFuncionariosTable()->getFuncionarios($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('funcionarios', array(
                'action' => 'index'
            ));
        }

        $form  = new FuncionariosForm();
        $form->bind($funcionarios);
        $form->get('submit')->setAttribute('value', 'Salvar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($funcionarios->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getFuncionariosTable()->saveFuncionarios($funcionarios);

                // Redireciona para a lista de albuns
                return $this->redirect()->toRoute('funcionarios');
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
            return $this->redirect()->toRoute('funcionarios');
        }

        $funcionario = FuncionariosTable::buscarDados($this->getAdapter(),$id);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('delete', 'Cancelar');

            if ($del == 'Excluir') {
                $id = (int) $request->getPost('id');
                $this->getFuncionariosTable()->deleteFuncionarios($id);
            }

            // Redireciona para a lista de albuns
            return $this->redirect()->toRoute('funcionarios');
        }

        return array(
            'id'    => $id,
            'funcionario'   => $funcionario,
        );
    }
}