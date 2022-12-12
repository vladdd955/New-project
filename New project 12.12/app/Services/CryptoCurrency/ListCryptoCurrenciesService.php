<?php

namespace App\Services\CryptoCurrency;

use App\Models\Collections\CryptoCurrenciesCollection;
use App\Models\CryptoCurrency;
use App\Repository\CoinMarketCapCryptoCurrencyRepository;
use App\Repository\CryptoCurrenciesRepository;

class ListCryptoCurrenciesService
{
    private  CryptoCurrenciesRepository $cryptoCurrenciesRepository;

    public function __construct()
    {
        $this->cryptoCurrenciesRepository = new CoinMarketCapCryptoCurrencyRepository();
    }

    public function execute(array $symbols): CryptoCurrenciesCollection
    {
        $cryptoCurrencies = $this->cryptoCurrenciesRepository->fetchAllBySymbols($symbols);
        foreach ($cryptoCurrencies as $cryptoCurrency) {
            $quote = $this->cryptoCurrenciesRepository->fetchAllBySymbols($cryptoCurrency->getSymbol());
            $cryptoCurrency->setQuote($quote);
        }
        return $cryptoCurrencies;
    }
}