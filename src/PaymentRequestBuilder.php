<?php

namespace Condividendo\LaravelCBI;

use Condividendo\LaravelCBI\Entities\PaymentRequest\PaymentInstruction;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentRequest;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentInstruction as PaymentInstructionTag;
use DOMDocument;
use SimpleXMLElement;

class PaymentRequestBuilder extends GroupHeaderBuilder
{
    /**
     * @var array<\Condividendo\LaravelCBI\PaymentRequest\Tags\PaymentInstruction>
     */
    private $paymentInstruction;

    public function setPaymentInstruction(PaymentInstruction $paymentInstruction): self
    {
        $this->paymentInstruction = $paymentInstruction->getTag();

        return $this;
    }
    
    public function toDOM(): DOMDocument
    {
        $dom = new DOMDocument();
        $dom->appendChild($this->makePaymentRequest()->toDOMElement($dom));

        return $dom;
    }

    public function toXML(): SimpleXMLElement
    {
        $xml = simplexml_import_dom($this->toDOM());
        assert($xml instanceof SimpleXMLElement);

        return $xml;
    }

    private function makePaymentRequest(): PaymentRequest
    {
        return PaymentRequest::make()
            ->setGroupHeader($this->makeGroupHeader())
            ->setPaymentInstruction($this->paymentInstruction);
    }
    
}
