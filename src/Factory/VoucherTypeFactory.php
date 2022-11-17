<?php

namespace App\Factory;

use App\Entity\VoucherType;
use App\Repository\VoucherTypeRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<VoucherType>
 *
 * @method static VoucherType|Proxy createOne(array $attributes = [])
 * @method static VoucherType[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static VoucherType[]|Proxy[] createSequence(array|callable $sequence)
 * @method static VoucherType|Proxy find(object|array|mixed $criteria)
 * @method static VoucherType|Proxy findOrCreate(array $attributes)
 * @method static VoucherType|Proxy first(string $sortedField = 'id')
 * @method static VoucherType|Proxy last(string $sortedField = 'id')
 * @method static VoucherType|Proxy random(array $attributes = [])
 * @method static VoucherType|Proxy randomOrCreate(array $attributes = [])
 * @method static VoucherType[]|Proxy[] all()
 * @method static VoucherType[]|Proxy[] findBy(array $attributes)
 * @method static VoucherType[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static VoucherType[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static VoucherTypeRepository|RepositoryProxy repository()
 * @method VoucherType|Proxy create(array|callable $attributes = [])
 */
final class VoucherTypeFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->text(10),
            'description' => self::faker()->text(100),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(VoucherType $voucherType): void {})
        ;
    }

    protected static function getClass(): string
    {
        return VoucherType::class;
    }
}
