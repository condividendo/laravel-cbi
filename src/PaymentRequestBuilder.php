<?php

namespace Condividendo\LaravelCBI;

use Condividendo\LaravelCBI\Entities\CreditTransferTransactionInformation;
use Condividendo\LaravelCBI\Entities\FinancialInstitution;
use Condividendo\LaravelCBI\Entities\InitiatingParty;
use Condividendo\LaravelCBI\Entities\PartyIdentification;
use Condividendo\LaravelCBI\Entities\PaymentId;
use Condividendo\LaravelCBI\Entities\PaymentRequest\PaymentInstruction;
use Condividendo\LaravelCBI\Entities\PaymentRequest\PaymentTypeInformation;
use Condividendo\LaravelCBI\Entities\RemittanceInformation;

use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentRequest as PaymentRequestTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentInfo as PaymentInfoTag;
use Condividendo\LaravelCBI\Tags\InitiatingParty as InitiatingPartyTag;
use Condividendo\LaravelCBI\Tags\GroupHeader as GroupHeaderTag;

use Condividendo\LaravelCBI\Tags\CreditTransferTransactionInformation as CreditTransferTransactionInformationTag;
use Condividendo\LaravelCBI\Tags\FinancialInstitution as FinancialInstitutionTag;
use Condividendo\LaravelCBI\Tags\PartyIdentification as PartyIdentificationTag;
use Condividendo\LaravelCBI\Tags\PaymentId as PaymentIdTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentInstruction as PaymentInstructionTag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentTypeInformation as PaymentTypeInformationTag;
use Condividendo\LaravelCBI\Tags\RemittanceInformation as RemittanceInformationTag;

use Condividendo\LaravelCBI\Enums\PaymentRequest\CategoryPurpose;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentMethod;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentPriority;
use Condividendo\LaravelCBI\Enums\PaymentRequest\CommissionPayer;
use Condividendo\LaravelCBI\Enums\ServiceLevel;

use Illuminate\Support\Facades\Date;
use DOMDocument;
use SimpleXMLElement;

class PaymentRequestBuilder extends GroupHeaderBuilder
{
    /**
     * @var array<\Condividendo\LaravelCBI\PaymentRequest\Entities\PaymentInstruction>
     */
    private $paymentInstruction;

    public function setPaymentInstruction(PaymentInstruction $paymentInstruction): self
    {
        $this->paymentInstruction = $paymentInstruction;

        return $this;
    }
    
    public function toDOM(): DOMDocument
    {
        $dom = new DOMDocument();
        $dom->appendChild($this->makePaymentRequestTag()->toDOMElement($dom));

        return $dom;
    }

    public function toXML(): SimpleXMLElement
    {
        $xml = simplexml_import_dom($this->toDOM());
        assert($xml instanceof SimpleXMLElement);

        return $xml;
    }

    private function makePaymentRequestTag(): PaymentRequestTag
    {
        return PaymentRequestTag::make()
            ->setGroupHeader($this->makeGroupHeader())
            ->setPaymentInfo($this->makePaymentInfo());
    }

    private function makePaymentInfo(): PaymentInfoTag
    {
        return PaymentInfoTag::make(); // TODO
    }
    
}
