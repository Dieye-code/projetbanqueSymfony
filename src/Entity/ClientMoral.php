<?php

namespace App\Entity;

use App\Repository\ClientMoralRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientMoralRepository::class)
 */
class ClientMoral
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $raisonSocial;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity=ClientPhysique::class, mappedBy="clientMoral")
     */
    private $clientPhysiques;

    /**
     * @ORM\OneToMany(targetEntity=Compte::class, mappedBy="clientMoral")
     */
    private $comptes;

    public function __construct()
    {
        $this->clientPhysiques = new ArrayCollection();
        $this->comptes = new ArrayCollection();
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

    public function getRaisonSocial(): ?string
    {
        return $this->raisonSocial;
    }

    public function setRaisonSocial(string $raisonSocial): self
    {
        $this->raisonSocial = $raisonSocial;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Collection|ClientPhysique[]
     */
    public function getClientPhysiques(): Collection
    {
        return $this->clientPhysiques;
    }

    public function addClientPhysique(ClientPhysique $clientPhysique): self
    {
        if (!$this->clientPhysiques->contains($clientPhysique)) {
            $this->clientPhysiques[] = $clientPhysique;
            $clientPhysique->setClientMoral($this);
        }

        return $this;
    }

    public function removeClientPhysique(ClientPhysique $clientPhysique): self
    {
        if ($this->clientPhysiques->contains($clientPhysique)) {
            $this->clientPhysiques->removeElement($clientPhysique);
            // set the owning side to null (unless already changed)
            if ($clientPhysique->getClientMoral() === $this) {
                $clientPhysique->setClientMoral(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Compte $compte): self
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes[] = $compte;
            $compte->setClientMoral($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): self
    {
        if ($this->comptes->contains($compte)) {
            $this->comptes->removeElement($compte);
            // set the owning side to null (unless already changed)
            if ($compte->getClientMoral() === $this) {
                $compte->setClientMoral(null);
            }
        }

        return $this;
    }
}
