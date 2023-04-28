<?php

declare(strict_types=1);

namespace App\Storage;

use App\DTO\StorageDTOInterface;
use App\Exception\StorageException;
use App\Kernel;
use Predis\Client;

class RedisStorage implements StorageInterface
{
    public function __construct()
    {
        $this->storage = Kernel::storage();
        if(!$this->storage instanceof Client){
            throw new StorageException('Init RedisStorage failed');
        }
    }

    public function add(StorageDTOInterface $storageDTO): bool
    {
        if(is_array($value)){
            $status = $this->storage->hmset($key, $value);
        } else {
            $status = $this->storage->set($key, $value);
        }

        return ($status->getPayload() == 'OK');
    }

    public function getAll(): array
    {
        $list = $this->storage->keys('');
        $result = [];
        foreach ($list as $key) {
            $result[] = $this->find($key, true);
        }

        return $result;
    }

    public function find($key, $isHash = false)
    {
        if(!$isHash){
            return $this->storage->get($key);
        }

        return $this->storage->hgetall($key);
    }
}
