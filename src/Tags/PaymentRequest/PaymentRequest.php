<?php

namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Traits\Makeable;
use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\GroupHeader;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentInstruction;
use DOMDocument;
use DOMElement;

class PaymentRequest extends Tag
{
    use Makeable;

    /**
     * @var GroupHeader
     */
    private $groupHeader;

    /**
     * @var PaymentInstruction
     */
    private $paymentInstruction;

    public function setGroupHeader(GroupHeader $groupHeader): self
    {
        $this->groupHeader = $groupHeader;
        return $this;
    }

    public function setPaymentInstruction(PaymentInstruction $paymentInstruction): self
    {
        $this->paymentInstruction = $paymentInstruction;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElementNS(
            'urn:CBI:xsd:CBIPaymentRequest.00.04.00',
            'CBIPaymentRequest'
        );

        $e->appendChild($this->groupHeader->toDOMElement($dom));
        $e->appendChild($this->paymentInstruction->toDOMElement($dom));

        return $e;
    }
}
