<?php

namespace App\Service;

use App\Entity\Voucher;

class VoucherRegistryHelper
{
    public function checkIfValid(Voucher $voucher): bool
    {
        $now = new \DateTime();

        return $now >= $voucher->getValidFrom() && $now <= $voucher->getValidUntil();
    }

    public function getVouchersList(array $voucherRegistries): array
    {
        $vouchersList = [];

        foreach ($voucherRegistries as $voucherRegistry) {
            $vouchersList[] = $voucherRegistry->getVoucher();
        }

        return $vouchersList;
    }
}
