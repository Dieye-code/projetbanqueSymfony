<?php

namespace App\Entity;

use App\Repository\TypeClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeClientRepository::class)
 */
class TypeClient
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=ClientPhysique::class, mappedBy="typeClient")
     */
    private $clientPhysiques;

    public function __construct()
    {
        $this->clientPhysiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|ClientPhysique[]
     */
    public function getClientPhysiques(): Collection
    {
        return $this->clientPhysiques;
    }

    public function addClientMoral(ClientPhysique $clientMoral): self
    {
        if (!$this->clientPhysiques->contains($clientMoral)) {
            $this->clientPhysiques[] = $clientMoral;
            $clientMoral->setTypeClient($this);
        }

        return $this;
    }

    public function removeClientPhysique(ClientPhysique $clientPhysique): self
    {
        if ($this->clientPhysiques->contains($clientPhysique)) {
            $this->clientPhysiques->removeElement($clientPhysique);
            // set the owning side to null (unless already changed)
            if ($clientPhysique->getTypeClient() === $this) {
                $clientPhysique->setTypeClient(null);
            }
        }

        return $this;
    }
}
