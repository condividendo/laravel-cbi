<?php

namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\ServiceLevelCode;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class ServiceLevel extends Tag
{
    use Makeable;

    /**
     * @var ServiceLevelCode
     */
    private $serviceLevelCode;

    public function setServiceLevel(\Condividendo\LaravelCBI\Enums\ServiceLevel $serviceLevel): self
    {
        $this->serviceLevelCode = ServiceLevelCode::make()->setServiceLevel($serviceLevel);
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('SvcLvl');
        $e->appendChild($this->serviceLevelCode->toDOMElement($dom));
        return $e;
    }
}
