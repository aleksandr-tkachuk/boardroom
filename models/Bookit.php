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
    public $events_room;


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

    public static function checkColision($newBookit){
        $start = $newBookit["startdatetime"];
        $end = $newBookit["enddatetime"];
        $room = $newBookit["room"];

        $sql = "select * from ".self::model()->getTableName() ."
            where 
            (
                ( events_start <= '" . $start . "' and events_end >= '" . $end . "' )
                or
                ( events_start >= '" . $start . "' and events_end <= '" . $end . "' )
                or
                ( events_start >= '" . $start . "' and events_end >= '" . $end . "' and events_start <= '" . $end . "' )
                or
                ( events_start <= '" . $start . "' and events_end <= '" . $end . "' and events_end >= '" . $start . "' )
            )
            and events_room = ".$room."
        ";

        $sth = self::model()->db->prepare($sql);
        $sth->execute([]);
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        return (sizeof($result) == 0) ? false : true;

    }

}
