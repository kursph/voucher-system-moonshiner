<?php

namespace App\Factory;

use App\Entity\Voucher;
use App\Repository\VoucherRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Voucher>
 *
 * @method static Voucher|Proxy createOne(array $attributes = [])
 * @method static Voucher[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Voucher[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Voucher|Proxy find(object|array|mixed $criteria)
 * @method static Voucher|Proxy findOrCreate(array $attributes)
 * @method static Voucher|Proxy first(string $sortedField = 'id')
 * @method static Voucher|Proxy last(string $sortedField = 'id')
 * @method static Voucher|Proxy random(array $attributes = [])
 * @method static Voucher|Proxy randomOrCreate(array $attributes = [])
 * @method static Voucher[]|Proxy[] all()
 * @method static Voucher[]|Proxy[] findBy(array $attributes)
 * @method static Voucher[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Voucher[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static VoucherRepository|RepositoryProxy repository()
 * @method Voucher|Proxy create(array|callable $attributes = [])
 */
final class VoucherFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'title' => self::faker()->text(20),
            'description' => self::faker()->text(100),
            'amount' => self::faker()->randomNumber(2),
            'permanent' => self::faker()->boolean(),
            'validUntil' => self::faker()->dateTime(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Voucher $voucher): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Voucher::class;
    }
}
