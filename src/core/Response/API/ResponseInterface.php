<?php


namespace Elementary\Response\API;


interface ResponseInterface
{
    /**
     * @return string
     *
     * Sends the generated response.
     */
    public function send() : string;
}