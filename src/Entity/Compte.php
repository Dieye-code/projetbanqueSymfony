<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompteRepository::class)
 */
class Compte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $clerib;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $numero;

    /**
     * @ORM\Column(type="integer")
     */
    private $solde;

    /**
     * @ORM\ManyToOne(targetEntity=ClientPhysique::class)
     */
    private $clientPhysique;

    /**
     * @ORM\ManyToOne(targetEntity=ClientMoral::class, inversedBy="comptes")
     */
    private $clientMoral;

    /**
     * @ORM\ManyToOne(targetEntity=TypeCompte::class, inversedBy="comptes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeCompte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClerib(): ?string
    {
        return $this->clerib;
    }

    public function setClerib(string $clerib): self
    {
        $this->clerib = $clerib;

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

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getClientPhysique(): ?ClientPhysique
    {
        return $this->clientPhysique;
    }

    public function setClientPhysique(?ClientPhysique $clientPhysique): self
    {
        $this->clientPhysique = $clientPhysique;

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

    public function getTypeCompte(): ?TypeCompte
    {
        return $this->typeCompte;
    }

    public function setTypeCompte(?TypeCompte $typeCompte): self
    {
        $this->typeCompte = $typeCompte;

        return $this;
    }
}
