<?php


namespace App\Observer;


use Elementary\Events\API\ObserverDataInterface;
use Elementary\Events\API\ObserverInterface;
use Elementary\Request\Request;
use Elementary\Response\API\ResponseInterface;
use Elementary\Response\JsonResponse;

class AfterControllerExecute implements ObserverInterface
{

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function execute(ObserverDataInterface $observerData): void
    {
        /** @var JsonResponse $response */
        $response = $observerData->getData('response');
        $response->set([
            'name' => 'Elementary',
            'version' => '1.0.0',
            'message' => 'Hola!! That\'s hello in Spanish.'
        ]);
        echo $response->send();
    }

}