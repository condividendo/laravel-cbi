<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\PartyIdentification;
use Condividendo\LaravelCBI\Tags\CreditorAccount;
use Condividendo\LaravelCBI\Tags\PaymentRequest\Amount;
use Condividendo\LaravelCBI\Tags\PaymentId;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentTypeInformation;
use Condividendo\LaravelCBI\Tags\RemittanceInformation;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class CreditTransferTransactionInformation extends Tag
{
    use Makeable;

    /**
     * @var CreditorAccount
     */
    private $creditorAccount;

    /**
     * @var Amount
     */
    private $amount;

    /**
     * @var PaymentId
     */
    private $paymentId;

    /**
     * @var PaymentTypeInformation
     */
    private $paymentTypeInformation;

    /**
     * @var PartyIdentification
     */
    private $partyIdentification;

    /**
     * @var RemittanceInformation
     */
    private $remittanceInformation;
    
    public function setCreditorAccount(string $creditorAccount): self
    {
        $this->creditorAccount = CreditorAccount::make()->setCreditorAccount($creditorAccount);
        return $this;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = Amount::make()->setAmount($amount);
        return $this;
    }  
    
    public function setPaymentId(PaymentId $paymentId): self
    {
        $this->paymentId = $paymentId;
        return $this;
    }  
    
    public function setPaymentTypeInformation(PaymentTypeInformation $paymentTypeInformation): self
    {
        $this->paymentTypeInformation = $paymentTypeInformation;
        return $this;
    }  
    
    public function setCreditor(PartyIdentification $partyIdentification): self
    {
        $this->partyIdentification = $partyIdentification->setAsDebtorOrCreditor(false);
        return $this;
    }  
    
    public function setRemittanceInformation(RemittanceInformation $remittanceInformation): self
    {
        $this->remittanceInformation = $remittanceInformation;
        return $this;
    }  
    
    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('CdtTrfTxInf');
        $e->appendChild($this->paymentId->toDOMElement($dom));
        $e->appendChild($this->paymentTypeInformation->toDOMElement($dom));
        $e->appendChild($this->amount->toDOMElement($dom));
        $e->appendChild($this->partyIdentification->toDOMElement($dom));
        $e->appendChild($this->creditorAccount->toDOMElement($dom));
        $e->appendChild($this->remittanceInformation->toDOMElement($dom));
        return $e;
    }
}