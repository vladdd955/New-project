<?php


namespace App\Services;


use App\Navigation;
use App\Repository\RegisterRepository;

class RegisterService
{


    public function start()
    {
        if($_POST['password'] === $_POST['rePassword']) {
            $registerRepository = new RegisterRepository();
            $registerRepository->execute(
                new RegisterServiceRequest(
                    $_POST['name'],
                    $_POST['email'],
                    md5($_POST['password']),


                )
            );

        } else {
            return new Navigation("/register");
        }
        return new Navigation("/authorization",);
    }

}
