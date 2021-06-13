<?php

namespace Storage;

class Storage implements StorageInterface
{
    /** @var StorageInterface */
    private StorageInterface $db;

    /** @var StorageInterface */
    private StorageInterface $cache;

    public function __construct(StorageInterface $db, StorageInterface $cache)
    {
        $this->db = $db;
        $this->cache = $cache;
    }

    public function get(string $id)
    {
        if ($this->cache->get($id)) {
            return $this->cache->get($id);
        }
        return $this->db->get($id);
    }

    public function create(array $params): void
    {
        $this->db->create($params);
        $this->cache->create($params);
    }
}
