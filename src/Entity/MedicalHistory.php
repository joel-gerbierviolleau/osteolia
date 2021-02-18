<?php

namespace App\Entity;

use App\Repository\MedicalHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedicalHistoryRepository::class)
 */
class MedicalHistory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Patient::class, inversedBy="medicalHistory", cascade={"persist", "remove"})
     */
    private $patient;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasSurgeryHistory;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasTraumaHistory;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasMedicalTreatmentHistory;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasFamilialHistory;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $surgeryHistoryDetails;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $traumaHistoryDetails;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $medicalTreatmentHistoryDetails;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $familialHistoryDetails;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $regularPhysician;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastUpdateDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $lastUpdatedBy;


    public function __construct()
    {

        $this->creationDate = new \Datetime();

    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getHasSurgeryHistory(): ?bool
    {
        return $this->hasSurgeryHistory;
    }

    public function setHasSurgeryHistory(bool $hasSurgeryHistory): self
    {
        $this->hasSurgeryHistory = $hasSurgeryHistory;

        return $this;
    }

    public function getHasTraumaHistory(): ?bool
    {
        return $this->hasTraumaHistory;
    }

    public function setHasTraumaHistory(bool $hasTraumaHistory): self
    {
        $this->hasTraumaHistory = $hasTraumaHistory;

        return $this;
    }

    public function getHasMedicalTreatmentHistory(): ?bool
    {
        return $this->hasMedicalTreatmentHistory;
    }

    public function setHasMedicalTreatmentHistory(bool $hasMedicalTreatmentHistory): self
    {
        $this->hasMedicalTreatmentHistory = $hasMedicalTreatmentHistory;

        return $this;
    }

    public function getHasFamilialHistory(): ?bool
    {
        return $this->hasFamilialHistory;
    }

    public function setHasFamilialHistory(bool $hasFamilialHistory): self
    {
        $this->hasFamilialHistory = $hasFamilialHistory;

        return $this;
    }

    public function getSurgeryHistoryDetails(): ?string
    {
        return $this->surgeryHistoryDetails;
    }

    public function setSurgeryHistoryDetails(?string $surgeryHistoryDetails): self
    {
        $this->surgeryHistoryDetails = $surgeryHistoryDetails;

        return $this;
    }

    public function getTraumaHistoryDetails(): ?string
    {
        return $this->traumaHistoryDetails;
    }

    public function setTraumaHistoryDetails(?string $traumaHistoryDetails): self
    {
        $this->traumaHistoryDetails = $traumaHistoryDetails;

        return $this;
    }

    public function getMedicalTreatmentHistoryDetails(): ?string
    {
        return $this->medicalTreatmentHistoryDetails;
    }

    public function setMedicalTreatmentHistoryDetails(?string $medicalTreatmentHistoryDetails): self
    {
        $this->medicalTreatmentHistoryDetails = $medicalTreatmentHistoryDetails;

        return $this;
    }

    public function getFamilialHistoryDetails(): ?string
    {
        return $this->familialHistoryDetails;
    }

    public function setFamilialHistoryDetails(?string $familialHistoryDetails): self
    {
        $this->familialHistoryDetails = $familialHistoryDetails;

        return $this;
    }

    public function getRegularPhysician(): ?string
    {
        return $this->regularPhysician;
    }

    public function setRegularPhysician(?string $regularPhysician): self
    {
        $this->regularPhysician = $regularPhysician;

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

}
