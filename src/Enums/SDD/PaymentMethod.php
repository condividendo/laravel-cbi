<?php

namespace Condividendo\LaravelCBI\Enums\SDD;

use BenSampo\Enum\Enum;

/**
 * @property string $value
 * @method static self DD() Direct Debit to be received from a debtor
 * 
 */
final class PaymentMethod extends Enum
{
    public const DD = 'DD';
}
