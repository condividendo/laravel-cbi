<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PaymentInstructionId extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $id;  

    public function setPaymentInstructionId(string $id): self
    {
        $this->id = $id;
        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('PmtInfId',$this->id);
    }
}
