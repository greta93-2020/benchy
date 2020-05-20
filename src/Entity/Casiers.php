<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Casiers
 *
 * @ORM\Table(name="casiers", indexes={@ORM\Index(name="FK_Type", columns={"type"})})
 * @ORM\Entity(repositoryClass="App\Repository\CasiersRepository")
 */
class Casiers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=true)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="remarque", type="string", length=100, nullable=true)
     */
    private $remarque;

    /**
     * @var \TypeCasier
     *
     * @ORM\ManyToOne(targetEntity="TypeCasier", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type", referencedColumnName="id")
     * })
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="tag", type="boolean", nullable=false)
     */
    private $tag;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Ordre", type="integer", nullable=true)
     */
    private $ordre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    public function getType(): ?TypeCasier
    {
        return $this->type;
    }

    public function setType(?TypeCasier $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTag(): ?bool
    {
        return $this->tag;
    }

    public function setTag(bool $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(?int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

}
