<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class BaseController extends AbstractController
{

    protected function failOnValidation(ConstraintViolationListInterface $errors): JsonResponse
    {
        $returnData = [];
        foreach ($errors as $error) {
            $returnData[] = ['path' => $error->getPropertyPath(), 'message' => $error->getMessage()];
        }
        return $this->fail(['errors' => ['validation' => $returnData]]);
    }

    protected function success(mixed $data, int $status = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse($data, $status);
    }

    protected function fail(mixed $data, int $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return new JsonResponse($data, $status);
    }
}