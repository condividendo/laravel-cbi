<?php

namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Enums\ServiceLevel;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class ServiceLevelCode extends Tag
{
    use Makeable;

    /**
     * @var ServiceLevel
     */
    private $serviceLevel;

    public function setServiceLevel(ServiceLevel $serviceLevel): self
    {
        $this->serviceLevel = $serviceLevel;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('Cd', $this->serviceLevel->value);
    }
}
