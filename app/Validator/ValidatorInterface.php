<?php

namespace App\Validator;

use App\DTO\StorageDTOInterface;

interface ValidatorInterface
{
    public function validateAdd(): StorageDTOInterface;

    public function validateDel(): string;

    public function validationEdit(): StorageDTOInterface;

    public function validationCheck(): string;
}