<?php
namespace VariaveisEmpresa\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use VariaveisEmpresa\Model\VariaveisEmpresa;
use VariaveisEmpresa\Form\VariaveisEmpresaForm;

class VariaveisEmpresaController extends AbstractActionController
{
    protected $variaveisEmpresaTable;

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
        return new ViewModel(array(
            'variaveisEmpresa' => $this->getVariaveisEmpresaTable()->fetchAll(),
        ));
    }

    public function updateAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('empresas', array(
                'action' => 'home'
            ));
        }

        // Requisita um ALbum com id específico. Uma exceção é disparada caso
        // ele não seja encontrado, nesse caso redirecione para a págin incial.
        try {
            $variaveisEmpresa = $this->getVariaveisEmpresaTable()->getVariaveisEmpresa($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('empresas', array(
                'action' => 'home'
            ));
        }

        $form  = new VariaveisEmpresaForm();
        $form->bind($variaveisEmpresa);
        $form->get('submit')->setAttribute('value', 'Update');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($variaveisEmpresa->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getVariaveisEmpresaTable()->saveVariaveisEmpresa($variaveisEmpresa);

                // Redireciona para a lista de albuns
                return $this->redirect()->toRoute('variaveisEmpresa');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );

    }
}