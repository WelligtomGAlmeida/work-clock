<?php
namespace Funcionarios\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;

class FuncionariosTable
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

    public function getFuncionarios($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveFuncionarios(Funcionarios $funcionarios)
    {
        $data = array(
            'nome' => $funcionarios->nome,
            'sexo' => $funcionarios->sexo,
            'data_nascimento' => $funcionarios->data_nascimento,
            'rg' => $funcionarios->rg,
            'cpf' => $funcionarios->cpf,
            'pis_nis' => $funcionarios->pis_nis,
            'telefone_fixo' => $funcionarios->telefone_fixo,
            'telefone_celular_1' => $funcionarios->telefone_celular_1,
            'telefone_celular_2' => $funcionarios->telefone_celular_2,
            'email' => $funcionarios->email,
            'salario' => $funcionarios->salario,
            'funcao' => $funcionarios->funcao,
            'perfil' => $funcionarios->perfil ,
            'user_name' => $funcionarios->user_name,
            'senha' => $funcionarios->senha,
            'data_admissao' => $funcionarios->data_admissao,
            'data_cadastro' => $funcionarios->data_cadastro,
            'cep' => $funcionarios->cep,
            'cidade' => $funcionarios->cidade,
            'uf' => $funcionarios->uf,
            'logradouro' => $funcionarios->logradouro,
            'numero' => $funcionarios->numero,
            'bairro' => $funcionarios->bairro,
            'complemento' => $funcionarios->complemento            
        );

        $id = (int) $funcionarios->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getFuncionarios($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Funcionarios id does not exist');
            }
        }
    }

    public static function buscarDados($adapter,$id)
    {
        $sql = "select id,nome,DATE_FORMAT(data_nascimento, '%d/%m/%Y') as data_nascimento,pis_nis,cpf,funcao,DATE_FORMAT(data_cadastro, '%d/%m/%Y') as data_cadastro from funcionarios where id = " . $id;

        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $result->current();
    }
}