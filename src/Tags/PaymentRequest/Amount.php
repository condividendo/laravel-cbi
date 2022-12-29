<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\InstantiatedAmount;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Amount extends Tag
{
    use Makeable;

    /**
     * @var InstantiatedAmount
     */
    private $amount;
        
    public function setAmount(string $amount): self
    {
        $this->amount = InstantiatedAmount::make()->setAmount($amount);
        return $this;
    }
        
    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('Amt');
        $e->appendChild($this->amount->toDOMElement($dom));
        return $e;
    }
}