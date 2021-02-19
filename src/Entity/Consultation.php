<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConsultationRepository::class)
 */
class Consultation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $anamnesia;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $procedures;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="consultations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="consultations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastUpdateDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="consultations")
     */
    private $lastUpdatedBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletionDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="consultations")
     */
    private $deletedBy;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDeleted;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $toDo;


    public function __construct()
    {
        $this->creationDate = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnamnesia(): ?string
    {
        return $this->anamnesia;
    }

    public function setAnamnesia(?string $anamnesia): self
    {
        $this->anamnesia = $anamnesia;

        return $this;
    }

    public function getProcedures(): ?string
    {
        return $this->procedures;
    }

    public function setProcedures(?string $procedures): self
    {
        $this->procedures = $procedures;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getLastUpdateDate(): ?\DateTimeInterface
    {
        return $this->lastUpdateDate;
    }

    public function setLastUpdateDate(?\DateTimeInterface $lastUpdateDate): self
    {
        $this->lastUpdateDate = $lastUpdateDate;

        return $this;
    }

    public function getLastUpdatedBy(): ?User
    {
        return $this->lastUpdatedBy;
    }

    public function setLastUpdatedBy(?User $lastUpdatedBy): self
    {
        $this->lastUpdatedBy = $lastUpdatedBy;

        return $this;
    }

    public function getDeletionDate(): ?\DateTimeInterface
    {
        return $this->deletionDate;
    }

    public function setDeletionDate(?\DateTimeInterface $deletionDate): self
    {
        $this->deletionDate = $deletionDate;

        return $this;
    }

    public function getDeletedBy(): ?User
    {
        return $this->deletedBy;
    }

    public function setDeletedBy(?User $deletedBy): self
    {
        $this->deletedBy = $deletedBy;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(?bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getToDo(): ?string
    {
        return $this->toDo;
    }

    public function setToDo(?string $toDo): self
    {
        $this->toDo = $toDo;

        return $this;
    }
}
