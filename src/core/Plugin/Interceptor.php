<?php


namespace Elementary\Plugin;


use BadMethodCallException;
use InvalidArgumentException;

trait Interceptor
{
    protected $plugins;

    public function __construct()
    {
        $this->plugins = json_decode(APP_DIR . '/config/plugins.json', true);
    }

    public function __call($name, $arguments)
    {
        if(method_exists($this, $name)) {
            return $this->intercept($name, $arguments);
        }
        throw new InvalidArgumentException();
    }

    public function intercept($name, $arguments) {
        $methodName = $name;
        $type = 'none';
        if(strpos($name, 'before') === 0) {
            $methodName = substr($name, 5, strlen($methodName));
            $type = 'before';
        } else if (strpos($name, 'after') === 0) {
            $methodName = substr($name, 4, strlen($methodName));
            $type = 'after';
        } else if (strpos($name,'around') === 0) {
            $methodName = substr($name, 5, strlen($methodName));
            $type = 'around';
        }
        $methodName = strtolower($methodName[0]) . substr($methodName, 1);
        if($type === 'before') {

        }
    }
}