<?php

namespace App\Event;

use App\Entity\Voucher;
use Symfony\Contracts\EventDispatcher\Event;

class VoucherEvent extends Event
{
    const VOUCHER_CREATED = 'voucher.created';

    private string $eventName;

    private Voucher $voucher;

    public function __construct(string $eventName, Voucher $voucher)
    {
        $this->eventName = $eventName;
        $this->voucher = $voucher;
    }

    public function getEventName(): string
    {
        return $this->eventName;
    }

    public function getVoucher(): Voucher
    {
        return $this->voucher;
    }
}
