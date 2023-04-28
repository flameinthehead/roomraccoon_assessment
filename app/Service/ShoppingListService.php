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

    public function edit(string $id, StorageDTOInterface $storageDTO): bool
    {
        return $this->storage->edit($id, $storageDTO);
    }

    public function check(string $id): bool
    {
        return $this->storage->updateField($id, 'isChecked', true);
    }

    public function getStorage(): StorageInterface
    {
        return $this->storage;
    }

    public function del(string $key): void
    {
        $this->storage->delete($key);
    }
}
