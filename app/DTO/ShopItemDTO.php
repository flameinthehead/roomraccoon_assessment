<?php

namespace App\DTO;

use App\Storage\StorageInterface;

class ShopItemDTO implements StorageDTOInterface
{
    public string $name;
    public string $amount;

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'amount' => $this->amount
        ];
    }
}