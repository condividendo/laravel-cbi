<?php

namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\SDD\MandateRelatedInformation;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class DirectDebitTransaction extends Tag
{
    use Makeable;

    /**
     * @var MandateRelatedInformation
     */
    private $mandateRelatedInformation;

    public function setMandateRelatedInformation(MandateRelatedInformation $mandateRelatedInformation): self
    {
        $this->mandateRelatedInformation = $mandateRelatedInformation;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('DrctDbtTx');
        $e->appendChild($this->mandateRelatedInformation->toDOMElement($dom));
        return $e;
    }
}
