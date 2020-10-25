<?php


namespace Elementary\Events\Exceptions;


use Elementary\Exceptions\LocalizedException;

class ObserverMustImplementObserverInterfaceException extends LocalizedException
{
    public function getLocalizedMessage()
    {
        return 'Invalid Observer type. The observer must implement ObserverInterface.';
    }

}