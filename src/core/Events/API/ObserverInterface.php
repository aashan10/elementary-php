<?php


namespace Elementary\Events\API;


interface ObserverInterface
{
    public function execute(ObserverDataInterface $observerData) : void;
}