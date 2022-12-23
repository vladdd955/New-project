<?php


namespace App\Controllers;




use App\Services\CryptoCurrency\ListCryptoCurrenciesService;
use App\Services\CryptoCurrency\ListCryptoService;
use App\Template;

class CryptoCurrencyController
{
    private ListCryptoCurrenciesService $listCryptoCurrenciesService;
    private ListCryptoService $listCryptoService;

    public function __construct(ListCryptoCurrenciesService $listCryptoCurrenciesService,
                                ListCryptoService $listCryptoService)
    {
        $this->listCryptoCurrenciesService = $listCryptoCurrenciesService;
        $this->listCryptoService = $listCryptoService;
    }



    public function index(): Template
    {
        $service = $this->listCryptoCurrenciesService->execute(
            explode("," , $_GET["symbols"] ?? "BTC,ETH,LTC,DOGE,XRP,ADA,DOT,TRX,UNI,ATOM"
            )
        );

//        $walletInfo = (new CryptoTradeRepository())->showWallet();
        return new Template("index.twig", [
            'app' => $service->all(),
//            "walletInfo"=>$walletInfo,
        ]);
    }

    public function showForm(array $vars): Template
    {

        $service = $this->listCryptoService->execute(
            $vars["symbol"]
        );
//        echo "<pre>";
//        var_dump($service);die;
        return new Template("tradePage.twig", [
             "app"=>[$service],
            "coin"=>(new TransferController())->showTransfer(),
        ]);

    }

}


