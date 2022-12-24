<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Traits\Makeable;
use Condividendo\LaravelCBI\Tags\Name;
use Condividendo\LaravelCBI\Tags\InitiatingPartyId;
use DOMDocument;
use DOMElement;

class InitiatingParty extends Tag
{
    use Makeable;

    /**
     * @var \Condividendo\LaravelCBI\Tags\Name
     */
    private $name;

    /**
     * @var \Condividendo\LaravelCBI\Tags\InitiatingPartyId
     */
    private $id;
    
    public function setName(string $name): self
    {
        $this->name = Name::make()->setName($name);

        return $this;
    }

    public function setId(string $id, string $issr): self
    {
        $this->id = InitiatingPartyId::make()->setId($id,$issr);

        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('InitgPty');

        $e->appendChild($this->name->toDOMElement($dom));
        $e->appendChild($this->id->toDOMElement($dom));

        return $e;
    }
}
