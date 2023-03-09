<?php

namespace Condividendo\LaravelCBI\Entities;

use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Tags\PaymentId as PaymentIdTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use RuntimeException;

class PaymentId extends Entity
{
    use Makeable;

    /**
     * @var string
     */
    private $instructionId;

    /**
     * @var string
     */
    private $endToEndId;

    public function setInstructionId(string $instructionId): self
    {
        $this->instructionId = $instructionId;
        return $this;
    }

    public function setEndToEndId(string $endToEndId): self
    {
        $this->endToEndId = $endToEndId;
        return $this;
    }

    public function getTag(): PaymentIdTag
    {
        return PaymentIdTag::make()
                ->setInstructionId($this->instructionId)
                ->setEndToEndId($this->endToEndId);
    }
}
