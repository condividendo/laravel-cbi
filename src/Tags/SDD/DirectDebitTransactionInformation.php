<?php
namespace Condividendo\LaravelCBI\Tags\SDD;

use Condividendo\LaravelCBI\Enums\SDD\Purpose;
use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\PartyIdentification;
use Condividendo\LaravelCBI\Tags\DebtorAccount;
use Condividendo\LaravelCBI\Tags\InstantiatedAmount;
use Condividendo\LaravelCBI\Tags\PaymentId;
use Condividendo\LaravelCBI\Tags\RemittanceInformation;
use Condividendo\LaravelCBI\Tags\SDD\DirectDebitTransaction;
use Condividendo\LaravelCBI\Tags\SDD\Purpose as PurposeTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class DirectDebitTransactionInformation extends Tag
{
    use Makeable;

    /**
     * @var DebtorAccount
     */
    private $debtorAccount;

    /**
     * @var InstantiatedAmount
     */
    private $amount;

    /**
     * @var PaymentId
     */
    private $paymentId;

    /**
     * @var DirectDebitTransaction
     */
    private $directDebitTransaction;

    /**
     * @var PartyIdentification
     */
    private $partyIdentification;

    /**
     * @var PurposeTag
     */
    private $purpose;

    /**
     * @var RemittanceInformation
     */
    private $remittanceInformation;
    
    public function setDebtorAccount(string $debtorAccount): self
    {
        $this->debtorAccount = DebtorAccount::make()->setDebtorAccount($debtorAccount);
        return $this;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = InstantiatedAmount::make()->setAmount($amount);
        return $this;
    }  
    
    public function setPaymentId(PaymentId $paymentId): self
    {
        $this->paymentId = $paymentId;
        return $this;
    }  
    
    public function setDirectDebitTransaction(DirectDebitTransaction $directDebitTransaction): self
    {
        $this->directDebitTransaction = $directDebitTransaction;
        return $this;
    }  
    
    public function setDebtor(PartyIdentification $partyIdentification): self
    {
        $this->partyIdentification = $partyIdentification->setAsDebtorOrDebtor(true);
        return $this;
    }  
    
    public function setPurpose(Purpose $purpose): self
    {
        $this->purpose = PurposeTag::make()->setPurpose($purpose);
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
        $e = $dom->createElement('DrctDbtTxInf');
        $e->appendChild($this->paymentId->toDOMElement($dom));
        $e->appendChild($this->amount->toDOMElement($dom));
        $e->appendChild($this->directDebitTransaction->toDOMElement($dom));
        $e->appendChild($this->partyIdentification->toDOMElement($dom));
        $e->appendChild($this->debtorAccount->toDOMElement($dom));
        $e->appendChild($this->purpose->toDOMElement($dom));
        $e->appendChild($this->remittanceInformation->toDOMElement($dom));
        return $e;
    }
}