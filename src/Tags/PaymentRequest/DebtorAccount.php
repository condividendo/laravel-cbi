<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\DebtorId;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class DebtorAccount extends Tag
{
    use Makeable;

    /**
     * @var DebtorId
     */
    private $debtorId;

    public function setDebtorAccount(string $account): self
    {
        $this->debtorId = DebtorId::make()->setAccount($account);
        return $this;
    }  

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('DbtrAcct');
        $e->appendChild($this->debtorId->toDOMElement($dom));
        return $e;
    }
}
