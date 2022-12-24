<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Name extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $name;  

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('Nm',$this->name);
    }
}
