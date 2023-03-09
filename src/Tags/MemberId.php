<?php

namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class MemberId extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $mmbId;

    public function setMemberId(string $mmbId): self
    {
        $this->mmbId = $mmbId;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('MmbId', $this->mmbId);
    }
}
