<?php

namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Enums\PaymentRequest\CommissionPayer as CommissionPayerEnum;
use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class CommissionPayer extends Tag
{
    use Makeable;

    /**
     * @var \Condividendo\LaravelCBI\Enums\PaymentRequest\CommissionPayer
     */
    private $commissionPayer;

    public function setCommissionPayer(CommissionPayerEnum $commissionPayer): self
    {
        $this->commissionPayer = $commissionPayer;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('ChrgBr', $this->commissionPayer->value);
        return $e;
    }
}
