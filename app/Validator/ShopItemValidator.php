<?php

namespace App\Validator;

use App\DTO\ShopItemDTO;
use App\DTO\StorageDTOInterface;
use App\Exception\AddShopItemException;

class ShopItemValidator implements ValidatorInterface
{
    public function validateAdd(): StorageDTOInterface
    {
        if (!isset($_REQUEST['name']) || $_REQUEST['name'] === '') {
            throw new AddShopItemException('You should fill out shopping item name!');
        }

        if (!isset($_REQUEST['amount']) || $_REQUEST['amount'] === '') {
            throw new AddShopItemException('You should fill out shopping item amount!');
        }

        $shopItemDTO = new ShopItemDTO();
        $shopItemDTO->name = trim(htmlspecialchars($_REQUEST['name']));
        $shopItemDTO->amount = trim(htmlspecialchars($_REQUEST['amount']));

        return $shopItemDTO;
    }

    public function validateDel(): string
    {
        if (!isset($_REQUEST['id']) || $_REQUEST['id'] === '') {
            throw new AddShopItemException('You should pass id for delete!');
        }

        return trim(htmlspecialchars($_REQUEST['id']));
    }
}