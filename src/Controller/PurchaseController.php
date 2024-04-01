<?php

namespace App\Controller;

use App\Controller\Dto\PurchaseRequest;
use App\Repository\ProductRepository;
use App\Service\DtoLoader;
use App\Service\PriceCalculator;
use App\Service\PurchaseProcessor;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PurchaseController extends BaseController
{
    #[Route('/purchase', name: 'app_purchase')]
    public function index(
        Request $request,
        DtoLoader $dtoLoader,
        ValidatorInterface $validator,
        PurchaseProcessor $purchaseProcessor,
        PriceCalculator $priceCalculator,
        ProductRepository $productRepository
    ): JsonResponse {
        /** @var PurchaseRequest $dtoRequest */
        $dtoRequest = $dtoLoader->loadFromRequest($request, PurchaseRequest::class);
        $errors = $validator->validate($dtoRequest);
        if ($errors->count()) {
            return $this->failOnValidation($errors);
        }
        $productPrice = $productRepository->find($dtoRequest->getProductId())->getPrice();
        $price = $priceCalculator->calculate($productPrice, $dtoRequest->getTaxNumber(), $dtoRequest->getCouponCode());
        $purchaseProcessor->purchase($price, $dtoRequest->getPaymentProcessor());
        return $this->success(['success' => true]);
    }
}
