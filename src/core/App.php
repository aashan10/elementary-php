<?php


namespace Elementary;

use Elementary\Container\Container;
use Elementary\Container\Exceptions\NotFoundException;
use Elementary\Request\API\RequestInterface;
use ReflectionException;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class App
{
    /**
     * @var Container
     */
    protected $container;

    protected static $instance;

    /**
     * App constructor.
     * @throws NotFoundException
     * @throws ReflectionException
     */
    protected function __construct()
    {
        $this->container = new Container();
        $this->initializeRequest();
        $this->initializePrettyErrors();
    }

    /**
     * @return static
     * @throws NotFoundException
     * @throws ReflectionException
     */
    public static function initialize(): self
    {
        if (static::$instance == null) {
            static::$instance = new App();
        }
        return static::$instance;
    }

    /**
     * @throws NotFoundException
     * @throws ReflectionException
     */
    public function initializeRequest()
    {
        $this->container->get(RequestInterface::class);
    }

    /**
     * @throws NotFoundException
     * @throws ReflectionException
     */
    public function initializePrettyErrors()
    {
        $whoops = $this->container->create(Run::class);
        $whoops->pushHandler($this->container->create(JsonResponseHandler::class));
        $whoops->pushHandler($this->container->create(PrettyPageHandler::class));
        $whoops->register();
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id)
    {
        return $this->container->has($id);
    }

    /**
     * @param string $id
     * @return object
     * @throws NotFoundException
     * @throws ReflectionException
     */
    public function get(string $id)
    {
        return $this->container->get($id);
    }

    /**
     * @param string $id
     * @return object
     * @throws NotFoundException
     * @throws ReflectionException
     */
    public function create(string $id)
    {
        return $this->container->create($id);
    }
}
