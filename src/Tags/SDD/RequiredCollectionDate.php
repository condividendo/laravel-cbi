<?php
namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use Condividendo\LaravelCBI\Traits\UsesDate;
use DOMDocument;
use DOMElement;

class RequiredCollectionDate extends Tag
{
    use Makeable;
    use UsesDate;

    /**
     * @var string
     */
    private $requiredCollectionDate;  

    public function setRequiredCollectionDate(string $requiredCollectionDate): self
    {
        $this->requiredCollectionDate = $this->makeDate($requiredCollectionDate)->toDateString();
        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('ReqdColltnDt',$this->requiredCollectionDate);
    }
}
