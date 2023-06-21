<?php

namespace App\Http\Controllers;

use App\Constants\GoodBuyingProcessConstant;
use App\Http\Requests\OrderDataRequest;
use App\Models\GoodCategory;
use App\Models\Order;
use App\Services\GoodService;
use App\Services\OrderService;
use App\Services\Payment\MonoPaymentService;
use App\Services\Payment\PaymentServiceFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as RequestAlias;
use Symfony\Component\HttpFoundation\Response;
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
     * Action for getting goods list page
     * @param Request $request
     * @return Application|Factory|View
     */
    public function list(Request $request)
    {
        $goodCategories = $this->goodService->getCategories() ?? [];
        if (empty($goodCategories)) {
            throw new NotFoundHttpException('There are no good categories.');
        }
        return view('pages/good/list', ['items' => $goodCategories]);
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
        return view('_partials/good_details', ['item' => $good, 'goodCategoryType' => $good['category']['type'] ?? GoodCategory::TYPE_SIMPLE]);
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
        $goodCategoryType = $categoryWithGood['type'] ?? GoodCategory::TYPE_SIMPLE;
        // if category has only one good get that good
        if (count($categoryWithGood['goods']) === 1) {
            $categoryWithGood = $categoryWithGood['goods'][0];
        }
        return view($view, ['item' => $categoryWithGood, 'goodCategoryType' => $goodCategoryType]);
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
                $requestData = $request->all();
                $order = $this->orderService->createOrder($requestData);
                $paymentService = PaymentServiceFactory::build($requestData['paymentMethod'], $requestData['paymentType']);
                if (empty($paymentService)) {
                    throw new \Exception("Empty payment service for method: {$requestData['paymentMethod']} and type: {$requestData['paymentType']}");
                }
                $result = $paymentService->process($order);
            } catch (\Exception $e) {
                logger()->error('Form (Buying step) error:' . $e->getMessage());
                return response()->json([
                    'step' => intval($request->get('step')),
                    'error' => 'Что-то пошло не так, попробуйте позже.',
                ]);
            }
        }
        return response()->json([
            'step' => $currentStep,
            'data' => $result ?? [],
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function monoWebHook(Request $request)
    {
        if ($request->method() === RequestAlias::METHOD_POST) {
            try {
                $invoiceData = $request->post();
                if (($invoiceData['status'] ?? '') === MonoPaymentService::INVOICE_STATUS_SUCCESS && empty($invoiceData['failureReason'])) {
                    Order::query()->where(['invoice_id' => $invoiceData['invoiceId'] ?? ''])->update(['status' => Order::STATUS_PAID]);
                } elseif (
                    in_array($invoiceData['status'] ?? '', [MonoPaymentService::INVOICE_STATUS_FAILTURE, MonoPaymentService::INVOICE_STATUS_EXPIRED]) ||
                    !empty($invoiceData['failureReason'])
                ) {
                    Order::query()
                        ->where(['invoice_id' => $invoiceData['invoiceId'] ?? ''])
                        ->update(['status' => Order::STATUS_ERROR, 'failure_reason' => $invoiceData['failureReason'] ?? '']);
                    throw new \Exception("Order error: invoice({$invoiceData['invoiceId']}).");
                }
            } catch (\Exception $e) {
                logger()->error('Mono webhook error:' . $e->getMessage(), [
                    'invoice_id' => $request->post()['invoiceId'] ?? '',
                ]);
            }
        }
        return response()->json([
            'status' => 'OK',
            'message' => 'Thanks a lot',
        ]);
    }
}
