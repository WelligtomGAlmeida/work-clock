<?php
namespace Atestados\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Atestados\Model\Atestados;
use Atestados\Form\AtestadosForm;
use Atestados\Model\AtestadosTable;

class AtestadosController extends AbstractActionController
{
    protected $atestadosTable;

    public function getAdapter()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        return $adapter;
    }

    public function getAtestadosTable()
    {
        if (!$this->atestadosTable) {
            $sm = $this->getServiceLocator();
            $this->atestadosTable = $sm->get('Atestados\Model\AtestadosTable');
        }
        return $this->atestadosTable;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'atestados' => $this->getAtestadosTable()->fetchAll(),
        ));
    }

    public function createAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('atestados', array(
                'action' => 'index'
            ));
        }
        $funcionario = AtestadosTable::consultarFuncionario($this->getAdapter(),$id);

        $form = new AtestadosForm();
        $form->get('submit')->setValue('Salvar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $atestados = new Atestados();
            $form->setInputFilter($atestados->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $atestados->exchangeArray($form->getData());
                $atestados->funcionario_id = $id;

                $this->getAtestadosTable()->saveAtestados($atestados);

                // Redirect to list of atestadoss
                return $this->redirect()->toRoute('atestados');
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
            return $this->redirect()->toRoute('atestados', array(
                'action' => 'index'
            ));
        }

        // Requisita um ALbum com id específico. Uma exceção é disparada caso
        // ele não seja encontrado, nesse caso redirecione para a págin incial.
        try {
            $atestados = $this->getAtestadosTable()->getAtestados($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('atestados', array(
                'action' => 'index'
            ));
        }

        $form  = new AtestadosForm();
        $form->bind($atestados);
        $form->get('submit')->setAttribute('value', 'Salvar');

        $funcionario = AtestadosTable::consultarFuncionario($this->getAdapter(),$atestados->funcionario_id);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($atestados->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getAtestadosTable()->saveAtestados($atestados);

                // Redireciona para a lista de albuns
                return $this->redirect()->toRoute('atestados');
            }
        }

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
            return $this->redirect()->toRoute('atestados');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('delete', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getAtestadosTable()->deleteAtestados($id);
            }

            // Redireciona para a lista de albuns
            return $this->redirect()->toRoute('atestados');
        }

        return array(
            'id'    => $id,
            'atestados' => $this->getAtestadosTable()->getAtestados($id)
        );
    }

    public function consultaFuncionariosAction()
    {
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            $id = (int) $request->getPost('id');
            $nome = $request->getPost('nome');

            $funcionarios = AtestadosTable::consultarFuncionarios($this->getAdapter(),$id,$nome);
        }
        else{
            $funcionarios = AtestadosTable::consultarFuncionarios($this->getAdapter());
        }

        return array(
            'funcionarios' => $funcionarios
        );
    }
}