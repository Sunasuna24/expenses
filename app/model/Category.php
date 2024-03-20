<?php

declare(strict_types=1);

class Category
{
    private $name;
    private $slug;

    public function __construct(string $name, string $slug)
    {
        $this->name = $name;
        $this->slug = $slug;
    }
}