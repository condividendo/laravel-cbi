<?php

namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\IdWithIban;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class DebtorAccount extends Tag
{
    use Makeable;

    /**
     * @var IdWithIban
     */
    private $debtorId;

    public function setDebtorAccount(string $account): self
    {
        $this->debtorId = IdWithIban::make()->setAccount($account);
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
