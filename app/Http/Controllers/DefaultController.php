<?php

namespace App\Http\Controllers;

/**
 * @package App\Http\Controllers
 * @category controllers
 *
 * class DefaultController - controller class for surfing thought pages
 */
class DefaultController extends Controller
{
    /**
     * Action for home page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('pages.home');
    }
}
