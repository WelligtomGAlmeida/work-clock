<?php
namespace Login\Model;

use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

class LoginTable
{

    public static function verificaPermissao($adapter,$user_name,$senha)
    {
        $sql = "select id,nome,perfil from funcionarios where user_name = '". $user_name ."' and senha = '" . $senha . "'";

        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $result->current();
    }

    public static function verificaAfastamento($adapter,$user_name)
    {
        $sql = "select count(0) as contador from funcionarios a inner join funcionarios_afastados b on a.id = b.funcionario_id where CURDATE() >= data_ini and CURDATE() <= data_fim and a.user_name = '". $user_name ."';";

        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $result->current();
    }   

    public static function verificaDia($adapter)
    {
        $sql = "select DATE_FORMAT(CURDATE(),'%w') as dia";

        $result = $adapter->query($sql,Adapter::QUERY_MODE_EXECUTE);

        return $result->current();
    }   
}