<?php

namespace App\Controller;

use App\Controller\Dto\CalculatePriceRequest;
use App\Repository\ProductRepository;
use App\Service\DtoLoader;
use App\Service\PriceCalculator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PriceController extends BaseController
{
    #[Route('/calculate-price', name: 'calculate_price')]
    public function calculatePrice(
        Request $request,
        DtoLoader $dtoLoader,
        ValidatorInterface $validator,
        PriceCalculator $priceCalculator,
        ProductRepository $productRepository
    ): JsonResponse {
        /** @var CalculatePriceRequest $dtoRequest */
        $dtoRequest = $dtoLoader->loadFromRequest($request, CalculatePriceRequest::class);
        $errors = $validator->validate($dtoRequest);
        if ($errors->count()) {
            return $this->failOnValidation($errors);
        }

        $productPrice = $productRepository->find($dtoRequest->getProductId())->getPrice();
        $price = $priceCalculator->calculate($productPrice, $dtoRequest->getTaxNumber(), $dtoRequest->getCouponCode());
        return $this->success(['price' => $price]);
    }
}
