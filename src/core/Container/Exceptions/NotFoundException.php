<?php


namespace Elementary\Container\Exceptions;


use Elementary\Exceptions\LocalizedException;
use Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends LocalizedException implements NotFoundExceptionInterface
{

    /** @inheritDoc */
    public function getLocalizedMessage()
    {
        return '';
    }
}