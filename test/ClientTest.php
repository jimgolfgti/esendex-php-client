<?php
namespace Esendex\Client\Test;

use Esendex\Client\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    function retrievingInboxMessages()
    {
        $inboxPage = new \Esendex\Model\InboxPage(0, 0);

        $service = $this
            ->getMockBuilder("\\Esendex\\InboxService")
            ->disableOriginalConstructor()
            ->getMock();
        $service
            ->expects($this->once())
            ->method("latest")
            ->will($this->returnValue($inboxPage));

        $container = $this
            ->getMockBuilder("\\DI\\Container")
            ->disableOriginalConstructor()
            ->getMock();
        $container
            ->expects($this->once())
            ->method("get")
            ->with("Esendex\\InboxService")
            ->will($this->returnValue($service));

        $client = new Client($container);
        $result = $client->getInboxMessages();

        $this->assertSame($inboxPage, $result);
    }

    /**
     * test
     */
    public function iocWiringWorksAsExpected()
    {
        $client = \Esendex\Client\ClientFactory::create("user@example.com", "secret", "EX998877");
        $client->getInboxMessages();
    }
}
