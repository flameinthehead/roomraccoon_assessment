<?php

namespace App\Validator;

use App\Exception\AddShopItemException;

class ShopItemValidator implements ValidatorInterface
{
    public function validate(): void
    {
        if (!isset($_REQUEST['name'])) {
            throw new AddShopItemException('You should fill out shopping item name!');
        }

        if (!isset($_REQUEST['amount'])) {
            throw new AddShopItemException('You should fill out shopping item amount!');
        }
    }
}