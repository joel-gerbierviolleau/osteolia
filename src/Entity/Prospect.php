<?php

namespace App\Entity;

use App\Repository\ProspectRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProspectRepository::class)
 */
class Prospect
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *      message = "{{ 'prospect.errors.empty_firstName' | trans }}"
     * )
     */
    private $firstName;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "{{ 'prospect.errors.invalid_email' | trans }}"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $school;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 60,
     *      notInRangeMessage = "prospect.errors.invalid_yop"
     * )
     */
    private $yearsOfPractice;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     * @Assert\Length(
     *      min = 10,
     *      max = 12,
     *      minMessage = "prospect.errors.phoneNumber_too_short",
     *      maxMessage = "prospect.errors.phoneNumber_too_long"
     * )
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isOkToBeContacted;


    public function __construct()
    {

        $this->creationDate = new \DateTime();
        $this->isOkToBeContacted = false;

    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSchool(): ?string
    {
        return $this->school;
    }

    public function setSchool(string $school): self
    {
        $this->school = $school;

        return $this;
    }

    public function getYearsOfPractice(): ?int
    {
        return $this->yearsOfPractice;
    }

    public function setYearsOfPractice(?int $yearsOfPractice): self
    {
        $this->yearsOfPractice = $yearsOfPractice;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

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

    public function getIsOkToBeContacted(): ?bool
    {
        return $this->isOkToBeContacted;
    }

    public function setIsOkToBeContacted(bool $isOkToBeContacted): self
    {
        $this->isOkToBeContacted = $isOkToBeContacted;

        return $this;
    }
}
