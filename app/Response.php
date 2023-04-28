<?php

declare(strict_types=1);

namespace App;

class Response
{
    public const HTTP_OK = 200;
    public const HTTP_BAD_REQUEST = 400;
    public const HTTP_NOT_FOUND = 404;

    private const CONTENT_TYPE_JSON = 'Content-Type: application/json; charset=utf-8';
    private const CONTENT_TYPE_HTML = 'Content-Type: text/html; charset=utf-8';

    private int $status;
    private array $renderData;
    private string $answerType;
    private string $viewPath;

    public function __construct(
        string $viewPath,
        int $status = null,
        array $renderData = null,
        string $answerType = null
    ) {
        $this->viewPath = Kernel::getConfigKey(Kernel::CONFIG_KEY_VIEW_PATH) . '/' . $viewPath;
        $this->status = $status ?? self::HTTP_OK;
        $this->renderData = $renderData ?? [];
        $this->answerType = $answerType ?? self::CONTENT_TYPE_HTML;
    }

    public function render(): void
    {
        http_response_code($this->status);
        header($this->answerType);
        $renderData = $this->renderData;
        include_once $this->viewPath . '.php';
    }
}
