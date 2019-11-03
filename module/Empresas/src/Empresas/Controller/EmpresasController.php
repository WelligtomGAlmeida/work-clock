<?php
namespace Empresas\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Empresas\Model\Empresas;
use Empresas\Form\EmpresasForm;
use Empresas\Model\EmpresasTable;

class EmpresasController extends AbstractActionController
{
    protected $empresasTable;

    public function getAdapter()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        return $adapter;
    }

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
        return $this->redirect()->toRoute('empresas', array(
            'action'    => 'details'
        )); 
    }

    public function detailsAction()
    {
        $empresa = EmpresasTable::consultarEmpresa($this->getAdapter());
        
        return array(
            'empresa' => $empresa
        );
    }

    public function updateAction()
    {
        // Requisita um ALbum com id específico. Uma exceção é disparada caso
        // ele não seja encontrado, nesse caso redirecione para a págin incial.
        try {
            $empresas = $this->getEmpresasTable()->getEmpresas($_SESSION['empresa']);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('empresas', array(
                'action' => 'update'
            ));
        }

        $form  = new EmpresasForm();
        $form->bind($empresas);
        $form->get('submit')->setAttribute('value', 'Salvar');

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
            'id' => $_SESSION['empresa'],
            'form' => $form,
        );

    }
}