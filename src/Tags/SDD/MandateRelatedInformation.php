<?php

namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\SDD\MandateId;
use Condividendo\LaravelCBI\Tags\SDD\DateOfSignature;
use Condividendo\LaravelCBI\Tags\SDD\AmendmentIndicator;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class MandateRelatedInformation extends Tag
{
    use Makeable;

    /**
     * @var MandateId
     */
    private $mandateId;

    /**
     * @var DateOfSignature
     */
    private $dateOfSignature;

    /**
     * @var AmendmentIndicator
     */
    private $amendmentIndicator;

    public function setMandateId(string $mandateId): self
    {
        $this->mandateId = MandateId::make()->setMandateId($mandateId);
        return $this;
    }

    public function setDateOfSignature(string $date): self
    {
        $this->dateOfSignature = DateOfSignature::make()->setDateOfSignature($date);
        return $this;
    }

    public function setAmendmentIndicator(bool $amendmentIndicator): self
    {
        $this->amendmentIndicator = AmendmentIndicator::make()->setAmendmentIndicator($amendmentIndicator);
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('MndtRltdInf');
        $e->appendChild($this->mandateId->toDOMElement($dom));
        $e->appendChild($this->dateOfSignature->toDOMElement($dom));
        $e->appendChild($this->amendmentIndicator->toDOMElement($dom));
        return $e;
    }
}
