<?php

namespace App\Entity;

use App\Repository\VoucherRegistryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: VoucherRegistryRepository::class)]
class VoucherRegistry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $userName = null;

    #[ORM\Column(type: Types::OBJECT)]
    private ?object $voucher = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $registerDate = null;

    use TimestampableEntity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getVoucher(): ?object
    {
        return $this->voucher;
    }

    public function setVoucher(object $voucher): self
    {
        $this->voucher = $voucher;

        return $this;
    }

    public function getRegisterDate(): ?\DateTimeInterface
    {
        return $this->registerDate;
    }

    public function setRegisterDate(\DateTimeInterface $registerDate): self
    {
        $this->registerDate = $registerDate;

        return $this;
    }
}
