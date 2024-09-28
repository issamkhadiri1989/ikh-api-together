<?php

declare(strict_types=1);

namespace Ikh\ApiTogetherBundle\DTO;

class Request
{
    public function __construct(private string $prompt, private ?string $model = null)
    {
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function getPrompt(): string
    {
        return $this->prompt;
    }
}
