<?php

declare(strict_types=1);

namespace Ikh\ApiTogetherBundle\DTO;

class Response
{
    private string $model;

    /** @var Choice[] */
    private $choices = [];

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /** Choice[] */
    public function getChoices(): array
    {
        return $this->choices;
    }

    public function setChoices(array $choices): self
    {
        $this->choices = $choices;

        return $this;
    }

    public function __toString(): string
    {
        if (empty($this->choices)) {
            return '';
        }

        return $this->choices[0]
            ->getMessage()
            ->getContent();
    }
}
