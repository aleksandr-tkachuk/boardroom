<?php

abstract class Models{
    protected $db;
    private static  $_models = [];


    abstract public function getTableName();

    /*
    * model constructor
    */
    public function __construct(){
        $this->db = App::$db;
    }

    /*
    * return object model (singleton)
    */
    public static function model($className = __CLASS__){
        if(isset(self::$_models[$className])){
            return self::$_models[$className];
        }else{
            self::$_models[$className] = new $className();
            return self::$_models[$className];
        }
    }

    /*
    * return all records
    */
    public function findAll($params = [], $orders = []){
        $sql = "select * from ".$this->getTableName();
        $dbParams = [];
        if(count($params) != 0){
            $where = " where ";
            $ind = 0;
            foreach ($params as $key => $val){
                if($ind != 0){
                    $where .= " and ";
                }
                $where .= $key . ' = ? ';
                $dbParams[] = $val;
                $ind++;
            }

            $sql .= $where;
        }

        if(count($orders) != 0){
            $order = " order by ";
            $ind = 0;
            foreach ($orders as $key => $val){
                if($ind != 0){
                    $order .= ", ";
                }
                $order .= $key." ".$val;
                $ind++;
            }
            $sql .= $order;
        }
        $sth = $this->db->prepare($sql);
        $sth->execute($dbParams);
        return $sth->fetchAll(PDO::FETCH_ASSOC);

    }

    /*
    * return record by id
    */
    public function find($id){
        $sql = "select * from ".$this->getTableName()." where ".$this->getTableName()."_id = ?";

        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
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

    /*
    * save model
    */
    public function save(){
        $id = $this->getTableName()."_id";
        if(!empty($this->$id)){
            return $this->update();
        }else{
            return $this->insert();
        }
    }

    /*
    * update record
    */
    private function update(){
        $sql = "update ".$this->getTableName()." set ";
        $fields = "";
        $comma = 0;

        foreach ($this as $attr => $value){
            if($attr != "db"){
                if($comma != 0){
                    $fields .= ", ";
                }
                $fields .= $attr."='".$value."'";
                $comma++;
            }
        }
        $id = $this->getTableName()."_id";
        $sql .= $fields." where ".$this->getTableName()."_id=".$this->$id;

        return $this->db->sqlQuery($sql);
    }

    /*
    * insert record
    */
    private function insert(){
        $sql = "insert into ".$this->getTableName();
        $fields = "";
        $values = "";
        $comma = 0;
        $sqlValues = [];
        foreach ($this as $attr => $value){
            if($attr != $this->getTableName()."_id" && $attr != "db"){
                if($comma != 0){
                    $fields .= ", ";
                    $values .= ", ";
                }
                $fields .= $attr;
                $values .= "?";
                $sqlValues[] = $value;
                $comma++;
            }
        }
        $sql = $sql." ($fields) values ($values)";

        $sth = $this->db->prepare($sql);
        $result = $sth->execute($sqlValues);

        $this->find($this->db->lastId());
        return $result;
    }

    /*
    * delete record
    */
    public function delete() {
        $sql = $this->db->prepare("DELETE FROM ".$this->getTableName()." where ".$this->getTableName()."_id = ?");
        $events_id = $this->getTableName()."_id";

        return $sql->execute(array($this->$events_id));
    }


}
