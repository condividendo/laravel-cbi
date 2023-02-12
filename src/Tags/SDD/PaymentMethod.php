<?php
namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PaymentMethod extends Tag
{
    use Makeable;

    /**
     * @var \Condividendo\LaravelCBI\Enums\SDD\PaymentMethod
     */
    private $paymentMethod;  

    public function setPaymentMethod(\Condividendo\LaravelCBI\Enums\SDD\PaymentMethod $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('PmtMtd',$this->paymentMethod->value);
    }
}
