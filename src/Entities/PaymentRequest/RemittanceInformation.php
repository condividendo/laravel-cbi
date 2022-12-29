<?php
namespace Condividendo\LaravelCBI\Entities\PaymentRequest;

use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Tags\PaymentRequest\RemittanceInformation as RemittanceInformationTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use RuntimeException;

class RemittanceInformation extends Entity
{
    use Makeable;

    /**
     * @var string
     */
    private $unstructured;
    
    public function setUnstructured(string $unstructured): self
    {
        $this->unstructured = $unstructured;
        return $this;
    }  
    
    public function getTag(): RemittanceInformationTag
    {
        return RemittanceInformationTag::make()
                ->setUnstructured($this->unstructured);
    }
}