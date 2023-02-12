<?php
namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Enums\ServiceLevel;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PurposeCode extends Tag
{
    use Makeable;

    /**
     * @var \Condividendo\LaravelCBI\Enums\SDD\Purpose
     */
    private $purpose;

    public function setPurpose(\Condividendo\LaravelCBI\Enums\SDD\Purpose $purpose): self
    {
        $this->purpose = $purpose;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('Cd', $this->purpose->value);
    }
}
