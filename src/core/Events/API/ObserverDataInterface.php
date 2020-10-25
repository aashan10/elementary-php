<?php


namespace Elementary\Events\API;


interface ObserverDataInterface
{
    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments);

    /**
     * Returns data passed through events.
     *
     * @param string $id
     * @return mixed|null
     */
    public function getData(string $id);

    /**
     * @param string $id
     * @param $data
     * @return mixed
     */
    public function setData(string $id, $data);
}