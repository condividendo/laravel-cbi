<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\Code;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class CategoryPurpose extends Tag
{
    use Makeable;

    /**
     * @var Code
     */
    private $code;
    
    public function setCategoryPurpose(\Condividendo\LaravelCBI\Enums\PaymentRequest\CategoryPurpose $categoryPurpose): self
    {
        $this->code = Code::make()->setCode($categoryPurpose);
        return $this;
    }
    
    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('CtgyPurp');
        $e->appendChild($this->code->toDOMElement($dom));
        return $e;
    }
}