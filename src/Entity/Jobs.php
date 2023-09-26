<?php

namespace App\Entity;

use App\Repository\JobsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobsRepository::class)]
class Jobs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    private ?string $deadline = null;

    #[ORM\Column]
    private ?int $status = null;

    #[ORM\Column]
    private ?int $assigned = null;

    #[ORM\Column]
    private ?int $createdby = null;

    #[ORM\Column]
    private ?int $assessment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getDeadline(): ?string
    {
        return $this->deadline;
    }

    public function setDeadline(string $deadline): static
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getAssigned(): ?int
    {
        return $this->assigned;
    }

    public function setAssigned(int $assigned): static
    {
        $this->assigned = $assigned;

        return $this;
    }

    public function getCreatedby(): ?int
    {
        return $this->createdby;
    }

    public function setCreatedby(int $createdby): static
    {
        $this->createdby = $createdby;

        return $this;
    }

    public function getAssessment(): ?int
    {
        return $this->assessment;
    }

    public function setAssessment(int $assessment): static
    {
        $this->assessment = $assessment;

        return $this;
    }
}
