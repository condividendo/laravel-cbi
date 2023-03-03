<?php

namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Enums\OrgIdType;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Issr extends Tag
{
    use Makeable;

    /**
     * @var OrgIdType
     */
    private $issr;

    public function setIssr(OrgIdType $issr): self
    {
        $this->issr = $issr;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('Issr', $this->issr->value);
    }
}
