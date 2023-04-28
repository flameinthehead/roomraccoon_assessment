<?php

declare(strict_types=1);

namespace App\Controller;

use App\Response;
use App\Service\ShoppingListService;
use App\Validator\ValidatorInterface;
use Throwable;

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

    public function add(): ?array
    {
        try {
            $shopItemDTO = $this->validator->validateAdd();
            $this->service->add($shopItemDTO);
            header('Location: /list');
            return null;
        } catch (Throwable $e) {
            return $this->getValidationErrorResponse($e);
        }
    }

    public function delete(): ?array
    {
        try {
            $shopItemKey = $this->validator->validateDel();
            $this->service->del($shopItemKey);
            header('Location: /list');
            return null;
        } catch (Throwable $e) {
            return $this->getValidationErrorResponse($e);
        }
    }

    public function edit(): ?array
    {
        try {
            $shopItemDTO = $this->validator->validationEdit();
            $this->service->add($shopItemDTO);
            header('Location: /list');
            return null;
        } catch (Throwable $e) {
            return $this->getValidationErrorResponse($e);
        }
    }

    public function check(): ?array
    {
        try {
            $shopItemKey = $this->validator->validateDel();
            $this->service->check($shopItemKey);
            header('Location: /list');
            return null;
        } catch (Throwable $e) {
            return $this->getValidationErrorResponse($e);
        }
    }

    private function getValidationErrorResponse(Throwable $e): array
    {
        return [
            'message' => 'OK',
            'code' => Response::HTTP_OK,
            'data' => $this->service->list(),
            'validation_error' => $e->getMessage()
        ];
    }
}
