<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Traits\Makeable;
use Condividendo\LaravelCBI\Traits\UsesDecimal;
use DOMDocument;
use DOMElement;

class CtrlSum extends Tag
{
    use Makeable;
    use UsesDecimal;

    /**
     * @var string
     */
    private $controlSum;  

    public function setControlSum(string $controlSum): self
    {
        $this->controlSum = self::makeDecimal($controlSum);

        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('CtrlSum',$this->controlSum);
    }
}
