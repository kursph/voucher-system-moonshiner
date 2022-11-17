<?php

namespace App\DataFixtures;

use App\Factory\VoucherFactory;
use App\Factory\VoucherTypeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        VoucherFactory::createMany(10, function () {
            return [
                'type' => VoucherTypeFactory::createOne(),
            ];
        });

        $manager->flush();
    }
}
