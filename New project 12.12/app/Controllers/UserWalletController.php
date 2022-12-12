<?php


namespace App\Controllers;

use App\Models\Collections\CryptoCurrenciesCollection;
use App\Models\UserPageRequest;
use App\Repository\DatabaseRepository;
use App\Session;
use App\Template;

class UserWalletController
{
    public function showPage(): Template
    {


        return new Template("userPage.twig", [

            "wallet"=>$this->wallet()->all()

        ]);
    }

    public function wallet(): CryptoCurrenciesCollection
    {
        $id = $_SESSION["id"];

//        $id = 10;
        $portfolio = DatabaseRepository::getConnection()->executeQuery('SELECT price, coin_symbol,coin_amount
FROM cryptoWallet WHERE user_id =?', [$id]);
        $walletInfo = $portfolio->fetchAllAssociative();

        $showUserInfo = new CryptoCurrenciesCollection();
        foreach ($walletInfo as $walletsInfo) {
            $showUserInfo->add(new UserPageRequest(
                $walletsInfo["price"],
                $walletsInfo["coin_symbol"],
                $walletsInfo["coin_amount"]
            ));
        }

        return $showUserInfo;
    }
}