<?php
class Employeelist extends Models{

    public $users_id = 0;
    public $users_name;

    /*
    * return table name
    */
    public function getTableName(){
        return "users";
    }

    /*
    * delete users
    */
    public function delete() {
        $sql = $this->db->prepare("DELETE FROM ".$this->getTableName()." where ".$this->getTableName()."_id = ?");
        $sql->execute(array($this->users_id));
        $sql = 'delete from users where users_id='.$this->users_id;
        App::$db->query($sql);
    }

    /*
    * return object model
    */
    public static function model($className = __CLASS__){
        return parent::model($className);
    }

}

