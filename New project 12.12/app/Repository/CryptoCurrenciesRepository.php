<?php


namespace App\Repository;

use App\Models\Collections\CryptoCurrenciesCollection;

interface CryptoCurrenciesRepository
{
    public function fetchAllBySymbols(array $symbols): CryptoCurrenciesCollection;
}

