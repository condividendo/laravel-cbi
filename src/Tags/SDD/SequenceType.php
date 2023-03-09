<?php

namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class SequenceType extends Tag
{
    use Makeable;

    /**
     * @var \Condividendo\LaravelCBI\Enums\SDD\SequenceType
     */
    private $sequenceType;

    public function setSequenceType(\Condividendo\LaravelCBI\Enums\SDD\SequenceType $sequenceType): self
    {
        $this->sequenceType = $sequenceType;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('SeqTp', $this->sequenceType->value);
        return $e;
    }
}
