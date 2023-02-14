<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Services\GoodService;

/**
 * @package App\Http\Controllers
 * @category controllers
 *
 * class DefaultController - controller class for surfing thought pages
 */
class DefaultController extends Controller
{
    /**
     * @param GoodService $goodService
     */
    public function __construct(
        private GoodService $goodService
    )
    {
    }

    /**
     * Action for home page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $goods = $this->goodService->getCategories(array_keys(Good::GOODS_TYPES));
        return view('pages.home', ['goods' => $goods]);
    }
}
