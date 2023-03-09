<?php

namespace Condividendo\LaravelCBI\Entities\PaymentRequest;

use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Entities\PartyIdentification;
use Condividendo\LaravelCBI\Entities\FinancialInstitution;
use Condividendo\LaravelCBI\Entities\PaymentTypeInfo;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentMethod;
use Condividendo\LaravelCBI\Enums\PaymentRequest\CommissionPayer;
use Condividendo\LaravelCBI\Entities\PaymentRequest\CreditTransferTransactionInformation;
use Condividendo\LaravelCBI\Tags\PartyIdentification as PartyIdentificationTag;
use Condividendo\LaravelCBI\Tags\PaymentTypeInfo as PaymentTypeInfoTag;
use Condividendo\LaravelCBI\Tags\FinancialInstitution as FinancialInstitutionTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentInstruction as PaymentInstructionTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\CreditTransferTransactionInformation as CTTXInfoTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\ExecutingBank;
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
     * @var PaymentMethod
     */
    private $paymentMethod;

    /**
     * @var PaymentTypeInfoTag
     */
    private $paymentTypeInfo;

    /**
     * @var CommissionPayer
     */
    private $commissionPayer;

    /**
     * @var bool
     */
    private $batchBooking;

    /**
     * @var string
     */
    private $requiredExecutionDate;

    /**
     * @var PartyIdentificationTag
     */
    private $debtor;

    /**
     * @var string
     */
    private $debtorAccount;

    /**
     * @var ExecutingBank
     */
    private $executingBank;

    /**
     * @var array<CTTXInfoTag>
     */
    private $creditTransferTransactionInformation = [];

    public function setBatchBooking(bool $batchBooking): self
    {
        $this->batchBooking = $batchBooking;
        return $this;
    }

    public function setRequiredExecutionDate(string $requiredExecutionDate): self
    {
        $this->requiredExecutionDate = $requiredExecutionDate;
        return $this;
    }

    public function setDebtor(PartyIdentification $debtor): self
    {
        $this->debtor = $debtor->getTag();
        return $this;
    }

    public function setDebtorAccount(string $debtorAccount): self
    {
        $this->debtorAccount = $debtorAccount;
        return $this;
    }

    public function setExecutingBank(FinancialInstitution $financialInstitution): self
    {
        $this->executingBank = ExecutingBank::make()->setFinancialInstitution($financialInstitution->getTag());
        return $this;
    }

    public function addCreditTransferTransactionInformation(CreditTransferTransactionInformation $cttxInfo): self
    {
        $this->creditTransferTransactionInformation[] = $cttxInfo->getTag();
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

    public function setCommissionPayer(CommissionPayer $commissionPayer): self
    {
        $this->commissionPayer = $commissionPayer;
        return $this;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTag(): PaymentInstructionTag
    {
        $tag = PaymentInstructionTag::make()
                ->setId($this->id)
                ->setCommissionPayer($this->commissionPayer)
                ->setPaymentTypeInfo($this->paymentTypeInfo)
                ->setPaymentMethod($this->paymentMethod)
                ->setExecutingBank($this->executingBank)
                ->setDebtor($this->debtor)
                ->setDebtorAccount($this->debtorAccount)
                ->setRequiredExecutionDate($this->requiredExecutionDate)
                ->setBatchBooking($this->batchBooking ? true : false);
        foreach ($this->creditTransferTransactionInformation as $info) {
            $tag->addCreditTransferTransactionInformation($info);
        }
        return $tag;
    }
}
