<?php

namespace Condividendo\LaravelCBI\Enums\PaymentRequest;

use BenSampo\Enum\Enum;

/**
 * @property string $value
 * @method static self NORM() Normal priority
 * @method static self HIGH() Fast payment (same day)
 * 
 */
final class PaymentPriority extends Enum
{
    public const NORM = 'NORM';
    public const HIGH = 'HIGH';
}