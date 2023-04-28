<?php

namespace App\DTO;

use App\Storage\StorageInterface;

class ShopItemDTO implements StorageDTOInterface
{
    public string $title;
    public string $amount;

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'amount' => $this->amount
        ];
    }
}