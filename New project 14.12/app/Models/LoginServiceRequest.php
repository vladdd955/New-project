<?php

namespace App\Models;

class LoginServiceRequest
{
    private string $id;
    private string $name;
    private string $email;
//    private float $money;


    public function __construct(string $id,
                                string $name,
                                string $email,
//                                float $money,
                                            )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
//        $this->money = $money;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return $this->id;
    }

//    public function getMoney(): float
//    {
//        return $this->money;
//    }
}