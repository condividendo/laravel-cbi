<?php

namespace Condividendo\LaravelCBI\Entities\SDD;

use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Entities\PartyIdentification;
use Condividendo\LaravelCBI\Entities\FinancialInstitution;
use Condividendo\LaravelCBI\Entities\PaymentTypeInfo;
use Condividendo\LaravelCBI\Entities\SDD\DirectDebitTransactionInformation;
use Condividendo\LaravelCBI\Entities\SDD\CreditorSchemeId;
use Condividendo\LaravelCBI\Enums\SDD\PaymentMethod;
use Condividendo\LaravelCBI\Tags\PartyIdentification as PartyIdentificationTag;
use Condividendo\LaravelCBI\Tags\PaymentTypeInfo as PaymentTypeInfoTag;
use Condividendo\LaravelCBI\Tags\FinancialInstitution as FinancialInstitutionTag;
use Condividendo\LaravelCBI\Tags\SDD\PaymentInstruction as PaymentInstructionTag;
use Condividendo\LaravelCBI\Tags\SDD\DirectDebitTransactionInformation as DirectDebitTransactionInformationTag;
use Condividendo\LaravelCBI\Tags\SDD\ExecutingBank;
use Condividendo\LaravelCBI\Tags\SDD\CreditorSchemeId as CreditorSchemeIdTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use RuntimeException;

class PaymentInstruction extends Entity
{
    use Makeable;

    /**
     * @var string
     */
    private $id;

    /**
     * @var CreditorSchemeIdTag
     */
    private $creditorSchemeId;

    /**
     * @var PaymentMethod
     */
    private $paymentMethod;

    /**
     * @var PaymentTypeInfoTag
     */
    private $paymentTypeInfo;

    /**
     * @var bool
     */
    private $batchBooking;

    /**
     * @var string
     */
    private $requiredCollectionDate;

    /**
     * @var PartyIdentificationTag
     */
    private $creditor;

    /**
     * @var string
     */
    private $creditorAccount;

    /**
     * @var ExecutingBank
     */
    private $executingBank;

    /**
     * @var array<DirectDebitTransactionInformation>
     */
    private $directDebitTransactionInformation = [];

    public function setBatchBooking(bool $batchBooking): self
    {
        $this->batchBooking = $batchBooking;
        return $this;
    }

    public function setRequiredCollectionDate(string $requiredCollectionDate): self
    {
        $this->requiredCollectionDate = $requiredCollectionDate;
        return $this;
    }

    public function setCreditor(PartyIdentification $creditor): self
    {
        $this->creditor = $creditor->getTag();
        return $this;
    }

    public function setCreditorAccount(string $creditorAccount): self
    {
        $this->creditorAccount = $creditorAccount;
        return $this;
    }

    public function setExecutingBank(FinancialInstitution $financialInstitution): self
    {
        $this->executingBank = ExecutingBank::make()->setFinancialInstitution($financialInstitution->getTag());
        return $this;
    }

    public function addDirectDebitTransactionInformation(DirectDebitTransactionInformation $directDebitTransactionInformation): self
    {
        $this->directDebitTransactionInformation[] = $directDebitTransactionInformation->getTag();
        return $this;
    }

    public function setPaymentMethod(PaymentMethod $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function setPaymentTypeInfo(PaymentTypeInfo $paymentTypeInfo): self
    {
        $this->paymentTypeInfo = $paymentTypeInfo->getTag();
        return $this;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setCreditorSchemeId(CreditorSchemeId $creditorSchemeId): self
    {
        $this->creditorSchemeId = $creditorSchemeId->getTag();
        return $this;
    }

    public function getTag(): PaymentInstructionTag
    {
        $tag = PaymentInstructionTag::make()
                ->setId($this->id)
                ->setPaymentTypeInfo($this->paymentTypeInfo)
                ->setPaymentMethod($this->paymentMethod)
                ->setExecutingBank($this->executingBank)
                ->setCreditor($this->creditor)
                ->setCreditorAccount($this->creditorAccount)
                ->setCreditorSchemeId($this->creditorSchemeId)
                ->setRequiredCollectionDate($this->requiredCollectionDate)
                ->setBatchBooking($this->batchBooking ? true : false);
        foreach ($this->directDebitTransactionInformation as $info) {
            $tag->addDirectDebitTransactionInformation($info);
        }
        return $tag;
    }
}
