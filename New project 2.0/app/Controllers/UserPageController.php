<?php


namespace App\Controllers;


use App\Template;


class UserPageController
{
    public function pageStart(): Template
    {
        return new Template("userPage.twig");
    }
}