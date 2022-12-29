<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class EndToEndId extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $endToEndId;
    
    public function setEndToEndId(string $endToEndId): self
    {
        $this->endToEndId = $endToEndId;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('EndToEndId', $this->endToEndId);
    }
}