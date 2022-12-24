<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Traits\Makeable;
use Condividendo\LaravelCBI\Tags\OrgId;
use DOMDocument;
use DOMElement;

class InitiatinPartyId extends Tag
{
    use Makeable;

    /**
     * @var \Condividendo\LaravelCBI\Tags\OrgId
     */
    private $orgId;

    public function setId(string $id,string $issr): self
    {
        $this->orgId = OrgId::make()->setId($id,$issr);

        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('Id');

        $e->appendChild($this->orgId->toDOMElement($dom));

        return $e;
    }
}
