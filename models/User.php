<?php
class User extends Models{

    public function getTableName(){
        return "users";
    }

    public static function model($className = __CLASS__){
        return parent::model($className);
    }

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
