<?php

namespace App\Services;


use App\Models\Article;
use App\Models\Collections\ApiCollection;
use App\Repository\ApiRepository;


class ApiService
{

    public function apiStart(): ApiCollection
    {

        $cryptoApi = (new ApiRepository())->execute();




        $app = new ApiCollection();
        foreach ($cryptoApi->data as $data) {
            $app->add(new Article(
                $data->name,
                $data->quote->USD->price,
                $data->quote->USD->percent_change_24h,
            ));
//            echo "<pre>";
//            var_dump($articles);die;

        }
//        echo "<pre>";
//        var_dump($articles);
        return $app;
    }

}
