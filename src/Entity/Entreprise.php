<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 4,
     *      minMessage = "Le nom de l'entreprise doit faire au moins {{ limit }} caractères",
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=25)
    * @Assert\NotBlank
     */
    private $activite;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="# [0-9]{5} #",
     *     message="Il semble y avoir un problème avec le code postal"
     * )
     * @Assert\Regex(
     *     pattern="# (avenue|all[eé]e|rue|place|boulevard|impasse|route) #i",
     *     message="Le type de route/voie semble incorrect"
     * )
     * @Assert\Regex(
     *     pattern="#^[0-9]{1,4} ?(bis|ter|quater)? #i",
     *     message="Le numéro de rue semble incorrect"
     * )

     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     * @Assert\Url
     * @Assert\Regex(
     *     pattern="#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si",
     *     message="Cette valeur n'est pas une URL valide "
     * )
     */
    private $siteWeb;

    /**
     * @ORM\OneToMany(targetEntity=Stage::class, mappedBy="entreprises")
     */
    private $stages;

    public function __construct()
    {
        $this->stages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): self
    {
        $this->activite = $activite;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->siteWeb;
    }

    public function setSiteWeb(string $siteWeb): self
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(Stage $stage): self
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->setEntreprises($this);
        }

        return $this;
    }

    public function removeStage(Stage $stage): self
    {
        if ($this->stages->removeElement($stage)) {
            // set the owning side to null (unless already changed)
            if ($stage->getEntreprises() === $this) {
                $stage->setEntreprises(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->getNom();
    }
}
