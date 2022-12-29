<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class InstantiatedAmount extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $amount;
        
    public function setAmount(string $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('InstdAmt', $this->amount);
        $e->setAttribute("Ccy", "EUR");
        return $e;
    }
}