<?php
namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\SDD\CreditorPrivateId;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class CreditorId extends Tag
{
    use Makeable;

    /**
     * @var CreditorPrivateId
     */
    private $creditorPrivateId;

    public function setId(string $id): self
    {
        $this->creditorPrivateId = CreditorPrivateId::make()->setId($id);
        return $this;
    }  

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('Id');
        $e->appendChild($this->creditorPrivateId->toDOMElement($dom));
        return $e;
    }
}
