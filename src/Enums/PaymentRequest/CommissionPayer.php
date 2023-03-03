<?php

namespace Condividendo\LaravelCBI\Enums\PaymentRequest;

use BenSampo\Enum\Enum;

/**
 * @property string $value
 * @method static self SLEV() The payment commission will be charged on the debtor. For SEPA, this is the only possible value.
 *
 */
final class CommissionPayer extends Enum
{
    public const SLEV = 'SLEV';
}
