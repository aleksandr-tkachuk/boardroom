<?php
class db_new extends PDO{

    /*
    * db constructor (connect to database)
    */
	public function __construct($config){
		$dsn = $config['driver'] .
			':host=' . $config['host'] .
			((!empty($config['port'])) ? (';port=' . $config['port']) : '') .
			';dbname=' . $config['dbname'] .
			((!empty($config['charset'])) ? (';charset=' . $config['charset']) : '');

		parent::__construct($dsn, $config['username'], $config['password']);
	}

    /*
    * run request select and return rows
    */
	public function select($sql, $single = false){
		if(trim($sql) == "") return [];

		$result = $this->query($sql, PDO::FETCH_ASSOC);

                $rows = [];
		foreach ($result as $row) {
			$rows[] = $row;
		}

		if($single){
			return (isset($rows[0])) ? $rows[0] : [];
		}
        return $rows;
	}

    /*
    * return last insert id
    */
	public function lastId() {
		return $this->lastInsertId();
	}

    /*
    * run sql request
    */
	public function sqlQuery($sql) {
		return $this->exec($sql);
	}

    /*
    * return mysql error info
    */
	public function getError() {
		return $this->errorInfo();
	}

}

