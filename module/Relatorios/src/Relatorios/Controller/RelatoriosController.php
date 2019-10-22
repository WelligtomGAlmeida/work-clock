<?php
namespace Relatorios\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Relatorios\Model\Relatorios;
use Relatorios\Form\RelatoriosForm;

class RelatoriosController extends AbstractActionController
{

    public function indexAction()
    {
        return array(
            'nome' => 'Welligtom'
        );
    }
}