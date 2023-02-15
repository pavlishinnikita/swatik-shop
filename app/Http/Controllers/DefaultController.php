<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Services\GoodService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = $this->goodService->getCategories();
        return view('pages.home', ['categories' => $categories]);
    }
}
