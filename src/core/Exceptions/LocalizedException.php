<?php


namespace Elementary\Exceptions;

use Exception;

abstract class LocalizedException extends Exception
{

    /**
     * Returns Translated Exception Message.
     */
    abstract public function getLocalizedMessage();

}