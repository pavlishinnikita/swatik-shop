<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

/**
 * @package App\Http\Controllers
 * @category controllers
 *
 * class Controller - controller with base logic before every action call
 */
class Controller extends BaseController
{
    /**
     * @param $method
     * @param $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        try {
            $response = Http::get('https://api.mcsrvstat.us/2/' . env('RCON_HOST'));
            session('server_players', json_encode($response->json()['players'] ?? ['online' => 0, 'max' => env('MAX_PLAYERS')]));
        } catch (\Exception $e) {
            logger()->error("Error during getting server players info: " . $e->getMessage());
        }

        return parent::callAction($method, $parameters);
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
