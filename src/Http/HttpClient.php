<?php
namespace Esendex\Client\Http;

use \Esendex\Authentication\IAuthentication;

class HttpClient implements \Esendex\Http\IHttp
{
    function isSecure($secure = null)
    {
        return false;
    }

    function get($url, IAuthentication $authentication)
    {
        print "get: {$url}";
        return "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<messageheaders startindex=\"0\" count=\"0\" totalcount=\"0\"
                xmlns=\"http://api.esendex.com/ns/\"/>";
    }

    function put($url, IAuthentication $authentication, $data)
    {
        throw \Exception("Not implemented");
    }

    function post($url, IAuthentication $authentication, $data)
    {
        throw \Exception("Not implemented");
    }

    function delete($url, IAuthentication $authentication)
    {
        throw \Exception("Not implemented");
    }
}
