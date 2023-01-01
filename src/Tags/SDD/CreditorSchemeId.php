<?php
namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\Name;
use Condividendo\LaravelCBI\Tags\SDD\CreditorId;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class CreditorSchemeId extends Tag
{
    use Makeable;

    /**
     * @var Name
     */
    private $name;

    /**
     * @var CreditorId
     */
    private $creditorId;

    public function setId(string $name, string $id): self
    {
        $this->name = Name::make()->setName($name);
        $this->creditorId = CreditorId::make()->setId($id);
        return $this;
    }  

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('CdtrSchmeId');
        $e->appendChild($this->name->toDOMElement($dom));
        $e->appendChild($this->creditorId->toDOMElement($dom));
        return $e;
    }
}
