<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class City extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $city;

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('TwnNm', $this->city);
    }
}
