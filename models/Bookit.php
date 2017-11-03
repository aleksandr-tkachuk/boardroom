<?php
class Bookit extends Models{

    public $events_id = 0;
    public $events_employer;
    public $events_start;
    public $events_end;
    public $events_description;
    public $events_recurring;
    public $events_specify;
    public $events_duration;
    public $events_parent;
    public $events_position;


    public function getTableName(){
        return "events";
    }

    public static function model($className = __CLASS__){
        return parent::model($className);
    }

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
                $where .= $key . ' ? ';
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
        //echo $sql;
        //print_r($dbParams);
        $sth = $this->db->prepare($sql);
        $sth->execute($dbParams);
        return $sth->fetchAll(PDO::FETCH_ASSOC);

    }

}
