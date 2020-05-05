<?php

namespace TestApp;

class BaseController
{
    /** @var array */
    protected $dc;

    public function __construct(array $dc)
    {
        $this->dc = $dc;
    }
}