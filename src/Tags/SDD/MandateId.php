<?php
namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class MandateId extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $mandateId;

    public function setMandateId(string $mandateId): self
    {
        $this->mandateId = $mandateId;
        return $this;
    }  

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('MndtId',$this->mandateId);
    }
}
