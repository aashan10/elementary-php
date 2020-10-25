<?php


namespace App\Observer;


use Elementary\Events\API\ObserverDataInterface;
use Elementary\Events\API\ObserverInterface;
use Elementary\Request\Request;

class BeforeControllerExecute implements ObserverInterface
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * BeforeControllerExecute constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param ObserverDataInterface $observerData
     */
    public function execute(ObserverDataInterface $observerData): void
    {
        header('Content-Type: application/json');
    }

}