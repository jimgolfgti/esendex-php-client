<?php
namespace Esendex\Client;

abstract class Validate
{
    final public static function notNullOrEmpty($value, $identifier)
    {
        if (!isset($value) || strlen($value) == 0)
            throw new \InvalidArgumentException("{$identifier} must be set");
    }
}
