<?php

namespace Condividendo\LaravelCBI\Enums;

use BenSampo\Enum\Enum;

/**
 * @property string $value
 * @method static self IT() Italy
 * @method static self SM() San Marino
 * @method static self VA() Vatican
 *
 */
final class Country extends Enum
{
    public const IT = 'IT';
    public const SM = 'SM';
    public const VA = 'VA';
}
