<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CommodityController
 * @package App\Controller
 */
class CommodityController extends AbstractController
{
    /**
     * @Route("/commodities/{commodityId}",name="commodity_get",methods={"GET"})
     * @param $commodityId
     * @return JsonResponse
     */
    public function getCommodity($commodityId): JsonResponse
    {
        $commodity = null;

        if ($commodity) {
            return new JsonResponse([

            ], Response::HTTP_OK);
        } else {
            return new JsonResponse([
                'message' => 'Commodity - data not found !'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/commodities",name="commodity_create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Commodity - data created.'
        ], Response::HTTP_CREATED);
    }

    /**
     * @Route("/commodities/{commodityId}",name="commodity_update",methods={"PUT"})
     * @param $commodityId
     * @param Request $request
     * @return JsonResponse
     */
    public function update($commodityId, Request $request): JsonResponse
    {
        return new JsonResponse([

        ], Response::HTTP_OK);
    }

    /**
     * @Route("/commodities/{commodityId}",name="commodity_remove",methods={"DELETE"})
     * @param $commodityId
     * @return JsonResponse
     */
    public function delete($commodityId): JsonResponse
    {
        $commodity = null;

        if ($commodity) {
            return new JsonResponse([
                'message' => 'Commodity - data removed.'
            ], Response::HTTP_NO_CONTENT);
        } else {
            return new JsonResponse([
                'message' => 'Commodity - data not found.'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/commodities",name="getall_commodities",methods={"GET"})
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $data = [];

        return new JsonResponse($data, Response::HTTP_OK);
    }

}
