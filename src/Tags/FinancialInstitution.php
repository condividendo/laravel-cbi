<?php

namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\ClrSysMmbId;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class FinancialInstitution extends Tag
{
    use Makeable;

    /**
     * @var ClrSysMmbId
     */
    private $clrSysMmbId;

    public function setClearingSystemMemberId(string $memberId): self
    {
        $this->clrSysMmbId = ClrSysMmbId::make()->setClearingSystemMemberId($memberId);
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('FinInstnId');
        $e->appendChild($this->clrSysMmbId->toDOMElement($dom));
        return $e;
    }
}
