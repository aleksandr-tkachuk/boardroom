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
    public $events_created;

    /*
     * get table name
     */
    public function getTableName(){
        return "events";
    }

    /*
    * get object model
    */
    public static function model($className = __CLASS__){
        return parent::model($className);
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

        $sth = $this->db->prepare($sql);
        $sth->execute($dbParams);
        return $sth->fetchAll(PDO::FETCH_ASSOC);

    }

    /*
    * check collision time
    */
    public static function checkColision($newBookit, $action = 'add'){
        $start = $newBookit["startdatetime"];
        $end = $newBookit["enddatetime"];
        $room = $newBookit["room"];

        $sql = "select * from ".self::model()->getTableName() ."
            where 
            (
                ( events_start <= '" . $start . "' and events_end >= '" . $end . "' )
                or
                ( events_start >= '" . $start . "' and events_end >= '" . $end . "' and events_start < '" . $end . "' )
                or
                ( events_start <= '" . $start . "' and events_end <= '" . $end . "' and events_end > '" . $start . "')
                or
                ( events_start >= '" . $start . "' and events_end <= '" . $end . "' )
            )
            and events_room = ".$room."
        ";
        if($action == 'update'){
            $sql .= ' and events_id != '.$newBookit["id"].' and events_parent != '.$newBookit["id"];
        }
        $sth = self::model()->db->prepare($sql);
        $sth->execute([]);
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        return (sizeof($result) == 0) ? false : true;

    }

    /*
    * delete all next events
    */
    public static function deleteAllNext($eventId){
        $event = Bookit::model()->find($eventId);
        $room = $event->events_room;
        if($event->events_parent == 0){
            $sql = "delete from " . self::model()->getTableName() . " where events_parent = ".$event->events_id;

            self::model()->db->sqlQuery($sql);
        }else {
            $sql = "delete from " . self::model()->getTableName() . " where events_parent = ".$event->events_parent." and events_position > ".$event->events_position."";

            self::model()->db->sqlQuery($sql);
        }

        $event->delete();
        return $room;
    }

    /*
    * if delete parent set all child events as parent
    */
    public static function updateParents($eventId){
        $sql = "update " . self::model()->getTableName() . " set events_recurring = 0, events_parent = 0 where events_parent =".$eventId;
        self::model()->db->sqlQuery($sql);
    }

}
