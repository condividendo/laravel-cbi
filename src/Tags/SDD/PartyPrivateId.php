<?php
namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\Other;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PartyPrivateId extends Tag
{
    use Makeable;

    /**
     * @var Other
     */
    private $other;

    public function setId(string $id): self
    {
        $this->other = Other::make()->setId($id);
        return $this;
    }  

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('PrvtId');
        $e->appendChild($this->other->toDOMElement($dom));
        return $e;
    }
}
