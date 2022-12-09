<?php


namespace App\Controllers;


use App\Services\ApiService;
use App\Template;


class ApiController

{
    public function index(): Template
    {

        $app = (new ApiService())->apiStart();
        return new Template("index.twig",
        [
            "app"=>$app->get(),
        ],
        );
    }
}