<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Iban extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $iban;

    public function setAccount(string $iban): self
    {
        $this->iban = $iban;
        return $this;
    }  

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('IBAN',$this->iban);
        return $e;
    }
}
