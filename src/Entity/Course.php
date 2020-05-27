<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 */
class Course
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $step_one;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $step_two;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $step_three;

     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=CourseType::class, inversedBy="courses")
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStepOne(): ?string
    {
        return $this->step_one;
    }

    public function setStepOne(string $step_one): self
    {
        $this->step_one = $step_one;

        return $this;
    }

    public function getStepTwo(): ?string
    {
        return $this->step_two;
    }

    public function setStepTwo(string $step_two): self
    {
        $this->step_two = $step_two;

        return $this;
    }

    public function getStepThree(): ?string
    {
        return $this->step_three;
    }

    public function setStepThree(string $step_three): self
    {
        $this->step_three = $step_three;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getType(): ?CourseType
    {
        return $this->type;
    }

    public function setType(?CourseType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
