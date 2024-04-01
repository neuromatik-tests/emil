<?php

namespace App\Service;

use Exception;
use Symfony\Component\HttpFoundation\Request;

class DtoLoader
{

    /**
     * @throws Exception
     */
    public function loadFromRequest(Request $request, string $dtoClass): object
    {
        try {
            $data = json_decode($request->getContent(), true);
        } catch (Exception) {
            throw new Exception('Invalid JSON');
        }

        if (!class_exists($dtoClass)) {
            throw new Exception('Class ' . $dtoClass . ' does not exist');
        }

        $dtoObject = new $dtoClass();
        foreach ($data as $key => $value) {
            $methodName = 'set' . ucfirst($key);
            if (method_exists($dtoObject, $methodName)) {
                $dtoObject->{$methodName}($value);
            }
        }
        return $dtoObject;
    }
}