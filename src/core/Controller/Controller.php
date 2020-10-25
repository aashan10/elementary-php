<?php


namespace Elementary\Controller;

use Elementary\Controller\API\ControllerInterface;
use Elementary\Response\API\ResponseInterface;

abstract class Controller implements ControllerInterface
{

    /** @inheritDoc */
    abstract public function execute() : ResponseInterface;
}