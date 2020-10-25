<?php


namespace Elementary\Request\API;


interface RequestInterface
{
    /**
     * @param string $key
     * @return string|null
     *
     * Returns GET request parameter with the given key.
     */
    public function get(string $key) : ?string;

    /**
     * @param string $key
     * @return string|null
     *
     * Returns POST request parameter with the given key.
     */
    public function post(string $key) : ?string;

    /**
     * @return array|null
     *
     * Returns all request parameters.
     */
    public function all() : ?array;

}