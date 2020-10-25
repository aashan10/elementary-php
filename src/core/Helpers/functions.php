<?php


use Elementary\App;
use Elementary\Container\Exceptions\NotFoundException;

/**
 * @return App
 * @throws ReflectionException
 * @throws NotFoundException
 */
function app()
{
    return App::initialize();
}