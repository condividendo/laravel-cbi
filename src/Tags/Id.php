<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Id extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $id;  

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('Id',$this->id);
    }
}
