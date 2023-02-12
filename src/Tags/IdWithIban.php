<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\Iban;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class IdWithIban extends Tag
{
    use Makeable;

    /**
     * @var Iban
     */
    private $iban;

    public function setAccount(string $iban): self
    {
        $this->iban = Iban::make()->setAccount($iban);
        return $this;
    }  

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('Id');
        $e->appendChild($this->iban->toDOMElement($dom));
        return $e;
    }
}
