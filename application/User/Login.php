<?php


namespace User;


class Login
{
    private $get;

    public function __construct(string $method, string $value, string $password)
    {
        $this->get = new Model\Get();
    }

}