<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Traits\Makeable;
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
     * @var \Condividendo\LaravelCBI\Tags\PaymentInfoTag
     */
    private $paymentInfoTag;    

    public function setGroupHeader(GroupHeader $groupHeader): self
    {
        $this->groupHeader = $groupHeader;

        return $this;
    }

    public function setPaymentInfoTag(PaymentInfoTag $paymentInfoTag): self
    {
        $this->paymentInfoTag = $paymentInfoTag;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('CBIPaymentRequest');

        $e->appendChild($this->groupHeader->toDOMElement($dom));
        $e->appendChild($this->paymentInfoTag->toDOMElement($dom));
        
        return $e;
    }
}
