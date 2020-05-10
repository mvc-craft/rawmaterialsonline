<?php

namespace App\Controller;

use App\Repository\SegmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
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
     * @var SegmentRepository
     */
    private $segmentRepository;

    /**
     * SegmentController constructor.
     * @param SegmentRepository $segmentRepository
     */
    public function __construct(SegmentRepository $segmentRepository)
    {
        $this->segmentRepository = $segmentRepository;
    }

    /**
     * @Route("/segments/{segmentId}", name="get_segment", methods={"GET"})
     * @param $segmentId
     * @return JsonResponse
     */
    public function getSegment($segmentId): JsonResponse
    {
        $segment = $this->segmentRepository->findOneBy([
            'id' => $segmentId
        ]);

        if ($segment) {
            return new JsonResponse([
                'id' => $segment->getId(),
                'name' => $segment->getName()
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
        $data = json_decode($request->getContent(), true);
        $segmentName = $data['name'];

        if (empty($segmentName)) {
            return new JsonResponse([
                'message' => 'Segment - name is missing.'
            ], Response::HTTP_BAD_REQUEST);
        } else {
            $this->segmentRepository->saveSegment($segmentName);

            return new JsonResponse([
                'message' => 'Segment - data created.'
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * @Route("/segments/{segmentId}", name="update_segment", methods={"PUT"})
     * @param $segmentId
     * @param Request $request
     * @return JsonResponse
     */
    public function update($segmentId, Request $request): JsonResponse
    {
        $segment = $this->segmentRepository->findOneBy([
            'id' => $segmentId
        ]);
        $data = json_decode($request->getContent(), true);

        if (empty($data['name'])) {
            return new JsonResponse([
                'message' => 'Segment - name is missing.'
            ], Response::HTTP_BAD_REQUEST);
        } else {
            $segment->setName($data['name']);
            $updateSegment = $this->segmentRepository->updateSegment($segment);
            return new JsonResponse([
                $updateSegment->toArray()
            ], Response::HTTP_OK);
        }
    }

    /**
     * @Route("/segments/{segmentId}", name="delete_segment", methods={"DELETE"})
     * @param $segmentId
     * @return JsonResponse
     */
    public function delete($segmentId): JsonResponse
    {
        $segment = $this->segmentRepository->findOneBy([
            'id' => $segmentId
        ]);

        if ($segment) {
            $this->segmentRepository->removeSegment($segment);
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
        $segments = $this->segmentRepository->findAll();
        $data = [];
        foreach ($segments as $segment) {
            $data[] = [
                'id' => $segment->getId(),
                'name' => $segment->getName()
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

}
