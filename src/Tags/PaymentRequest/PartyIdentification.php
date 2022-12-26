<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\Name;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PartyIdentification extends Tag
{
    use Makeable;

    /**
     * @var Name
     */
    private $name;

    public function setName(string $name): self
    {
        $this->name = Name::make()->setName($name);
        return $this;
    }  

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('Dbtr');
        $e->appendChild($this->name->toDOMElement($dom));
        return $e;
    }
}
