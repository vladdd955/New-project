<?php


namespace App\Models;


use App\Models\Collections\CryptoCurrenciesCollection;


class UserPageRequest extends CryptoCurrenciesCollection
{
    private ?int $price;
    private ?string $coinSymbol;
    private ?int $coinAmount;

    public function __construct(?int $price = null, ?string $coinSymbol = null, ?int $coinAmount = null)
   {

       $this->price = $price;
       $this->coinSymbol = $coinSymbol;
       $this->coinAmount = $coinAmount;
   }


    public function getPrice(): int
    {
        return $this->price;
    }

    public function getCoinSymbol(): string
    {
        return $this->coinSymbol;
    }

    public function getCoinAmount(): int
    {
        return $this->coinAmount;
    }

}

