<?php
class User extends Models{

    public $users_id = 0;
    public $users_login;
    public $users_password;
    public $users_name;
    public $users_role;

    /*
    * return table name
    */
    public function getTableName(){
        return "users";
    }

    /*
    * return object model
    */
    public static function model($className = __CLASS__){
        return parent::model($className);
    }

    /*
    * return user by login
    */
    public function findByLogin($login){
        $sql = "select * from ".$this->getTableName()." where ".$this->getTableName()."_login = ?";

        $sql = $this->db->prepare($sql);
        $sql->execute(array($login));
        $sqlResult = $sql->fetch(PDO::FETCH_ASSOC);

        if($sqlResult){
            foreach ($sqlResult as $attr => $value){
                $this->$attr = $value;
            }

            return $this;
        }else{
            return null;
        }

    }

}
