<?php

namespace App\Http\Controllers;
use Symfony\Component\Yaml\Yaml;
use App\Models\Good;
use App\Services\GoodService;

class TestController extends Controller {
    public function test(GoodService $goodServis){
        $goods = Yaml::parse(file_get_contents(resource_path()."/goods.yaml"));
        dump($goods);
     //   exit;
        foreach ($goods['goods'] as $key => $good) {
           // $goodServis->createGood($good);
           $goodServis->updateGood($good);
        }
    }
}