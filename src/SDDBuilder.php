<?php
namespace Condividendo\LaravelCBI;

use Condividendo\LaravelCBI\Entities\SDD\PaymentInstruction;
use Condividendo\LaravelCBI\Tags\SDD\SDD;
use Condividendo\LaravelCBI\Tags\SDD\PaymentInstruction as PaymentInstructionTag;
use DOMDocument;
use SimpleXMLElement;

class SDDBuilder extends GroupHeaderBuilder
{
    /**
     * @var PaymentInstructionTag
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

    private function makePaymentRequest(): SDD
    {
        return SDD::make()
            ->setGroupHeader($this->makeGroupHeader())
            ->setPaymentInstruction($this->paymentInstruction);
    }
    
}
