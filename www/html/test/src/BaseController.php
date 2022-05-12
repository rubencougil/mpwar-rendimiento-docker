<?php

namespace Test;

class BaseController
{
    /** @var array */
    protected array $dc;

    public function __construct(array $dc)
    {
        $this->dc = $dc;
    }
}