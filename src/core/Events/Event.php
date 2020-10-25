<?php


namespace Elementary\Events;


use Elementary\App;
use ReflectionException;
use Elementary\Events\API\EventInterface;
use Elementary\Events\API\ObserverInterface;
use Elementary\Events\API\ObserverDataInterface;
use Elementary\Container\Exceptions\NotFoundException;
use Elementary\Events\Exceptions\ObserverMustImplementObserverInterfaceException;

class Event implements EventInterface
{
    /**
     * @var array
     *
     */
    protected $events = [];

    /**
     * Event constructor.
     */
    public function __construct()
    {
        $path = APP_DIR . '/config/events.json';
        if(file_exists($path)) {
            $this->events = json_decode(file_get_contents(APP_DIR . '/config/events.json'), true)['events'];
        } else {
            $this->events = [];
        }
    }

    /**
     * @param string $name
     * @param mixed ...$args
     * @throws ObserverMustImplementObserverInterfaceException
     */
    public function dispatch(string $name, $args)
    {
        if(in_array($name, array_keys($this->events))) {
            $app = App::initialize();

            /** @var ObserverDataInterface $observerData */
            $observerData = $app->create(ObserverDataInterface::class);
            foreach ($args as $key => $arg) {
                $observerData->setData($key, $arg);
            }

            foreach ($this->events[$name] as $key => $observer) {
                if(class_exists($observer) && in_array(ObserverInterface::class, class_implements($observer))) {
                    $observer = $app->get($observer);
                    /** @var  ObserverInterface $observer */
                    $observer->execute($observerData);
                } else {
                   throw new ObserverMustImplementObserverInterfaceException();
                }
            }
        }
    }

}