<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\IdWithIban;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class CreditorAccount extends Tag
{
    use Makeable;

    /**
     * @var IdWithIban
     */
    private $creditorId;

    public function setCreditorAccount(string $account): self
    {
        $this->creditorId = IdWithIban::make()->setAccount($account);
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