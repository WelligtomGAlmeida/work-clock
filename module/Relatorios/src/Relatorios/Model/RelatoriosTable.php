<?php
namespace Relatorios\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

class RelatoriosTable
{
    public static function relatorioGeral($adapter,$data_inicial,$data_final,$informacao,$ordem,$nlinhas)
    {
        if($data_inicial)
            $data_inicial = date('Y-m-d',  strtotime($data_inicial));
        else
            $data_inicial = date('1900-01-01');

        if($data_final)
            $data_final = date('Y-m-d',  strtotime($data_final));
        else
            $data_final = date('1900-01-01');    

        $sql = "CALL rel_RelatorioGeral_sp('" . $data_inicial . "','" . $data_final . "'," . $informacao . "," . $ordem . "," . $nlinhas . ")";
        //var_dump($sql);
        //exit();

        $result = new ResultSet(); 

        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $result;
    }
    
    public static function consultarFuncionarios($adapter,$id = Null,$nome = Null)
    {
        $resultSet = new ResultSet();
        if($id != Null && $nome == Null)
            $sql = "select f.id, f.nome, f.funcao, DATE_FORMAT(f.data_nascimento, '%d/%m/%Y') as data_nascimento from funcionarios f inner join perfil p on p.id = f.perfil where vid = " . $id . " and p.id > (select ff.perfil from funcionarios ff where ff.id = " . $_SESSION['funcionario']->id . ")";
        else if($id == Null && $nome != Null)
            $sql = "select f.id, f.nome, f.funcao, DATE_FORMAT(f.data_nascimento, '%d/%m/%Y') as data_nascimento from funcionarios f inner join perfil p on p.id = f.perfil where f.nome like '%" . $nome . "%' and p.id > (select ff.perfil from funcionarios ff where ff.id = " . $_SESSION['funcionario']->id . ")";
        else if($id != Null && $nome != Null)
            $sql = "select f.id, f.nome, f.funcao, DATE_FORMAT(f.data_nascimento, '%d/%m/%Y') as data_nascimento from funcionarios f inner join perfil p on p.id = f.perfil where f.nome like '%" . $nome . "%' and f.id = " . $id . " and p.id > (select ff.perfil from funcionarios ff where ff.id = " . $_SESSION['funcionario']->id . ")";
        else
            $sql = "select f.id, f.nome, f.funcao, DATE_FORMAT(f.data_nascimento, '%d/%m/%Y') as data_nascimento from funcionarios f inner join perfil p on p.id = f.perfil where p.id > (select ff.perfil from funcionarios ff where ff.id = " . $_SESSION['funcionario']->id . ")";

        $resultSet = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $resultSet;
    }

    public static function consultarEmpresa($adapter,$mes)
    {
        $sql = "select razao_social, cnpj, logradouro, numero, bairro, cep, cidade, uf,DATE_FORMAT('" . $mes . "', '%d/%m/%Y') as inicio,DATE_FORMAT(LAST_DAY('" . $mes . "'), '%d/%m/%Y') as fim from empresas;";

        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $result->current();
    }

    public static function consultarHorario($adapter)
    {
        $sql = "select DATE_FORMAT(ent_1, '%H:%i') as ent_1, DATE_FORMAT(sai_1, '%H:%i') as sai_1, DATE_FORMAT(ent_2, '%H:%i') as ent_2, DATE_FORMAT(sai_2, '%H:%i') as sai_2, case when ent_sab_1 is null then '--:-- ' else DATE_FORMAT(ent_sab_1, '%H:%i') end as ent_sab_1,  case when sai_sab_1 is null then '--:-- ' else DATE_FORMAT(sai_sab_1, '%H:%i') end as sai_sab_1,  case when ent_sab_2 is null then '--:-- ' else DATE_FORMAT(ent_sab_2, '%H:%i') end as ent_sab_2,  case when sai_sab_2 is null then '--:-- ' else DATE_FORMAT(sai_sab_2, '%H:%i') end as sai_sab_2 from variaveis_empresa";

        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $result->current();
    }

    public static function consultarFuncionario($adapter,$data,$funcionarios)
    {
        $resultSet = new ResultSet();
        $sql = "call rel_total_pontos('" . $data ."');";
        $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);
        
        $sql = "select f.id, nome, pis_nis, funcao, concat('R$ ',salario) as salario, DATE_FORMAT(data_admissao, '%d/%m/%Y') as data_admissao, pt.* from funcionarios f inner join pontos_total pt on f.id = pt.funcionario where f.perfil <> 1 and f.id in (" . $funcionarios . ");";

        $resultSet = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $resultSet;
    }

    public static function consultarPontos($adapter, $data){
        $resultSet = new ResultSet();
        $sql = "call rel_pontos('" . $data ."')";

        $resultSet = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $resultSet;
    }
}