<?php
namespace Ponto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Ponto\Model\Ponto;
use Ponto\Form\PontoForm;

class PontoController extends AbstractActionController
{
    protected $pontoTable;

    public function getPontoTable()
    {
        if (!$this->pontoTable) {
            $sm = $this->getServiceLocator();
            $this->pontoTable = $sm->get('Ponto\Model\PontoTable');
        }
        return $this->pontoTable;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'ponto' => $this->getPontoTable()->fetchAll(),
        ));
    }

    public function createAction()
    {
        $form = new PontoForm();
        $form->get('submit')->setValue('Registrar Entrada');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $ponto = new Ponto();
            //$form->setInputFilter($ponto->getInputFilter());
            $form->setData($request->getPost());
            $ponto->hora_entrada = date('Y-m-d H:i:s');
            $ponto->funcionario_id = '1';

            $this->getPontoTable()->savePonto($ponto);

            // Redirect to list of pontos
            return $this->redirect()->toRoute('ponto');
            
        }
        return array(
            'form' => $form
        );
    }

    public function updateAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('ponto', array(
                'action' => 'create'
            ));
        }

        // Requisita um ALbum com id específico. Uma exceção é disparada caso
        // ele não seja encontrado, nesse caso redirecione para a págin incial.
        try {
            $ponto = $this->getPontoTable()->getPonto($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('ponto', array(
                'action' => 'index'
            ));
        }

        $form  = new PontoForm();
        $form->bind($ponto);
        $form->get('submit')->setAttribute('value', 'Update');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($ponto->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getPontoTable()->savePonto($ponto);

                // Redireciona para a lista de albuns
                return $this->redirect()->toRoute('ponto');
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
            return $this->redirect()->toRoute('ponto');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('delete', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getPontoTable()->deletePonto($id);
            }

            // Redireciona para a lista de albuns
            return $this->redirect()->toRoute('ponto');
        }

        return array(
            'id'    => $id,
            'ponto' => $this->getPontoTable()->getPonto($id)
        );
    }
}