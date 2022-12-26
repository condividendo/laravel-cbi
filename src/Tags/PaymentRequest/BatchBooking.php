<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class BatchBooking extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $batchBooking;  

    public function setBatchBooking(string $batchBooking): self
    {
        $this->batchBooking = $batchBooking;

        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('BtchBookg',$this->batchBooking);
    }
}
