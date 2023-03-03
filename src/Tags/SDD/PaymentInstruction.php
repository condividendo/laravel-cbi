<?php

namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Enums\ServiceLevel;
use Condividendo\LaravelCBI\Enums\SDD\PaymentMethod;
use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\PartyIdentification;
use Condividendo\LaravelCBI\Tags\BatchBooking;
use Condividendo\LaravelCBI\Tags\PaymentInstructionId;
use Condividendo\LaravelCBI\Tags\CreditorAccount;
use Condividendo\LaravelCBI\Tags\PaymentTypeInfo;
use Condividendo\LaravelCBI\Tags\SDD\DirectDebitTransactionInformation;
use Condividendo\LaravelCBI\Tags\SDD\RequiredCollectionDate;
use Condividendo\LaravelCBI\Tags\SDD\ExecutingBank;
use Condividendo\LaravelCBI\Tags\SDD\CreditorSchemeId;
use Condividendo\LaravelCBI\Tags\SDD\PaymentMethod as PaymentMethodTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PaymentInstruction extends Tag
{
    use Makeable;

    /**
     * @var PaymentInstructionId
     */
    private $id;

    /**
     * @var ExecutingBank
     */
    private $executingBank;

    /**
     * @var CreditorSchemeId
     */
    private $creditorSchemeId;

    /**
     * @var PaymentMethodTag
     */
    private $paymentMethod;

    /**
     * @var PaymentTypeInfo
     */
    private $paymentTypeInfo;

    /**
     * @var BatchBooking
     */
    private $batchBooking;

    /**
     * @var PartyIdentification
     */
    private $creditor;

    /**
     * @var CreditorAccount
     */
    private $creditorAccount;

    /**
     * @var RequiredCollectionDate
     */
    private $requiredCollectionDate;

    /**
     * @var array<DirectDebitTransactionInformation>
     */
    private $directDebitTransactionInformation = [];

    public function setBatchBooking(bool $batchBooking): self
    {
        $this->batchBooking = BatchBooking::make()->setBatchBooking($batchBooking);
        return $this;
    }

    public function setCreditor(PartyIdentification $creditor): self
    {
        $this->creditor = $creditor->setAsDebtorOrCreditor(false);
        return $this;
    }

    public function setCreditorAccount(string $creditorAccount): self
    {
        $this->creditorAccount = CreditorAccount::make()->setCreditorAccount($creditorAccount);
        return $this;
    }

    public function addDirectDebitTransactionInformation(DirectDebitTransactionInformation $info): self
    {
        $this->directDebitTransactionInformation[] = $info;
        return $this;
    }

    public function setPaymentMethod(PaymentMethod $paymentMethod): self
    {
        $this->paymentMethod = PaymentMethodTag::make()->setPaymentMethod($paymentMethod);
        return $this;
    }

    public function setPaymentTypeInfo(PaymentTypeInfo $paymentTypeInfo): self
    {
        $this->paymentTypeInfo = $paymentTypeInfo;
        return $this;
    }

    public function setId(string $id): self
    {
        $this->id = PaymentInstructionId::make()->setPaymentInstructionId($id);
        return $this;
    }

    public function setRequiredCollectionDate(string $date): self
    {
        $this->requiredCollectionDate = RequiredCollectionDate::make()->setRequiredCollectionDate($date);
        return $this;
    }

    public function setExecutingBank(ExecutingBank $executingBank): self
    {
        $this->executingBank = $executingBank;
        return $this;
    }

    public function setCreditorSchemeId(CreditorSchemeId $creditorSchemeId): self
    {
        $this->creditorSchemeId = $creditorSchemeId;
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('PmtInf');

        $e->appendChild($this->id->toDOMElement($dom));
        $e->appendChild($this->paymentMethod->toDOMElement($dom));
        $e->appendChild($this->batchBooking->toDOMElement($dom));
        $e->appendChild($this->paymentTypeInfo->toDOMElement($dom));
        $e->appendChild($this->requiredCollectionDate->toDOMElement($dom));
        $e->appendChild($this->creditor->toDOMElement($dom));
        $e->appendChild($this->creditorAccount->toDOMElement($dom));
        $e->appendChild($this->executingBank->toDOMElement($dom));
        $e->appendChild($this->creditorSchemeId->toDOMElement($dom));

        foreach ($this->directDebitTransactionInformation as $info) {
            $e->appendChild($info->toDOMElement($dom));
        }

        return $e;
    }
}
