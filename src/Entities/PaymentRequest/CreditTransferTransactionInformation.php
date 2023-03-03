<?php

namespace Condividendo\LaravelCBI\Entities\PaymentRequest;

use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Entities\PartyIdentification;
use Condividendo\LaravelCBI\Entities\PaymentId;
use Condividendo\LaravelCBI\Entities\RemittanceInformation;
use Condividendo\LaravelCBI\Entities\PaymentRequest\PaymentTypeInformation;
use Condividendo\LaravelCBI\Tags\PartyIdentification as PartyIdentificationTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\CreditTransferTransactionInformation as CreditTransferTransactionInformationTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentId as PaymentIdTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentTypeInformation as PaymentTypeInformationTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\RemittanceInformation as RemittanceInformationTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use RuntimeException;

class CreditTransferTransactionInformation extends Entity
{
    use Makeable;

    /**
     * @var string
     */
    private $creditorAccount;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var PaymentIdTag
     */
    private $paymentId;

    /**
     * @var PaymentTypeInformationTag
     */
    private $paymentTypeInformation;

    /**
     * @var PartyIdentificationTag
     */
    private $partyIdentification;

    /**
     * @var RemittanceInformationTag
     */
    private $remittanceInformation;

    public function setCreditorAccount(string $creditorAccount): self
    {
        $this->creditorAccount = $creditorAccount;
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

    public function setPaymentTypeInformation(PaymentTypeInformation $paymentTypeInformation): self
    {
        $this->paymentTypeInformation = $paymentTypeInformation->getTag();
        return $this;
    }

    public function setCreditor(PartyIdentification $partyIdentification): self
    {
        $this->partyIdentification = $partyIdentification->getTag();
        return $this;
    }

    public function setRemittanceInformation(RemittanceInformation $remittanceInformation): self
    {
        $this->remittanceInformation = $remittanceInformation->getTag();
        return $this;
    }

    public function getTag(): CreditTransferTransactionInformationTag
    {
        $tag = CreditTransferTransactionInformationTag::make()
                ->setCreditorAccount($this->creditorAccount)
                ->setPaymentId($this->paymentId)
                ->setAmount($this->amount)
                ->setCreditor($this->partyIdentification);
        if ($this->paymentTypeInformation) {
            $tag->setPaymentTypeInformation($this->paymentTypeInformation);
        }
        if ($this->remittanceInformation) {
            $tag->setRemittanceInformation($this->remittanceInformation);
        }
        return $tag;
    }
}
