<?php

namespace Condividendo\LaravelCBI\Enums\PaymentRequest;

use BenSampo\Enum\Enum;

/**
 * @property string $value
 * @method static self IT() Italy
 * @method static self RSM() San Marino
 * @method static self VA() Vatican
 * 
 */
final class CountryCode extends Enum
{
    public const IT = 'IT';
    public const RSM = 'RSM';
    public const VA = 'VA';
}
