<?php

namespace App\Controller;

use App\Repository\RawClassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RawClassController
 * @package App\Controller
 */
class RawClassController extends AbstractController
{
    /**
     * @var RawClassRepository
     */
    private $rawClassRepository;

    /**
     * RawClassController constructor.
     * @param RawClassRepository $rawClassRepository
     */
    public function __construct(RawClassRepository $rawClassRepository)
    {
        $this->rawClassRepository = $rawClassRepository;
    }

    /**
     * @Route("/classes/{rawClassId}",name="get_rawclass",methods={"GET"})
     * @param $rawClassId
     * @return JsonResponse
     */
    public function getRawClass($rawClassId): JsonResponse
    {
        $rawClass = $this->rawClassRepository->findOneBy([
            'id' => $rawClassId
        ]);

        if ($rawClass) {
            return new JsonResponse([
                'id' => $rawClass->getId(),
                'name' => $rawClass->getName()
            ], Response::HTTP_OK);
        } else {
            return new JsonResponse([
                'message' => 'RawClass - data not found !'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/classes",name="create_rawclass",methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $rawClassName = $data['name'];

        if (empty($rawClassName)) {
            return new JsonResponse([
                'message' => 'Raw Class - name is missing.'
            ], Response::HTTP_BAD_REQUEST);
        } else {
            $this->rawClassRepository->saveRawClass($rawClassName);
            return new JsonResponse([
                'message' => 'RawClass - data created.'
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * @Route("/classes/{rawClassId}",name="update_rawclass",methods={"PUT"})
     * @param $rawClassId
     * @param Request $request
     * @return JsonResponse
     */
    public function update($rawClassId, Request $request): JsonResponse
    {
        $rawClass = $this->rawClassRepository->findOneBy([
            'id' => $rawClassId
        ]);
        $data = json_decode($request->getContent(), true);

        if (empty($data['name'])) {
            return new JsonResponse([
                'message' => 'Raw Class - name is missing.'
            ], Response::HTTP_BAD_REQUEST);
        } else {
            $rawClass->setName($data['name']);
            $this->rawClassRepository->updateRawClass($rawClass);

            return new JsonResponse([
                $rawClass->toArray()
            ], Response::HTTP_OK);
        }
    }

    /**
     * @Route("/classes/{rawClassId}",name="remove_rawclass",methods={"DELETE"})
     * @param $rawClassId
     * @return JsonResponse
     */
    public function delete($rawClassId): JsonResponse
    {
        $rawClass = $this->rawClassRepository->findOneBy([
            'id' => $rawClassId
        ]);

        if ($rawClass) {
            $this->rawClassRepository->removeRawClass($rawClass);

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
     * @Route("/classes",name="getall_rawclasses",methods={"GET"})
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $rawClasses = $this->rawClassRepository->findAll();
        $data = [];

        foreach ($rawClasses as $rawClass) {
            $data[] = [
                'id' => $rawClass->getId(),
                'name' => $rawClass->getName()
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

}
