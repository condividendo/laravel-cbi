<?php

namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use Condividendo\LaravelCBI\Traits\UsesDate;
use DOMDocument;
use DOMElement;

class DateOfSignature extends Tag
{
    use Makeable;
    use UsesDate;

    /**
     * @var string
     */
    private $date;

    public function setDateOfSignature(string $date): self
    {
        $this->date = $this->makeDate($date)->toDateString();
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('DtOfSgntr', $this->date);
    }
}
