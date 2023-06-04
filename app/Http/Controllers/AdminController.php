<?php

namespace App\Http\Controllers;


use App\Models\GoodCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @package App\Http\Controllers
 * @category controllers
 *
 * class AdminController - controller class for operations with admin panel
 */
class AdminController extends Controller
{
    /**
     * Action for getting good page
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('admin/index');
    }
}
