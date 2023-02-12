<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class AddressType extends Tag
{
    use Makeable;

    /**
     * @var \Condividendo\LaravelCBI\Enums\AddressType
     */
    private $addressType;

    public function setAddressType(\Condividendo\LaravelCBI\Enums\AddressType $addressType): self
    {
        $this->addressType = $addressType;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('AdrTp', $this->addressType->value);
    }
}
