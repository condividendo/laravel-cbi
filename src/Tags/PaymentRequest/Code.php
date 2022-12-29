<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Enums\PaymentRequest\CategoryPurpose;
use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Code extends Tag
{
    use Makeable;

    /**
     * @var CategoryPurpose
     */
    private $code;
    
    public function setCode(CategoryPurpose $code): self
    {
        $this->code = $code;
        return $this;
    }
    
    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('Cd', $this->code->value);
    }
}