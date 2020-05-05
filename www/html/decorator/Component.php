<?php

namespace Decorator;

class Component implements ComponentInterface
{
    public function operation(): string
    {
        return 'Component';
    }
}
