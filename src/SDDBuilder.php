<?php
namespace Condividendo\LaravelCBI;

use Condividendo\LaravelCBI\Entities\CreditTransferTransactionInformation;
use Condividendo\LaravelCBI\Entities\FinancialInstitution;
use Condividendo\LaravelCBI\Entities\InitiatingParty;
use Condividendo\LaravelCBI\Entities\PartyIdentification;
use Condividendo\LaravelCBI\Entities\PaymentId;

use Condividendo\LaravelCBI\Tags\SDD\SDD as SDDTag;
use Condividendo\LaravelCBI\Tags\SDD\PaymentInfo as PaymentInfoTag;
use Condividendo\LaravelCBI\Tags\InitiatingParty as InitiatingPartyTag;
use Condividendo\LaravelCBI\Tags\GroupHeader as GroupHeaderTag;

use Condividendo\LaravelCBI\Enums\PaymentRequest\CategoryPurpose;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentMethod;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentPriority;
use Condividendo\LaravelCBI\Enums\PaymentRequest\CommissionPayer;
use Condividendo\LaravelCBI\Enums\ServiceLevel;

use Illuminate\Support\Facades\Date;
use DOMDocument;
use SimpleXMLElement;

class SDDBuilder
{
    /**
     * @var string
     */
    private $messageId;
    
    /**
     * @var array<\Condividendo\LaravelCBI\Entities\InitiatingParty>
     */
    private $initiatingParty;

    /**
     * @var array<\Condividendo\LaravelCBI\Entities\PaymentRequest\PaymentInstruction>
     */
    private $paymentInstruction;

    public function setInitiatingParty(InitiatingParty $initiatingParty): self
    {
        $this->initiatingParty = $initiatingParty;

        return $this;
    }
    
    public function toDOM(): DOMDocument
    {
        $dom = new DOMDocument();
        $dom->appendChild($this->makeSDDTag()->toDOMElement($dom));

        return $dom;
    }

    public function toXML(): SimpleXMLElement
    {
        $xml = simplexml_import_dom($this->toDOM());
        assert($xml instanceof SimpleXMLElement);

        return $xml;
    }

    private function makeSDDTag(): SDDTag
    {
        return SDDTag::make()
            ->setGroupHeader($this->makeGroupHeader())
            ->setPaymentInfo($this->makePaymentInfo());
    }

    private function makeGroupHeader(): GroupHeaderTag
    {
        return GroupHeaderTag::make()->setMessageId($this->messageId)
            ->setInitiatingParty($this->initiatingParty->getTag());
    }

    private function makePaymentInfo(): PaymentInfoTag
    {
        return PaymentInfoTag::make(); // TODO
    }
    
}
