<?php

namespace Condividendo\LaravelCBI;

use Condividendo\LaravelCBI\Entities\InitiatingParty;
use Condividendo\LaravelCBI\Tags\GroupHeader as GroupHeaderTag;

class GroupHeaderBuilder
{
    /**
     * @var string
     */
    protected $messageId;

    /**
     * @var string
     */
    protected $creditTime;

    /**
     * @var int
     */
    protected $numberOfTxs;
    
    /**
     * @var string
     */
    protected $ctrlSum;
    
    /**
     * @var array<\Condividendo\LaravelCBI\Entities\InitiatingParty>
     */
    protected $initiatingParty;

    public function setMessageId(string $messageId): self
    {
        $this->messageId = $messageId;

        return $this;
    }

    public function setCreditTime(string $creditTime): self
    {
        $this->creditTime = $creditTime;

        return $this;
    }

    public function setNumberOfTxs(int $numberOfTxs): self
    {
        $this->numberOfTxs = $numberOfTxs;

        return $this;
    }

    public function setControlSum(string $ctrlSum): self
    {
        $this->ctrlSum = $ctrlSum;

        return $this;
    }

    public function setInitiatingParty(InitiatingParty $initiatingParty): self
    {
        $this->initiatingParty = $initiatingParty;

        return $this;
    }

    protected function makeGroupHeader(): GroupHeaderTag
    {
        return GroupHeaderTag::make()->setMessageId($this->messageId)
            ->setNumberOfTxs($this->numberOfTxs)
            ->setCreditTime($this->creditTime)
            ->setControlSum($this->ctrlSum)
            ->setInitiatingParty($this->initiatingParty->getTag());
    }    
    
}
