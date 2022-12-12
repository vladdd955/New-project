<?php


namespace App\Services;

namespace App\Services;

use App\Models\RegisterServiceRequest;
use App\Redirect;
use App\Repository\DatabaseRepository;

class RegisterService
{

    public function execute(RegisterServiceRequest $request): Redirect
    {
        $userEmail = $request->getEmail();
        $emailFrom_DB = DatabaseRepository::getConnection()->executeQuery("SELECT email FROM users WHERE email = '$userEmail' ")->rowCount();
        if ($emailFrom_DB == 1) {
            $_SESSION['errorMessage'] = "This email already in DB";
            return new Redirect("register.twig");
        }

        DatabaseRepository::getConnection()->insert('users', [
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'password' => md5($request->getPassword()),
        ]);
        $registerEmail = $request->getEmail();
        if (1 == DatabaseRepository::getConnection()->executeQuery("SELECT email FROM users WHERE email = '$registerEmail' ")->rowCount()) {

            $_SESSION['greetings'] = "{$request->getname()} you successfully registered.";
            return new Redirect("register.twig");
        }
        return new Redirect("register.twig");
    }
}
