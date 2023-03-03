<?php

namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Enums\ServiceLevel;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentPriority;
use Condividendo\LaravelCBI\Enums\SDD\LocalInstrument;
use Condividendo\LaravelCBI\Enums\SDD\SequenceType;
use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\ServiceLevel as ServiceLevelTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentPriority as PaymentPriorityTag;
use Condividendo\LaravelCBI\Tags\SDD\LocalInstrument as LocalInstrumentTag;
use Condividendo\LaravelCBI\Tags\SDD\SequenceType as SequenceTypeTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PaymentTypeInfo extends Tag
{
    use Makeable;

    /**
     * @var PaymentPriorityTag
     */
    private $paymentPriority;

    /**
     * @var ServiceLevelTag
     */
    private $serviceLevel;

    /**
     * @var LocalInstrumentTag
     */
    private $localInstrument;

    /**
     * @var SequenceTypeTag
     */
    private $sequenceType;

    public function setPaymentPriority(PaymentPriority $paymentPriority): self
    {
        $this->paymentPriority = PaymentPriorityTag::make()->setPaymentPriority($paymentPriority);
        return $this;
    }

    public function setServiceLevel(ServiceLevel $serviceLevel): self
    {
        $this->serviceLevel = ServiceLevelTag::make()->setServiceLevel($serviceLevel);
        return $this;
    }

    public function setLocalInstrument(LocalInstrument $localInstrument): self
    {
        $this->localInstrument = LocalInstrumentTag::make()->setLocalInstrument($localInstrument);
        return $this;
    }

    public function setSequenceType(SequenceType $sequenceType): self
    {
        $this->sequenceType = SequenceTypeTag::make()->setSequenceType($sequenceType);
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('PmtTpInf');
        if ($this->paymentPriority) {
            $e->appendChild($this->paymentPriority->toDOMElement($dom));
        }
        $e->appendChild($this->serviceLevel->toDOMElement($dom));
        if ($this->localInstrument) {
            $e->appendChild($this->localInstrument->toDOMElement($dom));
        }
        if ($this->sequenceType) {
            $e->appendChild($this->sequenceType->toDOMElement($dom));
        }
        return $e;
    }
}
