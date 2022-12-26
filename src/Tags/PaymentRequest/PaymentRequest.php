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
     * @var \Condividendo\LaravelCBI\Tags\GroupHeader
     */
    private $groupHeader;

    /**
     * @var \Condividendo\LaravelCBI\Tags\PaymentInstruction
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
        $e = $dom->createElement('CBIPaymentRequest');

        $e->appendChild($this->groupHeader->toDOMElement($dom));
        $e->appendChild($this->paymentInstruction->toDOMElement($dom));
        
        return $e;
    }
}
