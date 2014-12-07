<?php
namespace Esendex\Client\Test;

use \Esendex\Client\ClientFactory;

class ClientFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function constructorParameters()
    {
        return [
            [null, "pass", "ref", "Username must be set"],
            ["", "pass", "ref", "Username must be set"],
            ["user", null, "ref", "Password must be set"],
            ["user", "", "ref", "Password must be set"],
            ["user", "pass", null, "Reference must be set"],
            ["user", "pass", "", "Reference must be set"]
        ];
    }
    
    /**
     * @test
     * @dataProvider constructorParameters
     */
    public function cannotCreateUnuseableClient($user, $pass, $ref, $msg)
    {
        $this->setExpectedException("InvalidArgumentException", $msg);
        ClientFactory::create($user, $pass, $ref);
    }
    
    /**
     * @test
     */
    public function createReturnsExpectedInstance()
    {
        $result = ClientFactory::create("user@example.com", "secret", "EX998877");
        $this->assertInstanceOf("\\Esendex\\Client\\Client", $result);
    }
}
