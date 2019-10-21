<?php
namespace AfastarFuncionario\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use AfastarFuncionario\Model\AfastarFuncionario;
use AfastarFuncionario\Form\AfastarFuncionarioForm;
use AfastarFuncionario\Model\AfastarFuncionarioTable;
use Zend\Db\Adapter\Adapter;

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

    public function getAdapter()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        return $adapter;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'afastarFuncionario' => $this->getAfastarFuncionarioTable()->fetchAll(),
        ));
    }

    public function createAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('afastarFuncionario', array(
                'action' => 'index'
            ));
        }
        
        $funcionario = AfastarFuncionarioTable::consultarFuncionario($this->getAdapter(),$id);

        $form = new AfastarFuncionarioForm();
        $form->get('submit')->setValue('Salvar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $afastarFuncionario = new AfastarFuncionario();
            $form->setInputFilter($afastarFuncionario->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $afastarFuncionario->exchangeArray($form->getData());
                $afastarFuncionario->funcionario_id = $id;

                $this->getAfastarFuncionarioTable()->saveAfastarFuncionario($afastarFuncionario);

                // Redirect to list of afastarFuncionarios
                return $this->redirect()->toRoute('afastarFuncionario');
            }
        }
        return array(
            'form' => $form,
            'funcionario' => $funcionario
        );
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
        $form->get('submit')->setAttribute('value', 'Salvar');

        $funcionario = AfastarFuncionarioTable::consultarFuncionario($this->getAdapter(),$afastarFuncionario->funcionario_id);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($afastarFuncionario->getInputFilter());
            $form->setData($request->getPost());

            $i = 1;

            if ($form->isValid()) {
                $this->getAfastarFuncionarioTable()->saveAfastarFuncionario($afastarFuncionario);

                // Redireciona para a lista de albuns
                return $this->redirect()->toRoute('afastarFuncionario');
            }
        }

        $i = 1;

        return array(
            'id' => $id,
            'form' => $form,
            'funcionario' => $funcionario
        );

    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('funcionarios');
        }

        $afastamento = AfastarFuncionarioTable::buscarDados($this->getAdapter(),$id);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('delete', 'Cancelar');

            if ($del == 'Excluir') {
                $id = (int) $request->getPost('id');
                $this->getAfastarFuncionarioTable()->deleteAfastarFuncionario($id);
            }

            // Redireciona para a lista de albuns
            return $this->redirect()->toRoute('afastarFuncionario');
        }

        return array(
            'id'    => $id,
            'afastamento'   => $afastamento,
        );
    }


    public function consultaFuncionariosAction()
    {
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            $id = (int) $request->getPost('id');
            $nome = $request->getPost('nome');

            $funcionarios = AfastarFuncionarioTable::consultarFuncionarios($this->getAdapter(),$id,$nome);
        }
        else{
            $funcionarios = AfastarFuncionarioTable::consultarFuncionarios($this->getAdapter());
        }

        return array(
            'funcionarios' => $funcionarios
        );
    }
}