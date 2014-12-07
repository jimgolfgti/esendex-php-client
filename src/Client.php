<?php
namespace Esendex\Client;

class Client
{
    private $container;

    /**
     * @param \DI\Container $container
     */
    public function __construct(\DI\Container $container)
    {
        $this->container = $container;
    }

    public function getInboxMessages()
    {
        return $this->container->get("Esendex\\InboxService")->latest();
    }
}
