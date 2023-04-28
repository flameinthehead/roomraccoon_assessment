<?php

declare(strict_types=1);

namespace App\Storage;

use App\DTO\StorageDTOInterface;
use App\Exception\StorageException;
use App\Kernel;
use Predis\Client;
use Ramsey\Uuid\Uuid;

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
        $status = $this->storage->hmset('shoppingList_' . Uuid::uuid4(), $storageDTO->toArray());
        return ($status->getPayload() === 'OK');
    }

    public function getAll(): array
    {
        $list = $this->storage->keys('shoppingList_*');

        $result = [];
        foreach ($list as $key) {
            $result[$key] = $this->find($key, true);
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

    public function delete(string $key): void
    {
        $this->storage->del($key);
    }

    public function edit(string $key, StorageDTOInterface $storageDTO): bool
    {
        $status = $this->storage->hmset($key, $storageDTO->toArray());
        return ($status->getPayload() === 'OK');
    }
}
