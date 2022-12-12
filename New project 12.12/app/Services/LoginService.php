<?php


namespace App\Services;

use App\Models\LoginServiceRequest;
use App\Redirect;
use App\Repository\DatabaseRepository;

class LoginService
{

    public function getIn(): Redirect
    {
        $email = $_POST["email"];
        $password = md5($_POST["password"]);

        $resultSet = DatabaseRepository::getConnection()->executeQuery('SELECT * FROM users WHERE email = ?', [$email]);
        $user = $resultSet->fetchAssociative();
        $objDB = new LoginServiceRequest(
            $user["id"],
            $user["name"],
            $user["email"],
        );
        if ($email == $user["email"] && $user["password"] == $password) {
            $_SESSION['id'] = $objDB->getId();
            $_SESSION["name"] = $objDB->getName();
            $_SESSION["email"] = $objDB->getEmail();



            return new Redirect("/userPage");
        } else {

            return new Redirect("/authorization");
        }
    }
}