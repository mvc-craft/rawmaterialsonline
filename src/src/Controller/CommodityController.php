<?php

namespace App\Controller;

use App\Repository\CommodityRepository;
use App\Repository\FamilyRepository;
use App\Repository\RawClassRepository;
use App\Repository\SegmentRepository;
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
     * @var CommodityRepository
     */
    private $commodityRepository;
    private $segmentRepository;
    private $familyRepository;
    private $rawClassRepository;

    /**
     * CommodityController constructor.
     * @param CommodityRepository $commodityRepository
     * @param SegmentRepository $segmentRepository
     * @param FamilyRepository $familyRepository
     * @param RawClassRepository $rawClassRepository
     */
    public function __construct(CommodityRepository $commodityRepository,
        SegmentRepository $segmentRepository,
        FamilyRepository $familyRepository,
        RawClassRepository $rawClassRepository)
    {
        $this->commodityRepository = $commodityRepository;
        $this->segmentRepository = $segmentRepository;
        $this->familyRepository = $familyRepository;
        $this->rawClassRepository = $rawClassRepository;
    }

    /**
     * @Route("/commodities/{commodityId}",name="commodity_get",methods={"GET"})
     * @param $commodityId
     * @return JsonResponse
     */
    public function getCommodity($commodityId): JsonResponse
    {
        $commodity = $this->commodityRepository->findOneBy([
            'id' => $commodityId
        ]);

        if ($commodity) {
            return new JsonResponse([
                'id' => $commodity->getId(),
                'commodity' => $commodity->getName(),
                'segment_id' => $commodity->getSegmentId()->getId(),
                'segment' => $commodity->getSegmentId()->getName(),
                'family_id' => $commodity->getFamilyId()->getId(),
                'family' => $commodity->getFamilyId()->getName(),
                'class_id' => $commodity->getRawClassId()->getId(),
                'class' => $commodity->getRawClassId()->getName()
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
        $data = json_decode($request->getContent(), true);

        if (empty($data['segment_id']) || empty($data['family_id']) || empty($data['class_id']) ||
            empty($data['name'])) {
            return new JsonResponse([
                'message' => 'please provide accurate data to create commodity !'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $commoditySegment = $this->segmentRepository->findOneBy(['id' => $data['segment_id']]);
            $commodityFamily = $this->familyRepository->findOneBy(['id' => $data['family_id']]);
            $commodityRawClass = $this->rawClassRepository->findOneBy(['id' => $data['class_id']]);
            $commodityName = $data['name'];

            if (empty($commoditySegment) || empty($commodityFamily) || empty($commodityRawClass)) {
                return new JsonResponse([
                    'message' => 'Required parameters for Segment or Family or Class field(s) are not aligned to create 
                    the record ! !'
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $this->commodityRepository->saveCommodity($commoditySegment, $commodityFamily, $commodityRawClass,
                $commodityName);

            return new JsonResponse([
                'message' => 'Commodity - data created.'
            ], Response::HTTP_CREATED);
        }

    }

    /**
     * @Route("/commodities/{commodityId}",name="commodity_update",methods={"PUT"})
     * @param $commodityId
     * @param Request $request
     * @return JsonResponse
     */
    public function update($commodityId, Request $request): JsonResponse
    {
        $commodity = $this->commodityRepository->findOneBy(['id' => $commodityId]);
        if ($commodity) {
            $data = json_decode($request->getContent(), true);
            if (empty($data['segment_id']) || empty($data['family_id']) || empty($data['class_id']) ||
                empty($data['name'])) {
                return new JsonResponse([
                    'message' => 'please provide accurate data to create commodity !'
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                $commoditySegment = $this->segmentRepository->findOneBy(['id' => $data['segment_id']]);
                $commodityFamily = $this->familyRepository->findOneBy(['id' => $data['family_id']]);
                $commodityRawClass = $this->rawClassRepository->findOneBy(['id' => $data['class_id']]);
                $commodityName = $data['name'];

                if (empty($commoditySegment) || empty($commodityFamily) || empty($commodityRawClass)) {
                    return new JsonResponse([
                        'message' => 'Required parameters for Segment or Family or Class field(s) are not aligned to 
                        create the record ! !'
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                } else {
                    $commodity->setName($commodityName);
                    $commodity->setSegmentId($commoditySegment);
                    $commodity->setFamilyId($commodityFamily);
                    $commodity->setRawClassId($commodityRawClass);
                    $updatedCommodity = $this->commodityRepository->updateCommodity($commodity);

                    return new JsonResponse([
                        $updatedCommodity->toArray()
                    ], Response::HTTP_OK);
                }
            }
        } else {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/commodities/{commodityId}",name="commodity_remove",methods={"DELETE"})
     * @param $commodityId
     * @return JsonResponse
     */
    public function delete($commodityId): JsonResponse
    {
        $commodity = $this->commodityRepository->findOneBy(['id' => $commodityId]);

        if ($commodity) {
            $this->commodityRepository->removeCommodity($commodity);
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
        $commodities = $this->commodityRepository->findAll();
        $data = [];
        foreach ($commodities as $commodity) {
            $data[] = [
                'id' => $commodity->getId(),
                'commodity' => $commodity->getName(),
                'segment_id' => $commodity->getSegmentId()->getId(),
                'segment' => $commodity->getSegmentId()->getName(),
                'family_id' => $commodity->getFamilyId()->getId(),
                'family' => $commodity->getFamilyId()->getName(),
                'class_id' => $commodity->getRawClassId()->getId(),
                'class' => $commodity->getRawClassId()->getName()
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

}
