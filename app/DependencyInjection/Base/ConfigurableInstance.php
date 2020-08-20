<?php

namespace App\DependencyInjection\Base;

interface ConfigurableInstance
{
    static function getInstance();

    function setProperty(string $key, $value);

    function getProperty(string $key);

    function printPropertyValue(string $key);
}