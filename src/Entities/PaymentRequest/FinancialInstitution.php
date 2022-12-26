<?php
namespace Condividendo\LaravelCBI\Entities\PaymentRequest;

use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Tags\PaymentRequest\FinancialInstitution as FinancialInstitutionTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use RuntimeException;

class FinancialInstitution extends Entity
{
    use Makeable;

    /**
     * @var string
     */
    private $memberId;
    
    public function setClearingSystemMemberId(string $memberId): self
    {
        $this->memberId = $memberId;
        return $this;
    }  
    
    public function getTag(): FinancialInstitutionTag
    {
        return FinancialInstitutionTag::make()
                ->setClearingSystemMemberId($this->memberId);
    }

}