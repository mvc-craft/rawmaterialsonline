<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SegmentController
 * @package App\Controller
 */
class SegmentController extends AbstractController
{
    /**
     * @Route("/segments/{segmentId}", name="get_segment", methods={"GET"})
     * @param $segmentId
     * @return JsonResponse
     */
    public function getSegment($segmentId): JsonResponse
    {
        $segment = null;

        if ($segment) {
            return new JsonResponse([

            ], Response::HTTP_OK);
        } else {
            return new JsonResponse([
                'message' => 'Segment - data not found !'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/segments", name="create_segment", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Segment - data created.'
        ], Response::HTTP_CREATED);
    }

    /**
     * @Route("/segments/{segmentId}", name="update_segment", methods={"PUT"})
     * @param $segmentId
     * @param Request $request
     * @return JsonResponse
     */
    public function update($segmentId, Request $request): JsonResponse
    {
        return new JsonResponse([

        ], Response::HTTP_OK);
    }

    /**
     * @Route("/segments/{segmentId}", name="delete_segment", methods={"DELETE"})
     * @param $segmentId
     * @return JsonResponse
     */
    public function delete($segmentId): JsonResponse
    {
        $segment = null;

        if ($segment) {
            return new JsonResponse([
                'message' => 'Segment - data removed.'
            ], Response::HTTP_NO_CONTENT);
        } else {
            return new JsonResponse([
                'message' => 'Segment - data not found.'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/segments", name="getall_segment",methods={"GET"})
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $data = [];

        return new JsonResponse($data, Response::HTTP_OK);
    }

}
