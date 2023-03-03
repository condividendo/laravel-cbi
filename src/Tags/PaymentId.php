<?php

namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\InstructionId;
use Condividendo\LaravelCBI\Tags\EndToEndId;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PaymentId extends Tag
{
    use Makeable;

    /**
     * @var InstructionId
     */
    private $instructionId;

    /**
     * @var EndToEndId
     */
    private $endToEndId;

    public function setInstructionId(string $instructionId): self
    {
        $this->instructionId = InstructionId::make()->setInstructionId($instructionId);
        return $this;
    }

    public function setEndToEndId(string $endToEndId): self
    {
        $this->endToEndId = EndToEndId::make()->setEndToEndId($endToEndId);
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('PmtId');
        $e->appendChild($this->instructionId->toDOMElement($dom));
        $e->appendChild($this->endToEndId->toDOMElement($dom));
        return $e;
    }
}
