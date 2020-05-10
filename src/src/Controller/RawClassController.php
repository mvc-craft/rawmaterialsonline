<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RawClassController
 * @package App\Controller
 */
class RawClassController extends AbstractController
{
    /**
     * @param $rawClassId
     * @return JsonResponse
     */
    public function getRawClass($rawClassId): JsonResponse
    {
        $rawClass = null;

        if ($rawClass) {
            return new JsonResponse([

            ], Response::HTTP_OK);
        } else {
            return new JsonResponse([
                'message' => 'RawClass - data not found !'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        return new JsonResponse([
            'message' => 'RawClass - data created.'
        ], Response::HTTP_CREATED);
    }

    /**
     * @param $rawClassId
     * @param Request $request
     * @return JsonResponse
     */
    public function update($rawClassId, Request $request): JsonResponse
    {
        return new JsonResponse([

        ], Response::HTTP_OK);
    }

    /**
     * @param $rawClassId
     * @return JsonResponse
     */
    public function delete($rawClassId): JsonResponse
    {
        $rawClass = null;

        if ($rawClass) {
            return new JsonResponse([
                'message' => 'RawClass - data removed.'
            ], Response::HTTP_NO_CONTENT);
        } else {
            return new JsonResponse([
                'message' => 'RawClass - data not found.'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $data = [];

        return new JsonResponse($data, Response::HTTP_OK);
    }

}
