<?php

namespace App\Http\Controllers;

use App\Constants\GoodBuyingProcessConstant;
use App\Http\Requests\OrderDataRequest;
use App\Models\Good;
use App\Services\GoodService;
use App\Services\OrderService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
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
     * @param OrderService $orderService
     */
    public function __construct(
        private GoodService $goodService,
        private OrderService $orderService,
    )
    {
    }

    /**
     * Action for getting good page
     * @param Request $request
     * @return Application|Factory|View
     */
    public function good(Request $request)
    {
        $id = $request->get('id') ?? '';
        $good = $this->goodService->getGood(['id' => $id])[0] ?? null;
        if (empty($good)) {
            throw new NotFoundHttpException('There are no goods.');
        }
        return view('_partials/good_details', ['item' => $good]);
    }

    /**
     * Action for getting good category page
     * @param Request $request
     * @return Application|Factory|View
     */
    public function goodCategory(Request $request)
    {
        $id = $request->get('id') ?? '';
        $categoryWithGood = $this->goodService->getCategories(['id' => $id])[0] ?? null;
        if (empty($categoryWithGood) || (empty($categoryWithGood['goods'] ?? []))) {
            throw new NotFoundHttpException('There are no goods.');
        }
        $view = $this->goodService->getGoodView($categoryWithGood);
        // if category has only one good get that good
        if (count($categoryWithGood['goods']) === 1) {
            $categoryWithGood = $categoryWithGood['goods'][0];
        }
        return view($view, ['item' => $categoryWithGood]);
    }

    /**
     * Action for buying good
     * @param OrderDataRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function buy(OrderDataRequest $request)
    {
        $currentStep = intval($request->get('step')) + 1;
        if ($currentStep === GoodBuyingProcessConstant::STEP_BUY_GOOD) {
            try {
                $order = $this->orderService->createOrder($request->all());
                // get current payment handler depending on payment type and payment method
            } catch (\Exception $e) {
                // send message to client
            }
        }
        return response()->json([
            'step' => $currentStep,
        ]);
    }
}
