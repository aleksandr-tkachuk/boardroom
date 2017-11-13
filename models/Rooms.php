<?php
class Rooms extends Models{

    /*
    * return table name
    */
    public function getTableName(){
        return "rooms";
    }

    /*
    * return object model
    */
    public static function model($className = __CLASS__){
        return parent::model($className);
    }

}
