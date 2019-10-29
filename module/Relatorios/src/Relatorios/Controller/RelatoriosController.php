<?php
namespace Relatorios\Controller;

use Relatorios\Model\RelatoriosTable;
use Zend\Mvc\Controller\AbstractActionController;

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

        return array(
            'funcionarios'   => $funcionarios,
        );
    }
}