<?php

namespace Condividendo\LaravelCBI\Enums\PaymentRequest;

use BenSampo\Enum\Enum;

/**
 * @property string $value
 * @method static self TRA() Send a payment with outcome feedback
 * @method static self TRF() Send a payment with no outcome feedback
 *
 */
final class PaymentMethod extends Enum
{
    public const TRA = 'TRA';
    public const TRF = 'TRF';
}
