<?php

declare(strict_types=1);

namespace App\Storage;

use App\DTO\StorageDTOInterface;

interface StorageInterface
{
    public function getAll(): array;

    public function add(StorageDTOInterface $storageDTO): bool;

    public function edit(string $key, StorageDTOInterface $storageDTO): bool;

    public function updateField(string $key, string $field, mixed $value): bool;

    public function delete(string $key): void;
}
