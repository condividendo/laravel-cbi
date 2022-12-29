<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\Id;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class CreditorAccount extends Tag
{
    use Makeable;

    /**
     * @var Id
     */
    private $creditorId;
        
    public function setCreditorAccount(string $iban): self
    {
        $this->creditorId = Id::make()->setAccount($iban);
        return $this;
    }
    
    
    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('CdtrAcct');
        $e->appendChild($this->creditorId->toDOMElement($dom));
        return $e;
    }

}