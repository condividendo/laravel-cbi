<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\MemberId;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class ClrSysMmbId extends Tag
{
    use Makeable;

    /**
     * @var MemberId
     */
    private $mmbId;

    public function setClearingSystemMemberId(string $mmbId): self
    {
        $this->mmbId = MemberId::make()->setMemberId($mmbId);
        return $this;
    }  

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('ClrSysMmbId');
        $e->appendChild($this->mmbId->toDOMElement($dom));
        return $e;
    }
}
