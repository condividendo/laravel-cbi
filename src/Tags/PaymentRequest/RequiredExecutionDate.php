<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use Condividendo\LaravelCBI\Traits\UsesDate;
use DOMDocument;
use DOMElement;

class RequiredExecutionDate extends Tag
{
    use Makeable;
    use UsesDate;

    /**
     * @var string
     */
    private $requiredExecutionDate;  

    public function setRequiredExecutionDate(string $requiredExecutionDate): self
    {
        $this->requiredExecutionDate = $this->makeDate($requiredExecutionDate);
        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('ReqdExctnDt',$this->requiredExecutionDate);
    }
}
