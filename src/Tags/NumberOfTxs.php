<?php

namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Traits\Makeable;
use Condividendo\LaravelCBI\Traits\UsesDecimal;
use DOMDocument;
use DOMElement;

class NumberOfTxs extends Tag
{
    use Makeable;
    use UsesDecimal;

    /**
     * @var int
     */
    private $numberOfTxs;

    public function setNumberOfTxs(int $numberOfTxs): self
    {
        $this->numberOfTxs = $numberOfTxs;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('NbOfTxs', $this->numberOfTxs);
    }
}
