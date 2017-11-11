<?php

use PHPUnit\DbUnit\Operation\Truncate;

require_once __DIR__ . '/../../libraries/autoloader.php';
require_once __DIR__ . '/../../libraries/composer/vendor/autoload.php';
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/Stub/TestModelsClass.php';

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11/10/17
 * Time: 8:59 AM
 */
class ModelsTest extends PHPUnit\DbUnit\TestCase
{
    public static $config;

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
        return $this->createMySQLXMLDataSet(dirname(__FILE__). '/_files/boardroom_test.xml');
    }

    public function testReadAllEmptyUsers()
    {
        $testModel = $this->getTestModel();

        $truncateOperation = new Truncate();
        $truncateOperation->execute($this->getConnection(), $this->getDataSet());

        $this->assertCount(0, $testModel->findAll());
    }

    /**
     * @dataProvider optionsProvider
     */
    public function testReadUsersByCondtitions($params, $orders, $count, $expectedOrderBy = [])
    {
        $testModel = $this->getTestModel();

        $users = $testModel->findAll($params, $orders);

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

    public function testFindNotFound()
    {
        $id = 100;

        $testModel = $this->getTestModel();
        $result = $testModel->find($id);

        $this->assertNull($result);
    }

    public function testFindFound()
    {
        $id = 1;

        $testModel = $this->getTestModel();
        $result = $testModel->find($id);

        $this->assertInstanceOf('TestModelsClass', $result);
        $this->assertEquals(1, $result->users_id);
    }

    public function testSaveInsertWithoutId()
    {
        $testModel = $this->getTestModel();

        $testModel->users_name = 'Test name';
        $testModel->users_login = 'Test login';
        $testModel->users_password = 'Test password';

        $result = $testModel->save();

        $this->assertTrue($result);
        $this->assertEquals(5, $this->getConnection()->getRowCount('users'), "Inserting failed");
    }

    public function testSaveUpdateModelExist()
    {
        $testModel = $this->getTestModel();

        $testModel->users_id = 1;
        $testModel->users_name = 'Test name1';
        $testModel->users_login = 'Test login1';
        $testModel->users_password = 'Test password1';

        $result = $testModel->save();

        $this->assertEquals(1, $result);
        $this->assertEquals(4, $this->getConnection()->getRowCount('users'), "Update failed");

        $updatedUser = $testModel->find(1);

        $this->assertEquals(1, $updatedUser->users_id);
        $this->assertEquals('Test name1', $updatedUser->users_name);
        $this->assertEquals('Test login1', $updatedUser->users_login);
        $this->assertEquals('Test password1', $updatedUser->users_password);
    }

    public function testSaveUpdateModelNotExist()
    {
        $testModel = $this->getTestModel();

        $testModel->users_id = 100;
        $testModel->users_name = 'Test name1';
        $testModel->users_login = 'Test login1';
        $testModel->users_password = 'Test password1';

        $result = $testModel->save();

        $this->assertEquals(0, $result);
        $this->assertEquals(4, $this->getConnection()->getRowCount('users'), "Update failed");
    }

    public function testDeleteModelExist()
    {
        $testModel = $this->getTestModel();
        $testModel->users_id = 1;

        $result = $testModel->delete();
        $this->assertTrue($result);
        $this->assertEquals(3, $this->getConnection()->getRowCount('users'), "Delete failed");
    }

    public function testDeleteModelNotExist()
    {
        $testModel = $this->getTestModel();
        $testModel->users_id = 100;

        $result = $testModel->delete();
        $this->assertTrue($result);
        $this->assertEquals(4, $this->getConnection()->getRowCount('users'), "Delete failed");
    }

    private function getTestModel()
    {
        $testModel = new TestModelsClass();
        $refObject = new ReflectionObject($testModel);
        $refProperty = $refObject->getProperty('db');
        $refProperty->setAccessible( true );
        $refProperty->setValue($testModel, $this->conn->getConnection());

        return $testModel;
    }
}

ModelsTest::$config = $config;