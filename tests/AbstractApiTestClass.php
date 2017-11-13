<?php

use PHPUnit\DbUnit\Database\DefaultConnection;

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../libraries/autoloader.php';
require_once __DIR__ . '/../libraries/composer/vendor/autoload.php';

/**
 * Abstract base class for API testing
 * User: alex
 * Date: 11/10/17
 * Time: 8:59 AM
 */
abstract class AbstractApiTestClass extends PHPUnit\DbUnit\TestCase
{
    /**
     * @var array
     */
    public static $config;

    /**
     * @var DefaultConnection
     */
    protected $conn = null;

    /**
     * Returns the test database connection.
     *
     * @return \PHPUnit\DbUnit\Database\Connection
     */
    protected function getConnection()
    {
        if ($this->conn === null) {
            $pdo = new db_new(self::$config["db_test"][self::$config["db_test"]["type"]]);

            $this->conn = $this->createDefaultDBConnection($pdo, self::$config["db_test"][TYPE_DB]["dbname"]);
        }

        return $this->conn;
    }

    /**
     * Returns the test dataset.
     *
     * @return \PHPUnit\DbUnit\DataSet\IDataSet
     */
    protected function getDataSet()
    {
        return $this->createMySQLXMLDataSet(dirname(__FILE__). '/user/_files/boardroom_test.xml');
    }
}

AbstractApiTestClass::$config = $config;