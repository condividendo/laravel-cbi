<?php
namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\SDD\LocalInstrumentCode;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class LocalInstrument extends Tag
{
    use Makeable;
    
    /**
     * @var LocalInstrumentCode
     */
    private $localInstrument; 

    public function setLocalInstrument(\Condividendo\LaravelCBI\Enums\SDD\LocalInstrument $localInstrument): self
    {
        $this->localInstrument = LocalInstrumentCode::make()->setLocalInstrument($localInstrument);
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('LclInstrm');
        $e->appendChild($this->localInstrument->toDOMElement($dom));
        return $e;
    }
}
