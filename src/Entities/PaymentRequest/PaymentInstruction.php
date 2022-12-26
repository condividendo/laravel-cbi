<?php
namespace Condividendo\LaravelCBI\Entities\PaymentRequest;

use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentMethod;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentPriority;
use Condividendo\LaravelCBI\Enums\ServiceLevel;
use Condividendo\LaravelCBI\Enums\PaymentRequest\CommissionPayer;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentInstruction as PaymentInstructionTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\CreditTransferTransactionInformation as CreditTransferTransactionInformationTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PartyIdentification as PartyIdentificationTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\FinancialInstitution as FinancialInstitutionTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\ExecutingBank;
use Condividendo\LaravelCBI\Entities\PaymentRequest\CreditTransferTransactionInformation;
use Condividendo\LaravelCBI\Entities\PaymentRequest\PartyIdentification;
use Condividendo\LaravelCBI\Entities\PaymentRequest\FinancialInstitution;
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
     * @var PaymentPriority
     */
    private $paymentPriority;

    /**
     * @var ServiceLevel
     */
    private $serviceLevel;

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
     * @var array<CreditTransferTransactionInformationTag>
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
        $this->debtor = PartyIdentificationTag::make()->setDebtor($debtor);
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

    public function addCreditTransferTransactionInformation(CreditTransferTransactionInformation $creditTransferTransactionInformation): self
    {
        $this->creditTransferTransactionInformation[] = $creditTransferTransactionInformation->getTag();
        return $this;
    }

    public function setPaymentMethod(PaymentMethod $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;
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
                ->setServiceLevel($this->serviceLevel)
                ->setPaymentPriority($this->paymentPriority)
                ->setPaymentMethod($this->paymentMethod)
                ->setExecutingBank($this->executingBank)
                ->setDebtor($this->debtor)
                ->setDebtorAccount($this->debtorAccount)
                ->setRequiredExecutionDate($this->requiredExecutionDate)
                ->setBatchBooking($this->batchBooking);
        foreach($this->creditTransferTransactionInformation as $info){
            $tag->addCreditTransferTransactionInformation($info);
        }
        return $tag;
    }

}