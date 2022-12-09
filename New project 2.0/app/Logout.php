<?php


namespace App;


class Logout
{
    public function Logout(): Navigation
    {
        session_destroy();
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['id']);
        return new Navigation("/");
    }
}