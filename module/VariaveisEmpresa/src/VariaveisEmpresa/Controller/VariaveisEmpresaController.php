<?php
namespace VariaveisEmpresa\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use VariaveisEmpresa\Model\VariaveisEmpresa;
use VariaveisEmpresa\Form\VariaveisEmpresaForm;
use VariaveisEmpresa\Model\VariaveisEmpresaTable;

class VariaveisEmpresaController extends AbstractActionController
{
    protected $variaveisEmpresaTable;

    public function getAdapter()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        return $adapter;
    }

    public function getVariaveisEmpresaTable()
    {
        if (!$this->variaveisEmpresaTable) {
            $sm = $this->getServiceLocator();
            $this->variaveisEmpresaTable = $sm->get('VariaveisEmpresa\Model\VariaveisEmpresaTable');
        }
        return $this->variaveisEmpresaTable;
    }

    public function indexAction()
    {
        return $this->redirect()->toRoute('variaveisEmpresa', array(
            'action'    => 'details',
        )); 
    }

    public function detailsAction()
    {
        $variaveisEmpresa = VariaveisEmpresaTable::consultarVariaveisEmpresa($this->getAdapter());
        
        return array(
            'variaveisEmpresa' => $variaveisEmpresa
        );
    }

    public function updateAction()
    {
        // Requisita um ALbum com id específico. Uma exceção é disparada caso
        // ele não seja encontrado, nesse caso redirecione para a págin incial.
        try {
            $variaveisEmpresa = $this->getVariaveisEmpresaTable()->getVariaveisEmpresa($_SESSION['variaveisEmpresa']);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('empresas', array(
                'action' => 'home'
            ));
        }

        $form  = new VariaveisEmpresaForm();
        $form->bind($variaveisEmpresa);
        $form->get('submit')->setAttribute('value', 'Salvar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($variaveisEmpresa->getInputFilter());
            $form->setData($request->getPost());

            $f = $form;

            if ($form->isValid()) {
                $this->getVariaveisEmpresaTable()->saveVariaveisEmpresa($variaveisEmpresa);

                // Redireciona para a lista de albuns
                return $this->redirect()->toRoute('variaveisEmpresa');
            }
        }

        return array(
            'id' => $_SESSION['variaveisEmpresa'],
            'form' => $form,
        );

    }
}