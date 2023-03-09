<?php

namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Enums\SDD\LocalInstrument;
use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class LocalInstrumentCode extends Tag
{
    use Makeable;

    /**
     * @var LocalInstrument
     */
    private $localInstrument;

    public function setLocalInstrument(LocalInstrument $localInstrument): self
    {
        $this->localInstrument = $localInstrument;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('Cd', $this->localInstrument->value);
        return $e;
    }
}
