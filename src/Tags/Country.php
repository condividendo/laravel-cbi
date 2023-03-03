<?php

namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Country extends Tag
{
    use Makeable;

    /**
     * @var \Condividendo\LaravelCBI\Enums\Country
     */
    private $country;

    public function setCountry(\Condividendo\LaravelCBI\Enums\Country $country): self
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('Ctry', $this->country->value);
    }
}
