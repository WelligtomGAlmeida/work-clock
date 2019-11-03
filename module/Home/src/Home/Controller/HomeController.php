<?php
namespace Home\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class HomeController extends AbstractActionController
{
    protected $homeTable;

    public function indexAction()
    {
        return array();
    }
}