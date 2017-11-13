<?php

require_once __DIR__ . '/../AbstractApiTestClass.php';

/**
 * User test class
 * User: alex
 * Date: 11/10/17
 * Time: 8:59 AM
 */
class UserTest extends AbstractApiTestClass
{
    public function testFindNotFound()
    {
        $id = 'not_exist_login';

        $testModel = $this->getTestModel();
        $result = $testModel->findByLogin($id);

        $this->assertNull($result);
    }

    public function testFindFound()
    {
        $id = 'admin';

        $testModel = $this->getTestModel();
        $result = $testModel->findByLogin($id);

        $this->assertInstanceOf('User', $result);
        $this->assertEquals(1, $result->users_id);
    }

    private function getTestModel()
    {
        $testModel = new User();
        $refObject = new ReflectionObject($testModel);
        $refProperty = $refObject->getProperty('db');
        $refProperty->setAccessible( true );
        $refProperty->setValue($testModel, $this->conn->getConnection());

        return $testModel;
    }

}
