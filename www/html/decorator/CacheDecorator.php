<?php

namespace Decorator;

class CacheDecorator extends Decorator
{
    public function operation(): string
    {
        return 'CacheDecorator(' . parent::operation() . ')';
    }
}