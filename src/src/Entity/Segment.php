<?php

namespace App\Entity;

use App\Repository\SegmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SegmentRepository::class)
 */
class Segment
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
     * @ORM\OneToMany(targetEntity=Commodity::class, mappedBy="segment_id", orphanRemoval=true)
     */
    private $commodities;

    /**
     * Segment constructor.
     */
    public function __construct()
    {
        $this->commodities = new ArrayCollection();
    }

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
            'name' => $this->getName()
        ];
    }

    /**
     * @return Collection|Commodity[]
     */
    public function getCommodities(): Collection
    {
        return $this->commodities;
    }

    public function addCommodity(Commodity $commodity): self
    {
        if (!$this->commodities->contains($commodity)) {
            $this->commodities[] = $commodity;
            $commodity->setSegmentId($this);
        }

        return $this;
    }

    public function removeCommodity(Commodity $commodity): self
    {
        if ($this->commodities->contains($commodity)) {
            $this->commodities->removeElement($commodity);
            // set the owning side to null (unless already changed)
            if ($commodity->getSegmentId() === $this) {
                $commodity->setSegmentId(null);
            }
        }

        return $this;
    }
}
