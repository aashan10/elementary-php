<?php


namespace Elementary\Events;


use Elementary\Events\API\ObserverDataInterface;
use BadMethodCallException;

class ObserverData implements ObserverDataInterface
{

    protected $data = [];

    /**
     * @param $name
     * @param $argument
     * @return $this|mixed|null
     */
    public function __call($name, $argument)
    {
        $type = strtolower(substr($name, 0, 3));
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', substr($name, 3, strlen($name)), $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        $key =  implode('_', $ret);
        if($type === 'get') {
           return $this->getData($key);
        } else if ( $type === 'set') {
            return $this->setData($key, $argument[0]);
        }
        throw new BadMethodCallException();
    }

    /**
     * @param string $id
     * @return mixed|null
     */
    public function getData(string $id)
    {
        return $this->data[$id] ?? null;
    }

    /**
     * @param string $id
     * @param $data
     * @return $this|mixed
     */
    public function setData(string  $id, $data) {
        $this->data[$id] = $data;
        return $this;
    }

}