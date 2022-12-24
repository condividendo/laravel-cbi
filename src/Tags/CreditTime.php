<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Traits\Makeable;
use Condividendo\LaravelCBI\Traits\UsesDate;
use DOMDocument;
use DOMElement;

class CreditTime extends Tag
{
    use Makeable;
    use UsesDate;

    /**
     * @var string
     */
    private $creditTime;  

    public function setCreditTime(string $creditTime): self
    {
        $this->creditTime = self::makeDateIso8601($creditTime);

        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('CreDtTm',$this->creditTime);
    }
}
