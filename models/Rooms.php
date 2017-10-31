<?php
class Rooms extends Models{

    public function getTableName(){
        return "rooms";
    }

    public static function model($className = __CLASS__){
        return parent::model($className);
    }

}
