<?php

namespace Condividendo\LaravelCBI\Entities\SDD;

use Condividendo\LaravelCBI\Enums\SDD\Purpose;
use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Entities\PartyIdentification;
use Condividendo\LaravelCBI\Entities\PaymentId;
use Condividendo\LaravelCBI\Entities\RemittanceInformation;
use Condividendo\LaravelCBI\Entities\SDD\PaymentTypeInformation;
use Condividendo\LaravelCBI\Tags\PartyIdentification as PartyIdentificationTag;
use Condividendo\LaravelCBI\Tags\SDD\DirectDebitTransactionInformation as DirectDebitTransactionInformationTag;
use Condividendo\LaravelCBI\Tags\SDD\PaymentId as PaymentIdTag;
use Condividendo\LaravelCBI\Tags\SDD\DirectDebitTransaction as DirectDebitTransactionTag;
use Condividendo\LaravelCBI\Tags\SDD\RemittanceInformation as RemittanceInformationTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use RuntimeException;

class DirectDebitTransactionInformation extends Entity
{
    use Makeable;

    /**
     * @var string
     */
    private $debtorAccount;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var Purpose
     */
    private $purpose;

    /**
     * @var PaymentIdTag
     */
    private $paymentId;

    /**
     * @var DirectDebitTransactionTag
     */
    private $directDebitTransaction;

    /**
     * @var PartyIdentificationTag
     */
    private $partyIdentification;

    /**
     * @var RemittanceInformationTag
     */
    private $remittanceInformation;

    public function setPurpose(Purpose $purpose): self
    {
        $this->purpose = $purpose;
        return $this;
    }

    public function setDebtorAccount(string $debtorAccount): self
    {
        $this->debtorAccount = $debtorAccount;
        return $this;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function setPaymentId(PaymentId $paymentId): self
    {
        $this->paymentId = $paymentId->getTag();
        return $this;
    }

    public function setMandateRelatedInformation(MandateRelatedInformation $mndt): self
    {
        $tag = DirectDebitTransactionTag::make();
        $this->directDebitTransaction = $tag->setMandateRelatedInformation($mndt->getTag());
        return $this;
    }

    public function setDebtor(PartyIdentification $partyIdentification): self
    {
        $this->partyIdentification = $partyIdentification->getTag();
        return $this;
    }

    public function setRemittanceInformation(RemittanceInformation $remittanceInformation): self
    {
        $this->remittanceInformation = $remittanceInformation->getTag();
        return $this;
    }

    public function getTag(): DirectDebitTransactionInformationTag
    {
        return DirectDebitTransactionInformationTag::make()
                ->setDebtorAccount($this->debtorAccount)
                ->setPaymentId($this->paymentId)
                ->setAmount($this->amount)
                ->setPurpose($this->purpose)
                ->setDirectDebitTransaction($this->directDebitTransaction)
                ->setDebtor($this->partyIdentification)
                ->setRemittanceInformation($this->remittanceInformation);
    }
}
