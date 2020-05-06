<?php

namespace Storage;

interface StorageInterface
{
    public function get(string $id);

    public function create(array $params);
}