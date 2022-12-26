<?php

namespace Condividendo\LaravelCBI\Enums\PaymentRequest;

use BenSampo\Enum\Enum;

/**
 * @property string $value
 * @method static self ADDR() Residence address
 * @method static self BIZZ() Office address
 * @method static self DLVY() Shipping address
 * 
 */
final class AddressType extends Enum
{
    public const ADDR = 'ADDR';
    public const BIZZ = 'BIZZ';
    public const DLVY = 'DLVY';
}
