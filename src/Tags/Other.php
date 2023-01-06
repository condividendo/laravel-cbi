<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Enums\OrgIdType;
use Condividendo\LaravelCBI\Traits\Makeable;
use Condividendo\LaravelCBI\Tags\Issr;
use Condividendo\LaravelCBI\Tags\Id;
use DOMDocument;
use DOMElement;

class Other extends Tag
{
    use Makeable;

    /**
     * @var Issr
     */
    private $issr;

    /**
     * @var Id
     */
    private $id;
    
    public function setIssr(OrgIdType $issr): self
    {
        $this->issr = Issr::make()->setIssr($issr);
        return $this;
    }

    public function setId(string $id): self
    {
        $this->id = Id::make()->setId($id);
        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('Othr');
        if($this->id){
            $e->appendChild($this->id->toDOMElement($dom));
        }
        if($this->issr){
            $e->appendChild($this->issr->toDOMElement($dom));
        }
        return $e;
    }
}
