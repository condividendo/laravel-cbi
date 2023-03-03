<?php

namespace Condividendo\LaravelCBI\Entities;

use Condividendo\LaravelCBI\Enums\ServiceLevel;
use Condividendo\LaravelCBI\Enums\SDD\SequenceType;
use Condividendo\LaravelCBI\Enums\SDD\LocalInstrument;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentPriority;
use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Tags\PaymentTypeInfo as PaymentTypeInfoTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use RuntimeException;

class PaymentTypeInfo extends Entity
{
    use Makeable;

    /**
     * @var PaymentPriority
     */
    private $paymentPriority;

    /**
     * @var ServiceLevel
     */
    private $serviceLevel;

    /**
     * @var SequenceType
     */
    private $sequenceType;

    /**
     * @var LocalInstrument
     */
    private $localInstrument;

    public function setPaymentPriority(PaymentPriority $paymentPriority): self
    {
        $this->paymentPriority = $paymentPriority;
        return $this;
    }

    public function setServiceLevel(ServiceLevel $serviceLevel): self
    {
        $this->serviceLevel = $serviceLevel;
        return $this;
    }

    public function setSequenceType(SequenceType $sequenceType): self
    {
        $this->sequenceType = $sequenceType;
        return $this;
    }

    public function setLocalInstrument(LocalInstrument $localInstrument): self
    {
        $this->localInstrument = $localInstrument;
        return $this;
    }

    public function getTag(): PaymentTypeInfoTag
    {
        $tag = PaymentTypeInfoTag::make()
                ->setServiceLevel($this->serviceLevel);
        if ($this->paymentPriority) {
            $tag->setPaymentPriority($this->paymentPriority);
        }
        if ($this->sequenceType) {
            $tag->setSequenceType($this->sequenceType);
        }
        if ($this->localInstrument) {
            $tag->setLocalInstrument($this->localInstrument);
        }
        return $tag;
    }
}
