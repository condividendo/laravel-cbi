<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\FinancialInstitution;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class ExecutingBank extends Tag
{
    use Makeable;

    /**
     * @var FinancialInstitution
     */
    private $financialInstitution;

    public function setFinancialInstitution(FinancialInstitution $financialInstitution): self
    {
        $this->financialInstitution = $financialInstitution;
        return $this;
    }  

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('DbtrAgt');
        $e->appendChild($this->financialInstitution->toDOMElement($dom));
        return $e;
    }
}
