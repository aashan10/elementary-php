<?php


namespace Elementary\Container;


use Elementary\Container\Exceptions\NotFoundException;
use Psr\Container\ContainerInterface;
use ReflectionException;
use ReflectionClass;

class Container implements ContainerInterface
{
    /**
     * @var array
     *
     * Array of created objects.
     */
    protected $objects = [];

    /**
     * @var array|mixed
     *
     * Container Configurations.
     */
    protected $config = [
        'override' => [],
        'alias' => []
    ];


    /**
     * Container constructor.
     */
    public function __construct()
    {
        $this->config = json_decode(file_get_contents(APP_DIR . '/config/di.json'), true);
    }


    /**
     * @param $id
     * @return object
     * @throws NotFoundException
     * @throws ReflectionException
     */
    public function get($id)
    {
        if($id instanceof \ReflectionParameter && (class_exists($id->getClass()->name) || interface_exists($id->getClass()->name))) {
            $id = $id->getClass()->name;
        }
        if($this->has($id))  {
            return in_array($id, array_keys($this->objects)) ? $this->objects[$id] : $this->objects[$this->config['alias'][$id]];
        }
        $this->objects[$id] = $this->create($id);
        return $this->objects[$id];
    }

    /**
     * @param $id
     * @return bool
     */
    public function has($id)
    {
        $availableObjects = array_keys($this->objects);
        if(in_array($id, $availableObjects)) {
            return true;
        }
        if(is_string($id) && isset($this->config['alias'][$id]) && in_array($this->config['alias'][$id], $availableObjects)) {
            return true;
        } else if ($id instanceof \ReflectionParameter) {
            $type = $id->getType();
            if(class_exists($type) && $this->has($type)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $id
     * @return object
     * @throws NotFoundException
     * @throws ReflectionException
     */
    public function create($id)
    {
        if(class_exists($id) || interface_exists($id)) {
            if(array_key_exists($id,$this->config['override'])) {
                $id = $this->config['override'][$id];
            }
            return $this->resolve($id);
        } else if (in_array($id, $this->config['alias'])) {
            return $this->create($this->config['alias'][$id]);
        }

        print_r($id);
        echo ("Class Not Found " .  $id);
        throw new NotFoundException();
    }

    /**
     * @param $className
     * @return object
     * @throws ReflectionException
     * @throws NotFoundException
     */
    protected function resolve($className) {
        $reflectionClass = new ReflectionClass($className);
        if($reflectionClass->getConstructor()) {
            $constructorPrams = $reflectionClass->getConstructor()->getParameters();
            $params = [];
            foreach ($constructorPrams as $key => $param) {
                if($param->allowsNull()) {
                    $params[$key] = null;
                } else {
                    $params[] = $this->get($param);
                }
            }
            return $reflectionClass->newInstanceArgs($params);
        }
        return $reflectionClass->newInstance();
    }
}