<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\CategoryPurpose;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PaymentTypeInformation extends Tag
{
    use Makeable;

    /**
     * @var CategoryPurpose
     */
    private $categoryPurpose;
    
    public function setCategoryPurpose(\Condividendo\LaravelCBI\Enums\PaymentRequest\CategoryPurpose $categoryPurpose): self
    {
        $this->categoryPurpose = CategoryPurpose::make()->setCategoryPurpose($categoryPurpose);
        return $this;
    }
        
    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('PmtTpInf');
        $e->appendChild($this->categoryPurpose->toDOMElement($dom));
        return $e;
    }
}