<?php

namespace App\Controller;

use App\Repository\FamilyRepository;
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
     * @var FamilyRepository
     */
    private $familyRepository;

    /**
     * FamilyController constructor.
     * @param FamilyRepository $familyRepository
     */
    public function __construct(FamilyRepository $familyRepository)
    {
        $this->familyRepository = $familyRepository;
    }

    /**
     * @Route("/families/{familyId}", methods={"GET"})
     * @param $familyId
     * @return JsonResponse
     */
    public function getFamily($familyId): JsonResponse
    {
        $family = $this->familyRepository->findOneBy([
            'id' => $familyId
        ]);

        if ($family) {
            return new JsonResponse([
                'id' => $family->getId(),
                'name' => $family->getName()
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
        $data = json_decode($request->getContent(), true);
        $familyName = $data['name'];

        if (empty($familyName)) {
            return new JsonResponse([
                'message' => 'Family - name is missing.'
            ], Response::HTTP_BAD_REQUEST);
        } else {
            $this->familyRepository->saveFamily($familyName);

            return new JsonResponse([
                'message' => 'Family - data created.'
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * @Route("/families/{familyId}", methods={"PUT"})
     * @param $familyId
     * @param Request $request
     * @return JsonResponse
     */
    public function update($familyId, Request $request): JsonResponse
    {
        $family = $this->familyRepository->findOneBy([
            'id' => $familyId
        ]);
        $data = json_decode($request->getContent(), true);

        if (empty($data['name'])) {
            return new JsonResponse([
                'message' => 'Family - name is missing.'
            ], Response::HTTP_BAD_REQUEST);
        } else {
            $family->setName($data['name']);
            $updateFamily = $this->familyRepository->updateFamily($family);

            return new JsonResponse([
                $updateFamily->toArray()
            ], Response::HTTP_OK);
        }
    }

    /**
     * @Route("/families/{familyId}", methods={"DELETE"})
     * @param $familyId
     * @return JsonResponse
     */
    public function delete($familyId): JsonResponse
    {
        $family = $this->familyRepository->findOneBy([
            'id' => $familyId
        ]);

        if ($family) {
            $this->familyRepository->removeFamily($family);

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
     * @Route("/families", name="getall_families",methods={"GET"})
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $families = $this->familyRepository->findAll();
        $data = [];

        foreach ($families as $family) {
            $data[] = [
                'id' => $family->getId(),
                'name' => $family->getName()
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

}