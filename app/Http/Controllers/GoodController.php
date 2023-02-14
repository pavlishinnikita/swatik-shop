<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Services\GoodService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @package App\Http\Controllers
 * @category controllers
 *
 * class GoodController - controller class for operations with goods
 */
class GoodController extends Controller
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
     * @param Request $request
     * @return Application|Factory|View
     */
    public function good(Request $request)
    {
        $type = intval($request->get('type') ?? 0);
        $id = $request->get('id') ?? '';
        $categoryWithGood = $this->goodService->getCategories([$type], [])[0] ?? null;
        $view = match ($type) {
            Good::TYPE_PRIVILEGE, Good::TYPE_CASE => '_partials/good_type_goods',
            Good::TYPE_SIMPLE, Good::TYPE_SHELLS => '_partials/good_details',
            default => ''
        };
        if (empty($view) || empty($categoryWithGood)) {
            throw new NotFoundHttpException('There are no goods.');
        }
        return view($view, ['item' => $categoryWithGood, 'goodType' => $type]);
    }

    /**
     * Action for buying good
     * @param Request $request
     * @return Application|Factory|View|void
     */
    public function buy(Request $request)
    {
        // get good by id
        if ($request->isMethod('post')) {
            // buying logic
        } else {
            return view('_partials/good_payment');
        }
    }
}
