<?php
namespace Condividendo\LaravelCBI\Entities;

use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Tags\PartyIdentification as PartyIdentificationTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use RuntimeException;

class PartyIdentification extends Entity
{
    use Makeable;

    /**
     * @var string
     */
    private $name;
    
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }  
    
    public function getTag(): PartyIdentificationTag
    {
        return PartyIdentificationTag::make()
                ->setName($this->name);
    }

}