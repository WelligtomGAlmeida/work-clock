<?php
namespace Login\Model;

use Zend\Db\TableGateway\TableGateway;

class LoginTable
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

    public function getLogin($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi possível encontrar a empresa com id $id");
        }
        return $row;
    }

    public function saveLogin(Login $login)
    {
        $data = array(
            'razao_social' => $login->razao_social,
            'cnpj' => $login->cnpj,
            'telefone_fixo' => $login->telefone_fixo,
            'telefone_celular_1' => $login->telefone_celular_1,
            'telefone_celular_2' => $login->telefone_celular_2,
            'email' => $login->email,
            'data_cadastro' => $login->data_cadastro,
            'cep' => $login->cep,
            'cidade' => $login->cidade,
            'uf' => $login->uf,
            'logradouro' => $login->logradouro,
            'numero' => $login->numero,
            'bairro' => $login->bairro,
            'complemento' => $login->complemento
        );

        $id = (int) $login->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getLogin($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Esta empresa não existe');
            }
        }
    }

    public function deleteLogin($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}