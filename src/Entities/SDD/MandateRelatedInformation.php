<?php
namespace Condividendo\LaravelCBI\Entities\SDD;

use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Tags\SDD\MandateRelatedInformation as MandateRelatedInformationTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use RuntimeException;

class MandateRelatedInformation extends Entity
{
    use Makeable;

    /**
     * @var string
     */
    private $dateOfSignature;

    /**
     * @var string
     */
    private $id;

    /**
     * @var bool
     */
    private $amendmentIndicator;

    public function setDateOfSignature(string $date): self
    {
        $this->dateOfSignature = $date;
        return $this;
    }  

    public function setAmendmentIndicator(bool $amendmentIndicator): self
    {
        $this->amendmentIndicator = $amendmentIndicator;
        return $this;
    }  

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }  
    
    public function getTag(): MandateRelatedInformationTag
    {
        return MandateRelatedInformationTag::make()
                ->setId($this->id)
                ->setDateOfSignature($this->dateOfSignature)
                ->setAmendmentIndicator($this->amendmentIndicator);
    }    
}
