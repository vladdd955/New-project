<?php

namespace App\Models;


class Article
{
    private string $name;
    private float $price;
    private float $percent_change_24h;

    public function __construct(string $name, float $price, float $percent_change_24h)
    {

        $this->name = $name;
        $this->price = $price;
        $this->percent_change_24h = $percent_change_24h;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getPercentChange24h(): float
    {
        return $this->percent_change_24h;
    }
}
