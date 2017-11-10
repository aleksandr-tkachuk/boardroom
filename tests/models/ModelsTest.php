<?php

require_once __DIR__ . '/../../libraries/autoloader.php';
require_once __DIR__ . '/../../libraries/composer/vendor/autoload.php';
require_once __DIR__ . '/../../config/config.php';

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11/10/17
 * Time: 8:59 AM
 */
class ModelsTest extends PHPUnit\DbUnit\TestCase
{
    protected $conn = null;
    public static $config;

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
        return $this->createMySQLXMLDataSet(dirname(__FILE__). '/_files/boardroom_test.xml');
    }

    public function testReadAllEmptyUsers()
    {
        $user = $this->getUser();

        $this->conn->getConnection()->query('TRUNCATE TABLE `users`');

        $this->assertCount(0, $user->findAll());
    }

    /**
     * @dataProvider optionsProvider
     */
    public function testReadUsersByCondtitions($params, $orders, $count, $expectedOrderBy = [])
    {
        $user = $this->getUser();

        $users = $user->findAll($params, $orders);

        $this->assertCount($count, $users);

        if ($orders && $expectedOrderBy) {
            $values = array_column($users, array_keys($orders)[0], 'users_id');

            $this->assertEquals($expectedOrderBy, array_keys($values));
        }
    }

    public function optionsProvider()
    {
        return [
            [[],[],4],
            [['users_id' => 100],[],0],
            [['users_id' => 2],[],1],
            [['users_id' => 100, 'users_name' => 'Admin'],[],0],
            [['users_id' => 1, 'users_name' => 'Admin'],[],1],
            [['users_id' => 1, 'users_name' => 'Admin'],[],1],
            [[],['users_id' => 'ASC'],4,['1','2','4','5']],
            [[],['users_id' => 'DESC'],4,['5','4','2','1']],
            [[],['users_name' => 'ASC', 'users_login' => 'ASC'],4,['1','5','4','2']],
            [[],['users_name' => 'DESC', 'users_login' => 'DESC'],4,['2','4','5','1']],
            [[],['users_name' => 'DESC', 'users_login' => 'ASC'],4,['2','4','5','1']],
            [[],['users_name' => 'ASC', 'users_login' => 'DESC'],4,['1','5','4','2']],
        ];
    }

    private function getUser()
    {
        $user = new User();
        $refObject   = new ReflectionObject( $user );
        $refProperty = $refObject->getProperty( 'db' );
        $refProperty->setAccessible( true );
        $refProperty->setValue($user, $this->conn->getConnection());

        return $user;
    }
}

ModelsTest::$config = $config;
