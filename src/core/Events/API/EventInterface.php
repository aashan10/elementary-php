<?php


namespace Elementary\Events\API;


interface EventInterface
{
    public function dispatch(string $name, $data);
}