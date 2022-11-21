<?php

namespace App\EventListener;

use App\Event\VoucherEvent;
use App\Service\RuleEngine;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class VoucherCreatedListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            VoucherEvent::VOUCHER_CREATED => 'handleEvent',
        ];
    }

    #[NoReturn] public function handleEvent(VoucherEvent $event): void
    {
        $ruleEngine = new RuleEngine();
        $check = $ruleEngine->validateAny($event->getVoucher()->getType());

        dd($check['message']);
    }
}
