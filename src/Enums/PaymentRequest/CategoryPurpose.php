<?php

namespace Condividendo\LaravelCBI\PaymentRequest\Enums;

use BenSampo\Enum\Enum;

/**
 * @property string $value
 * @method static self SUPP() Generic payment reason
 * @method static self SALA() Wages
 * 
 */
final class SequenceType extends Enum
{
    public const SUPP = 'SUPP';
    public const SALA = 'SALA';
}
