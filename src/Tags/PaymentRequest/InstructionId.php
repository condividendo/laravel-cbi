<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class InstructionId extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $instructionId;
    
    public function setInstructionId(string $instructionId): self
    {
        $this->instructionId = $instructionId;
        return $this;
    }
    
    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('InstrId', $this->instructionId);
    }
}