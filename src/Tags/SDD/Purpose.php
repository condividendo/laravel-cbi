<?php

namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\SDD\PurposeCode;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Purpose extends Tag
{
    use Makeable;

    /**
     * @var PurposeCode
     */
    private $purpose;

    public function setPurpose(\Condividendo\LaravelCBI\Enums\SDD\Purpose $purpose): self
    {
        $this->purpose = PurposeCode::make()->setPurpose($purpose);
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('Purp');
        $e->appendChild($this->purpose->toDOMElement($dom));
        return $e;
    }
}
