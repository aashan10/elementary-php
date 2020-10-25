<?php


namespace Elementary\Response;


use Elementary\Response\API\ResponseInterface;

class JsonResponse implements ResponseInterface
{

    protected $params;

    public function send(): string
    {
        return json_encode($this->params);
    }

    public function set($params): self
    {
        $this->params = $params;
        return $this;
    }

}