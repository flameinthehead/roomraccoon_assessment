<?php

namespace App\DTO;

use App\Storage\StorageInterface;

class ShopItemDTO implements StorageDTOInterface
{
    public string $name;
    public string $amount;
    public bool $isChecked = false;
    public ?string $id = null;

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'amount' => $this->amount,
            'isChecked' => $this->isChecked,
            'id' => $this->id,
        ];
    }
}