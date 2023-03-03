<?php

namespace Condividendo\LaravelCBI\Enums\PaymentRequest;

use BenSampo\Enum\Enum;

/**
 * @property string $value
 * @method static self DEBT() On debtor side
 *
 */
final class RegulatoryReporting extends Enum
{
    public const DEBT = 'DEBT';
}
