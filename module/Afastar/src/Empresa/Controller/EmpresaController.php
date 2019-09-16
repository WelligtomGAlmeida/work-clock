<?php
namespace Empresa\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Empresa\Model\Empresa;
use Empresa\Form\EmpresaForm;

class EmpresaController extends AbstractActionController
{
    protected $empresaTable;

    public function getEmpresaTable()
    {
        if (!$this->empresaTable) {
            $sm = $this->getServiceLocator();
            $this->empresaTable = $sm->get('Empresa\Model\EmpresaTable');
        }
        return $this->empresaTable;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'empresas' => $this->getEmpresaTable()->fetchAll(),
        ));
    }

    public function createAction()
    {
        $form = new EmpresaForm();
        $form->get('submit')->setValue('Create');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $empresa = new Empresa();
            $form->setInputFilter($empresa->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $empresa->exchangeArray($form->getData());
                $this->getEmpresaTable()->saveEmpresa($empresa);

                // Redirect to list of empresas
                return $this->redirect()->toRoute('empresa');
            }
        }
        return array('form' => $form);
    }

    public function updateAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('empresa', array(
                'action' => 'create'
            ));
        }

        // Requisita um ALbum com id específico. Uma exceção é disparada caso
        // ele não seja encontrado, nesse caso redirecione para a págin incial.
        try {
            $empresa = $this->getEmpresaTable()->getEmpresa($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('empresa', array(
                'action' => 'index'
            ));
        }

        $form  = new EmpresaForm();
        $form->bind($empresa);
        $form->get('submit')->setAttribute('value', 'Update');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($empresa->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getEmpresaTable()->saveEmpresa($empresa);

                // Redireciona para a lista de albuns
                return $this->redirect()->toRoute('empresa');
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
            return $this->redirect()->toRoute('empresa');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('delete', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getEmpresaTable()->deleteEmpresa($id);
            }

            // Redireciona para a lista de albuns
            return $this->redirect()->toRoute('empresa');
        }

        return array(
            'id'    => $id,
            'empresa' => $this->getEmpresaTable()->getEmpresa($id)
        );
    }
}