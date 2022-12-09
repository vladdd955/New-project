<?php


namespace App\Controllers;



use App\Database;
use App\Navigation;
use App\Repository\DatabaseRepository;
use App\Template;

class AuthorizationController
{
    public function showPage(): Template
    {
        return new Template("authorization.twig");
    }

    public function checkLogin(): Navigation
    {
        $email =   $_POST['email'];
        $password = md5($_POST['password']);


        $result = DatabaseRepository::getConnection()->executeQuery('SELECT  * FROM users WHERE email = ?', [$email]);
        $user = $result->fetchAssociative();


        if ($email == $user['email'] && $user['password'] == $password) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $user['id'];


            return new Navigation("/userPage");
        } else {
            return new Navigation("/register");

        }
    }
}