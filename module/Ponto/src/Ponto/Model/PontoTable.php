<?php
namespace Ponto\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class PontoTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getPonto($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi possível encontrar o ponto com id $id");
        }
        return $row;
    }

    public static function getPontoUpdate($adapter)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');

        $sql = "select count(0) as contador, id,funcionario_id,hora_entrada from ponto_funcionario where funcionario_id = '" . $_SESSION['funcionario']->id . "' and DATE(hora_entrada) = '" . $data ."' and hora_saida is null";
        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        if($result->current()['contador'] == 1)
        {
            return array(
                "id"    => $result->current()['id'],
                "funcionario_id"    => $result->current()['funcionario_id'],
                "hora_entrada"    => $result->current()['hora_entrada']
            );
        }
    }

    public static function travaRegistro($adapter)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');

        $sql = "select count(0) as contador from ponto_funcionario where funcionario_id = '" . $_SESSION['funcionario']->id . "' and DATE(hora_entrada) = '" . $data ."' and hora_saida is not null";
        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return array(
            "contador"  => $result->current()['contador']
        );
        
    }

    public static function verificaPonto($adapter)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');

        // Verifca se já existem mais de cinco pontos registrados no dia
        //      se existir então nã deixa registrar outro
        //      caso contrario deixa
        $sql = "select count(0) as contador from ponto_funcionario where funcionario_id = '" . $_SESSION['funcionario']->id . "' and DATE(hora_entrada) = '" . $data ."' and hora_saida is not null";
        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);
        
        if ($result->current()['contador'] >= 5)
        {
            return array(
                "acao"  => "0",
                "msg"   => "Não é possível registrar mais entradas na data atual" 
            );
        }
        else
        {
            $sql = "select count(0) as contador, id,funcionario_id,hora_entrada from ponto_funcionario where funcionario_id = '" . $_SESSION['funcionario']->id . "' and DATE(hora_entrada) = '" . $data ."' and hora_saida is null";
            $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

            if($result->current()['contador'] == 1)
            {
                return array(
                    "acao"  => "2",
                );
            }
            else
            {
                return array(
                    "acao"  => "1"
                );
            }
        }

    }

    public function savePonto(Ponto $ponto)
    {
        $data = array(
            'funcionario_id' => $ponto->funcionario_id,
            'hora_entrada' => $ponto->hora_entrada,
            'hora_saida' => $ponto->hora_saida
        );

        $id = (int) $ponto->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getPonto($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Este ponto não existe');
            }
        }
    }
 
    public static function consultarPontosHoje($adapter,$id)
    {
        $sql = "select TIME_FORMAT(hora_entrada, '%H:%i') as hora_entrada,TIME_FORMAT(hora_saida, '%H:%i') as hora_saida from ponto_funcionario where DATE_FORMAT(hora_entrada, '%Y-%m-%d') = CURDATE() and funcionario_id = " . $id;          

        $result = new ResultSet();
        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $result;
    }
}