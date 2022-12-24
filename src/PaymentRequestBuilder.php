<?php

namespace Condividendo\LaravelCBI;

use Condividendo\LaravelCBI\Entities\PaymentRequest\PaymentInstruction;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentRequest as PaymentRequestTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentInstruction as PaymentInstructionTag;
use DOMDocument;
use SimpleXMLElement;

class PaymentRequestBuilder extends GroupHeaderBuilder
{
    /**
     * @var array<\Condividendo\LaravelCBI\PaymentRequest\Entities\PaymentInstruction>
     */
    private $paymentInstruction;

    public function setPaymentInstruction(PaymentInstruction $paymentInstruction): self
    {
        $this->paymentInstruction = $paymentInstruction;

        return $this;
    }
    
    public function toDOM(): DOMDocument
    {
        $dom = new DOMDocument();
        $dom->appendChild($this->makePaymentRequestTag()->toDOMElement($dom));

        return $dom;
    }

    public function toXML(): SimpleXMLElement
    {
        $xml = simplexml_import_dom($this->toDOM());
        assert($xml instanceof SimpleXMLElement);

        return $xml;
    }

    private function makePaymentRequestTag(): PaymentRequestTag
    {
        return PaymentRequestTag::make()
            ->setGroupHeader($this->makeGroupHeader())
            ->setPaymentInstruction($this->makePaymentInstruction());
    }

    private function makePaymentInstruction(): PaymentInstructionTag
    {
        return PaymentInstructionTag::make(); // TODO
    }
    
}
