<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Issr extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $issr;  

    public function setIssr(string $issr): self
    {
        $this->issr = $issr;

        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('Issr',$this->issr);
    }
}
