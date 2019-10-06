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
}