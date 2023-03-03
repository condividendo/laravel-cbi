<?php

namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\SDD\PartyPrivateId;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PartyId extends Tag
{
    use Makeable;

    /**
     * @var PartyPrivateId
     */
    private $partyPrivateId;

    public function setId(string $id): self
    {
        $this->partyPrivateId = PartyPrivateId::make()->setId($id);
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('Id');
        $e->appendChild($this->partyPrivateId->toDOMElement($dom));
        return $e;
    }
}
