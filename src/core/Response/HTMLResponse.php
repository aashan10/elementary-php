<?php


namespace Elementary\Response;


use Elementary\Response\API\ResponseInterface;

class HTMLResponse implements ResponseInterface
{

    public function send(): string
    {
        return "Hello!";
    }

}