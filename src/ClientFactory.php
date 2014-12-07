<?php
namespace Esendex\Client;

use \Esendex\Authentication\LoginAuthentication;

abstract class ClientFactory
{
    final public static function create($username, $password, $reference)
    {
        Validate::notNullOrEmpty($username, "Username");
        Validate::notNullOrEmpty($password, "Password");
        Validate::notNullOrEmpty($reference, "Reference");

        $container = ClientFactory::initialiseContainer();
        $container->set(
            "Esendex\\Authentication\\IAuthentication",
            new LoginAuthentication($reference, $username, $password)
        );

        return $container->get("Esendex\\Client\\Client");
    }

    final private static function initialiseContainer()
    {
        $builder = new \DI\ContainerBuilder();
        $builder->setDefinitionCache(new \Doctrine\Common\Cache\ArrayCache());

        $container = $builder->build();
        $container->set(
            "Esendex\\Http\\IHttp",
            \DI\object("Esendex\\Client\\Http\\HttpClient")
                ->scope(\DI\Scope::PROTOTYPE())
        );

        $container->set("Esendex\\CheckAccessService", \DI\object()
            ->constructorParameter("httpClient", \DI\link("Esendex\\Http\\IHttp")));
        $container->set("Esendex\\DispatchService", \DI\object()
            ->constructorParameter("httpClient", \DI\link("Esendex\\Http\\IHttp")));
        $container->set("Esendex\\InboxService", \DI\object()
            ->constructorParameter("httpClient", \DI\link("Esendex\\Http\\IHttp")));
        $container->set("Esendex\\MessageBodyService", \DI\object()
            ->constructorParameter("httpClient", \DI\link("Esendex\\Http\\IHttp")));
        $container->set("Esendex\\MessageHeaderService", \DI\object()
            ->constructorParameter("httpClient", \DI\link("Esendex\\Http\\IHttp")));
        $container->set("Esendex\\SentMessagesService", \DI\object()
            ->constructorParameter("httpClient", \DI\link("Esendex\\Http\\IHttp")));

        return $container;
    }
}
