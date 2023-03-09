<?php

namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Unstructured extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $unstructured;

    public function setUnstructured(string $unstructured): self
    {
        $this->unstructured = $unstructured;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('Ustrd', $this->unstructured);
    }
}
