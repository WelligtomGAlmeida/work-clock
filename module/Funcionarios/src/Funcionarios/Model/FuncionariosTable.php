<?php
namespace Funcionarios\Model;

use Zend\Db\TableGateway\TableGateway;

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
            'sindicato' => $funcionarios->sindicato,
            'funcao' => $funcionarios->funcao,
            'perfil' => $funcionarios->perfil ,
            'user_name' => $funcionarios->user_name,
            'senha' => $funcionarios->senha,
            'data_admissao' => $funcionarios->data_admissao,
            'empresa_id' => $funcionarios->empresa_id,
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

    public function deleteFuncionarios($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}