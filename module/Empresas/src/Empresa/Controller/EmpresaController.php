<?php
namespace Empresas\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Empresas\Model\Empresas;
use Empresas\Form\EmpresasForm;

class EmpresasController extends AbstractActionController
{
    protected $empresasTable;

    public function getEmpresasTable()
    {
        if (!$this->empresasTable) {
            $sm = $this->getServiceLocator();
            $this->empresasTable = $sm->get('Empresas\Model\EmpresasTable');
        }
        return $this->empresasTable;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'empresass' => $this->getEmpresasTable()->fetchAll(),
        ));
    }

    public function createAction()
    {
        $form = new EmpresasForm();
        $form->get('submit')->setValue('Create');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $empresas = new Empresas();
            $form->setInputFilter($empresas->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $empresas->exchangeArray($form->getData());
                $this->getEmpresasTable()->saveEmpresas($empresas);

                // Redirect to list of empresass
                return $this->redirect()->toRoute('empresas');
            }
        }
        return array('form' => $form);
    }

    public function updateAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('empresas', array(
                'action' => 'create'
            ));
        }

        // Requisita um ALbum com id específico. Uma exceção é disparada caso
        // ele não seja encontrado, nesse caso redirecione para a págin incial.
        try {
            $empresas = $this->getEmpresasTable()->getEmpresas($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('empresas', array(
                'action' => 'index'
            ));
        }

        $form  = new EmpresasForm();
        $form->bind($empresas);
        $form->get('submit')->setAttribute('value', 'Update');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($empresas->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getEmpresasTable()->saveEmpresas($empresas);

                // Redireciona para a lista de albuns
                return $this->redirect()->toRoute('empresas');
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
            return $this->redirect()->toRoute('empresas');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('delete', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getEmpresasTable()->deleteEmpresas($id);
            }

            // Redireciona para a lista de albuns
            return $this->redirect()->toRoute('empresas');
        }

        return array(
            'id'    => $id,
            'empresas' => $this->getEmpresasTable()->getEmpresas($id)
        );
    }
}