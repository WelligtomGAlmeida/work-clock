<?php
namespace Empresas\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;

class EmpresasTable
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

    public function getEmpresas($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi possível encontrar a empresa com id $id");
        }
        return $row;
    }

    public function saveEmpresas(Empresas $empresas)
    {
        $data = array(
            'razao_social' => $empresas->razao_social,
            'cnpj' => $empresas->cnpj,
            'telefone_fixo' => $empresas->telefone_fixo,
            'telefone_celular_1' => $empresas->telefone_celular_1,
            'telefone_celular_2' => $empresas->telefone_celular_2,
            'email' => $empresas->email,
            'data_cadastro' => $empresas->data_cadastro,
            'cep' => $empresas->cep,
            'cidade' => $empresas->cidade,
            'uf' => $empresas->uf,
            'logradouro' => $empresas->logradouro,
            'numero' => $empresas->numero,
            'bairro' => $empresas->bairro,
            'complemento' => $empresas->complemento
        );

        $id = (int) $empresas->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getEmpresas($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Esta empresa não existe');
            }
        }
    }

    public static function consultarEmpresa($adapter)
    {
        $sql = "select * from empresas order by data_cadastro LIMIT 1";          

        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $result->current();
    }
}