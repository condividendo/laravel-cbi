<?php

namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Enums\PaymentRequest\CategoryPurpose as CategoryPurposeEnum;
use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\CategoryPurposeCode;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class CategoryPurpose extends Tag
{
    use Makeable;

    /**
     * @var CategoryPurposeCode
     */
    private $code;

    public function setCategoryPurpose(CategoryPurposeEnum $categoryPurpose): self
    {
        $this->code = CategoryPurposeCode::make()->setCode($categoryPurpose);
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
