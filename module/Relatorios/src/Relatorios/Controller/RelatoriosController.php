<?php
namespace Relatorios\Controller;

use Relatorios\Model\RelatoriosTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RelatoriosController extends AbstractActionController
{
    public function getAdapter()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        return $adapter;
    }

    public function indexAction()
    {
        return array();
    }

    public function relatorioGeralAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data_inicial = $request->getPost('data_inicial');
            $data_final = $request->getPost('data_final');
            $informacao = $request->getPost('informacao');
            $ordem = $request->getPost('ordem');
            $nlinhas = $request->getPost('nlinhas');

            $funcionarios = RelatoriosTable::relatorioGeral($this->getAdapter(),$data_inicial,$data_final,$informacao,$ordem,$nlinhas);
        }
        else{
            return $this->redirect()->toRoute('relatorios');
        }

        $relatorio = '';
        if($informacao == 1)
            $relatorio = 'Todos os Funcionários';
        elseif($informacao == 2)
            $relatorio = 'Funcionários Demitidos';
        elseif($informacao == 3)
            $relatorio = 'Funcionários Admitidos(ativos)';
        elseif($informacao == 4)
            $relatorio = 'Funcionários Afastados';
        elseif($informacao == 5)
            $relatorio = 'Funcionários com menos faltas';
        elseif($informacao == 6)
            $relatorio = 'Funcionários com mais faltas';
            

        return array(
            'funcionarios'   => $funcionarios,
            'informacao' => $informacao,
            'relatorio' => $relatorio,
        );
    }

    public function selecaoMesAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data_inicial = $request->getPost('data_inicial');
            $data_final = $request->getPost('data_final');
            $informacao = $request->getPost('informacao');
            $ordem = $request->getPost('ordem');
            $nlinhas = $request->getPost('nlinhas');

            $funcionarios = RelatoriosTable::relatorioGeral($this->getAdapter(),$data_inicial,$data_final,$informacao,$ordem,$nlinhas);
        }
        else{
            return array();
        }
        
        return array();
    }

    public function consultaFuncionariosAction()
    {
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            $id = (int) $request->getPost('id');
            $nome = $request->getPost('nome');

            $funcionarios = RelatoriosTable::consultarFuncionarios($this->getAdapter(),$id,$nome);
        }
        else{
            $funcionarios = RelatoriosTable::consultarFuncionarios($this->getAdapter());
        }

        return array(
            'funcionarios' => $funcionarios
        );
    }

    public function folhaPontoAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data_inicial = $request->getPost('data_inicial');
            $data_final = $request->getPost('data_final');
            $informacao = $request->getPost('informacao');
            $ordem = $request->getPost('ordem');
            $nlinhas = $request->getPost('nlinhas');

            $funcionarios = RelatoriosTable::relatorioGeral($this->getAdapter(),$data_inicial,$data_final,$informacao,$ordem,$nlinhas);
        }
        else{
            //return $this->redirect()->toRoute('relatorios');
        }

        return array(
            'funcionarios'   => $funcionarios,
        );
    }

    public function pontoAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        return $viewModel;
    } 
}