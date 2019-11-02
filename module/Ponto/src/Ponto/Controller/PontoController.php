<?php
namespace Ponto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Ponto\Model\Ponto;
use Ponto\Form\PontoForm;
use Ponto\Model\PontoTable;

class PontoController extends AbstractActionController
{
    protected $pontoTable;

    public function getAdapter()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        return $adapter;
    }

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

    public function direcionaPontoAction()
    {
        $resposta = PontoTable::verificaPonto($this->getAdapter());

        if($resposta['acao'] == '1')
        {
            return $this->redirect()->toRoute('ponto', array('action' => 'create'));
        }
        else if($resposta['acao'] == '2')
        {
            return $this->redirect()->toRoute('ponto', array('action' => 'update'));
        }
        else
        {
            return $this->redirect()->toRoute('ponto', array('action' => 'create'));
        }
    }

    public function createAction()
    {
        $form = new PontoForm();
        $form->get('submit')->setValue('Registrar Entrada');
        $resultado = PontoTable::travaRegistro($this->getAdapter());
        $trava = $resultado['contador'] >= 5 ? 1 : 0;

        $request = $this->getRequest();
        if ($request->isPost()) {
            $ponto = new Ponto();
            $form->setData($request->getPost());
            date_default_timezone_set('America/Sao_Paulo');
            $ponto->hora_entrada = date('Y-m-d H:i:s');
            $ponto->funcionario_id = $_SESSION['funcionario']->id;

            $this->getPontoTable()->savePonto($ponto);

            return $this->redirect()->toRoute('ponto', array('action' => 'direcionaPonto'));
            
        }

        $pontos = PontoTable::consultarPontosHoje($this->getAdapter(),$_SESSION['funcionario']->id);

        return array(
            'form' => $form,
            'trava' => $trava,
            'pontos' => $pontos
        );
    }

    public function updateAction()
    {
        $form = new PontoForm();
        $form->get('submit')->setValue('Registrar Saída');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $ponto = new Ponto();

            $form->setData($request->getPost());
            date_default_timezone_set('America/Sao_Paulo');

            $result = PontoTable::getPontoUpdate($this->getAdapter());
            $ponto->funcionario_id = $_SESSION['funcionario']->id;
            $ponto->hora_entrada = $result['hora_entrada'];
            $ponto->id = $result['id'];
            $ponto->hora_saida = date('Y-m-d H:i:s');
            
            $this->getPontoTable()->savePonto($ponto);

            return $this->redirect()->toRoute('ponto', array('action' => 'direcionaPonto'));
            
        }

        $pontos = PontoTable::consultarPontosHoje($this->getAdapter(),$_SESSION['funcionario']->id);

        return array(
            'form' => $form,
            'pontos' => $pontos
        );

    }
}