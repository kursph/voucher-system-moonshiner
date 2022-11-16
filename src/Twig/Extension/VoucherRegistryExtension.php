<?php

namespace App\Twig\Extension;

use App\Entity\Voucher;
use App\Service\VoucherRegistryHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class VoucherRegistryExtension extends AbstractExtension
{
    private VoucherRegistryHelper $voucherRegistryHelper;

    public function __construct(VoucherRegistryHelper $voucherRegistryHelper)
    {
        $this->voucherRegistryHelper = $voucherRegistryHelper;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('voucher_registry_check_if_valid', [$this, 'checkIfValid']),
        ];
    }

    public function checkIfValid(Voucher $voucher): bool
    {
        return $this->voucherRegistryHelper->checkIfValid($voucher);
    }
}
