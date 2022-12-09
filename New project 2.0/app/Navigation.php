<?php

namespace App;


class Navigation
{
    private string $navigation;

    public function __construct(string $navigation)
    {

        $this->navigation = $navigation;
    }

    public function getNavigation(): string
    {
        return $this->navigation;
    }
}