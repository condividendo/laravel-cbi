<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\Unstructured;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class RemittanceInformation extends Tag
{
    use Makeable;

    /**
     * @var Unstructured
     */
    private $unstructured;
    
    public function setUnstructured(string $unstructured): self
    {
        $this->unstructured = Unstructured::make()->setUnstructured($unstructured);
        return $this;
    }
    
    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('RmtInf');
        $e->appendChild($this->unstructured->toDOMElement($dom));
        return $e;
    }
}