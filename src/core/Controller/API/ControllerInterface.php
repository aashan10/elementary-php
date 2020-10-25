<?php


namespace Elementary\Controller\API;

use Elementary\Response\API\ResponseInterface;

interface ControllerInterface
{
    /**
     * @return ResponseInterface
     *
     * Executes this method for the specified route.
     */
    public function execute() : ResponseInterface;
}