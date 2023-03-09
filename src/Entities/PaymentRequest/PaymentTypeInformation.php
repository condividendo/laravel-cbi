<?php

namespace Condividendo\LaravelCBI\Entities\PaymentRequest;

use Condividendo\LaravelCBI\Enums\PaymentRequest\CategoryPurpose;
use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentTypeInformation as PaymentTypeInformationTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use RuntimeException;

class PaymentTypeInformation extends Entity
{
    use Makeable;

    /**
     * @var CategoryPurpose
     */
    private $categoryPurpose;

    public function setCategoryPurpose(CategoryPurpose $categoryPurpose): self
    {
        $this->categoryPurpose = $categoryPurpose;
        return $this;
    }

    public function getTag(): PaymentTypeInformationTag
    {
        return PaymentTypeInformationTag::make()
                ->setCategoryPurpose($this->categoryPurpose);
    }
}
