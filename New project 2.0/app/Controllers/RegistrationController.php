<?php

namespace App\Controllers;


use App\Services\RegisterService;
use App\Template;

class RegistrationController
{
    public function showPage(): Template
    {
        return new Template("register.twig");
    }


}