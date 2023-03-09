<?php

namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class AmendmentIndicator extends Tag
{
    use Makeable;

    /**
     * @var bool
     */
    private $ind;

    public function setAmendmentIndicator(bool $ind): self
    {
        $this->ind = $ind;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('AmdmntInd', $this->ind ? "true" : "false");
    }
}
