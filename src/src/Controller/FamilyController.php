<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FamilyController
 * @package App\Controller
 */
class FamilyController extends AbstractController
{
    /**
     * @Route("/families/{familyId}", methods={"GET"})
     * @param $familyId
     * @return JsonResponse
     */
    public function getFamily($familyId): JsonResponse
    {
        $family = null;

        if ($family) {
            return new JsonResponse([

            ], Response::HTTP_OK);
        } else {
            return new JsonResponse([
                'message' => 'Family - data not found !'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/families", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Family - data created.'
        ], Response::HTTP_CREATED);
    }

    /**
     * @Route("/families/{familyId}", methods={"PUT"})
     * @param $familyId
     * @param Request $request
     * @return JsonResponse
     */
    public function update($familyId, Request $request): JsonResponse
    {
        return new JsonResponse([

        ], Response::HTTP_OK);
    }

    /**
     * @Route("/families/{familyId}", methods={"DELETE"})
     * @param $familyId
     * @return JsonResponse
     */
    public function delete($familyId): JsonResponse
    {
        $family = null;

        if ($family) {
            return new JsonResponse([
                'message' => 'Family - data removed.'
            ], Response::HTTP_NO_CONTENT);
        } else {
            return new JsonResponse([
                'message' => 'Family - data not found.'
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