<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Enums\OrgIdType;
use Condividendo\LaravelCBI\Traits\Makeable;
use Condividendo\LaravelCBI\Tags\Other;
use DOMDocument;
use DOMElement;

class OrgId extends Tag
{
    use Makeable;

    /**
     * @var \Condividendo\LaravelCBI\Tags\Other
     */
    private $other;

    public function setId(string $id, OrgIdType $issr): self
    {
        $this->other = Other::make()->setId($id)->setIssr($issr);

        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('OrgId');

        $e->appendChild($this->other->toDOMElement($dom));

        return $e;
    }
}
