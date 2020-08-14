<?php

namespace App\Entity;

use App\Repository\ClientPhysiqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientPhysiqueRepository::class)
 */
class ClientPhysique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $salaire;

    /**
     * @ORM\ManyToOne(targetEntity=TypeClient::class, inversedBy="clientMoral")
     */
    private $typeClient;

    /**
     * @ORM\ManyToOne(targetEntity=ClientMoral::class, inversedBy="clientPhysiques")
     */
    private $clientMoral;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(?int $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getTypeClient(): ?TypeClient
    {
        return $this->typeClient;
    }

    public function setTypeClient(?TypeClient $typeClient): self
    {
        $this->typeClient = $typeClient;

        return $this;
    }

    public function getClientMoral(): ?ClientPhysique
    {
        return $this->clientMoral;
    }

    public function setClientMoral(?ClientPhysique $clientMoral): self
    {
        $this->clientMoral = $clientMoral;

        return $this;
    }
}
