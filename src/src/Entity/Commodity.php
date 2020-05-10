<?php

namespace App\Entity;

use App\Repository\CommodityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommodityRepository::class)
 */
class Commodity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Segment::class, inversedBy="commodities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $segment_id;

    /**
     * @ORM\ManyToOne(targetEntity=Family::class, inversedBy="commodities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $family_id;

    /**
     * @ORM\ManyToOne(targetEntity=RawClass::class, inversedBy="commodities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $raw_class_id;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'segment' => $this->getSegmentId()->getName(),
            'family' => $this->getFamilyId()->getName(),
            'class' => $this->getRawClassId()->getName(),
            'name' => $this->getName()
        ];
    }

    public function getSegmentId(): ?Segment
    {
        return $this->segment_id;
    }

    public function setSegmentId(?Segment $segment_id): self
    {
        $this->segment_id = $segment_id;

        return $this;
    }

    public function getFamilyId(): ?Family
    {
        return $this->family_id;
    }

    public function setFamilyId(?Family $family_id): self
    {
        $this->family_id = $family_id;

        return $this;
    }

    public function getRawClassId(): ?RawClass
    {
        return $this->raw_class_id;
    }

    public function setRawClassId(?RawClass $raw_class_id): self
    {
        $this->raw_class_id = $raw_class_id;

        return $this;
    }
}
