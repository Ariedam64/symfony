<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StageRepository::class)
 */
class Stage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $mission;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $adresseMail;

    /**
     * @ORM\ManyToMany(targetEntity=Formation::class, inversedBy="stages")
     */
    private $Formation;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="stages", cascade={"persist"})
     */
    private $entreprises;

    public function __construct()
    {
        $this->Formation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getMission(): ?string
    {
        return $this->mission;
    }

    public function setMission(string $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->adresseMail;
    }

    public function setAdresseMail(string $adresseMail): self
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormation(): Collection
    {
        return $this->Formation;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->Formation->contains($formation)) {
            $this->Formation[] = $formation;
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        $this->Formation->removeElement($formation);

        return $this;
    }

    public function getEntreprises(): ?Entreprise
    {
        return $this->entreprises;
    }

    public function setEntreprises(?Entreprise $entreprises): self
    {
        $this->entreprises = $entreprises;

        return $this;
    }

}
