<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentMethod;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentPriority;
use Condividendo\LaravelCBI\Enums\ServiceLevel;
use Condividendo\LaravelCBI\Enums\PaymentRequest\CommissionPayer;
use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentInstructionId;
use Condividendo\LaravelCBI\Tags\PaymentRequest\BatchBooking;
use Condividendo\LaravelCBI\Tags\PaymentRequest\RequiredExecutionDate;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentMethod as PaymentMethodTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\CommissionPayer as CommissionPayerTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PartyIdentification;
use Condividendo\LaravelCBI\Tags\PaymentRequest\DebtorAccount;
use Condividendo\LaravelCBI\Tags\PaymentRequest\CreditTransferTransactionInformation;
use Condividendo\LaravelCBI\Tags\PaymentRequest\ExecutingBank;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentTypeInfo;
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
     * @var PaymentMethodTag
     */
    private $paymentMethod;

    /**
     * @var PaymentPriority
     */
    private $paymentPriority;

    /**
     * @var ServiceLevel
     */
    private $serviceLevel;

    /**
     * @var CommissionPayerTag
     */
    private $commissionPayer;

    /**
     * @var BatchBooking
     */
    private $batchBooking;

    /**
     * @var RequiredExecutionDate
     */
    private $requiredExecutionDate;

    /**
     * @var PartyIdentification
     */
    private $debtor;

    /**
     * @var DebtorAccount
     */
    private $debtorAccount;

    /**
     * @var ExecutingBank
     */
    private $executingBank;

    /**
     * @var array<CreditTransferTransactionInformation>
     */
    private $creditTransferTransactionInformation = [];
    
    public function setBatchBooking(bool $batchBooking): self
    {
        $this->batchBooking = BatchBooking::make()->setBatchBooking($batchBooking);
        return $this;
    }

    public function setRequiredExecutionDate(string $requiredExecutionDate): self
    {
        $this->requiredExecutionDate = RequiredExecutionDate::make()->setRequiredExecutionDate($requiredExecutionDate);
        return $this;
    }

    public function setDebtor(PartyIdentification $debtor): self
    {
        $this->debtor = $debtor;
        return $this;
    }

    public function setDebtorAccount(string $debtorAccount): self
    {
        $this->debtorAccount = DebtorAccount::make()->setDebtorAccount($debtorAccount);
        return $this;
    }

    public function setExecutingBank(ExecutingBank $executingBank): self
    {
        $this->executingBank = $executingBank;
        return $this;
    }

    public function addCreditTransferTransactionInformation(CreditTransferTransactionInformation $creditTransferTransactionInformation): self
    {
        $this->creditTransferTransactionInformation[] = $creditTransferTransactionInformation;
        return $this;
    }

    public function setPaymentMethod(PaymentMethod $paymentMethod): self
    {
        $this->paymentMethod = PaymentMethodTag::make()->setPaymentMethod($paymentMethod);
        return $this;
    }
    
    public function setPaymentPriority(PaymentPriority $paymentPriority): self
    {
        $this->paymentPriority = $paymentPriority;
        return $this;
    }
    
    public function setServiceLevel(ServiceLevel $serviceLevel): self
    {
        $this->serviceLevel = $serviceLevel;
        return $this;
    }
    
    public function setCommissionPayer(CommissionPayer $commissionPayer): self
    {
        $this->commissionPayer = CommissionPayerTag::make()->setCommissionPayer($commissionPayer);
        return $this;
    }

    public function setId(string $id): self
    {
        $this->id = PaymentInstructionId::make()->setPaymentInstructionId($id);
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
        $e->appendChild(PaymentTypeInfo::make()
                        ->setPaymentPriority($this->paymentPriority)
                        ->setServiceLevel($this->serviceLevel));
        $e->appendChild($this->requiredExecutionDate->toDOMElement($dom));
        $e->appendChild($this->debtor->toDOMElement($dom));
        $e->appendChild($this->debtorAccount->toDOMElement($dom));
        $e->appendChild($this->executingBank->toDOMElement($dom));
        $e->appendChild($this->commissionPayer->toDOMElement($dom));

        foreach ($this->creditTransferTransactionInformation as $info) {
            $e->appendChild($info->toDOMElement($dom));
        }               

        return $e;
    }
}