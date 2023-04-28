<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\StorageDTOInterface;
use App\Storage\StorageInterface;

class ShoppingListService
{
    public function __construct(private StorageInterface $storage)
    {
    }

    public function list(): array
    {
        return $this->storage->getAll();
    }

    public function add(StorageDTOInterface $storageDTO): bool
    {
        return $this->storage->add($storageDTO);
    }

    public function del(string $key): void
    {
        $this->storage->delete($key);
    }
}
