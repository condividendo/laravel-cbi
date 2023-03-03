<?php

namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentPriority as PaymentPriorityEnum;
use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PaymentPriority extends Tag
{
    use Makeable;

    /**
     * @var \Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentPriority
     */
    private $paymentPriority;

    public function setPaymentPriority(PaymentPriorityEnum $paymentPriority): self
    {
        $this->paymentPriority = $paymentPriority;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('InstrPrty', $this->paymentPriority->value);
    }
}
