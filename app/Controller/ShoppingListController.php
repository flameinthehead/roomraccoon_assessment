<?php

declare(strict_types=1);

namespace App\Controller;

use App\Response;
use App\Service\ShoppingListService;
use App\Validator\ValidatorInterface;

class ShoppingListController
{
    public function __construct(private ShoppingListService $service, private ValidatorInterface $validator)
    {
    }

    public function index(): array
    {
        return [
            'message' => 'OK',
            'code' => Response::HTTP_OK,
            'data' => $this->service->list(),
        ];
    }

    public function add(): array
    {
        $shopItemDTO = $this->validator->validateAdd();
        $this->service->add($shopItemDTO);
        return $this->index();
    }

    public function delete(): array
    {
        $shopItemKey = $this->validator->validateDel();
        $this->service->del($shopItemKey);
    }
}
