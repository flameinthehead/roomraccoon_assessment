<?php

namespace App\Validator;

use App\DTO\ShopItemDTO;
use App\DTO\StorageDTOInterface;
use App\Exception\AddShopItemException;
use App\Exception\DelShopItemException;
use App\Exception\EditShopItemException;

class ShopItemValidator implements ValidatorInterface
{
    /**
     * @throws AddShopItemException
     */
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

    /**
     * @throws DelShopItemException
     */
    public function validateDel(): string
    {
        if (!isset($_REQUEST['id']) || $_REQUEST['id'] === '') {
            throw new DelShopItemException('You should pass id for deleting!');
        }

        return trim(htmlspecialchars($_REQUEST['id']));
    }

    /**
     * @throws EditShopItemException
     * @throws AddShopItemException
     */
    public function validationEdit(): StorageDTOInterface
    {
        if (!isset($_REQUEST['id'])) {
            throw new EditShopItemException('You should pass id for edit!');
        }
        return $this->validateAdd();
    }

    public function validationCheck(): string
    {
        if (!isset($_REQUEST['id']) || $_REQUEST['id'] === '') {
            throw new DelShopItemException('You should pass id for checking!');
        }

        return trim(htmlspecialchars($_REQUEST['id']));
    }
}
