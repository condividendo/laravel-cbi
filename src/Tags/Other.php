<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Traits\Makeable;
use Condividendo\LaravelCBI\Tags\Issr;
use Condividendo\LaravelCBI\Tags\Id;
use DOMDocument;
use DOMElement;

class Other extends Tag
{
    use Makeable;

    /**
     * @var \Condividendo\LaravelCBI\Tags\Issr
     */
    private $issr;

    /**
     * @var \Condividendo\LaravelCBI\Tags\Id
     */
    private $id;
    
    public function setIssr(string $issr): self
    {
        $this->issr = Issr::make()->setIssr($issr);

        return $this;
    }

    public function setId(string $id): self
    {
        $this->id = ID::make()->setId($id);

        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('Othr');

        $e->appendChild($this->id->toDOMElement($dom));
        $e->appendChild($this->issr->toDOMElement($dom));

        return $e;
    }
}
