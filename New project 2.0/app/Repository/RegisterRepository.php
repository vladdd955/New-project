<?php

namespace App\Repository;



use App\Services\RegisterServiceRequest;


class RegisterRepository
{

    public function execute(RegisterServiceRequest $request)
    {


        $emailCheck = $request->getEmail();
        $emailToData = DatabaseRepository::getConnection()->executeQuery("SELECT email FROM users WHERE email = '$emailCheck' " )->rowCount();
        if($emailToData == 1){
            die;
        }
        DatabaseRepository::getConnection()->insert(
            "users",
            [
                "name"=>$request->getName(),
                "email"=>$request->getEmail(),
                "password"=>$request->getPassword(),
            ]
        );
    }
}