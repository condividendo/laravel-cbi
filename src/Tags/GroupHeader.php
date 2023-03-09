<?php

namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Traits\Makeable;
use Condividendo\LaravelCBI\Tags\MessageId;
use Condividendo\LaravelCBI\Tags\InitiatingParty;
use Condividendo\LaravelCBI\Tags\CreditTime;
use Condividendo\LaravelCBI\Tags\NumberOfTxs;
use Condividendo\LaravelCBI\Tags\CtrlSum;
use DOMDocument;
use DOMElement;

class GroupHeader extends Tag
{
    use Makeable;

    /**
     * @var \Condividendo\LaravelCBI\Tags\MessageId
     */
    private $messageId;

    /**
     * @var \Condividendo\LaravelCBI\Tags\CreditTime
     */
    private $creditTime;

    /**
     * @var \Condividendo\LaravelCBI\Tags\NumberOfTxs
     */
    private $numberOfTxs;

    /**
     * @var \Condividendo\LaravelCBI\Tags\CtrlSum
     */
    private $ctrlSum;

    /**
     * @var \Condividendo\LaravelCBI\Tags\InitiatingParty
     */
    private $initiatingParty;

    public function setMessageId(string $messageId): self
    {
        $this->messageId = MessageId::make()->setMessageId($messageId);

        return $this;
    }

    public function setCreditTime(string $creditTime): self
    {
        $this->creditTime = CreditTime::make()->setCreditTime($creditTime);

        return $this;
    }

    public function setNumberOfTxs(int $numberOfTxs): self
    {
        $this->numberOfTxs = NumberOfTxs::make()->setNumberOfTxs($numberOfTxs);

        return $this;
    }

    public function setControlSum(string $controlSum): self
    {
        $this->ctrlSum = CtrlSum::make()->setControlSum($controlSum);

        return $this;
    }

    public function setInitiatingParty(InitiatingParty $initiatingParty): self
    {
        $this->initiatingParty = $initiatingParty;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('GrpHdr');

        $e->appendChild($this->messageId->toDOMElement($dom));
        $e->appendChild($this->creditTime->toDOMElement($dom));
        $e->appendChild($this->numberOfTxs->toDOMElement($dom));
        $e->appendChild($this->ctrlSum->toDOMElement($dom));
        $e->appendChild($this->initiatingParty->toDOMElement($dom));

        return $e;
    }
}
