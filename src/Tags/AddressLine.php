<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class AddressLine extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $addressLine;

    public function setAddressLine(string $addressLine): self
    {
        $this->addressLine = $addressLine;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('AdrLine', $this->addressLine);
    }
}
