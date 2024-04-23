<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $cashprize = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_start_inscrip = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_end_inscrip = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_end = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCashprize(): ?int
    {
        return $this->cashprize;
    }

    public function setCashprize(int $cashprize): static
    {
        $this->cashprize = $cashprize;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeInterface $date_start): static
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateStartInscrip(): ?\DateTimeInterface
    {
        return $this->date_start_inscrip;
    }

    public function setDateStartInscrip(\DateTimeInterface $date_start_inscrip): static
    {
        $this->date_start_inscrip = $date_start_inscrip;

        return $this;
    }

    public function getDateEndInscrip(): ?\DateTimeInterface
    {
        return $this->date_end_inscrip;
    }

    public function setDateEndInscrip(\DateTimeInterface $date_end_inscrip): static
    {
        $this->date_end_inscrip = $date_end_inscrip;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(\DateTimeInterface $date_end): static
    {
        $this->date_end = $date_end;

        return $this;
    }
}
