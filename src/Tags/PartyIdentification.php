<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\Name;
use Condividendo\LaravelCBI\Tags\PostalAddress;
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

    /**
     * @var PostalAddress
     */
    private $postalAddress;

    /**
     * @var bool
     */
    private $isDebtor;

    public function setName(string $name): self
    {
        $this->name = Name::make()->setName($name);
        return $this;
    }  

    public function setPostalAddress(PostalAddress $postalAddress): self
    {
        $this->postalAddress = $postalAddress;
        return $this;
    }  

    public function setAsDebtorOrCreditor(bool $isDebtor): self
    {
        $this->isDebtor = $isDebtor;
        return $this;
    }  

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement($this->isDebtor ? 'Dbtr' : 'Cdtr');
        $e->appendChild($this->name->toDOMElement($dom));
        if ($this->postalAddress) {
            $e->appendChild($this->postalAddress->toDOMElement($dom));
        }
        return $e;
    }
}
