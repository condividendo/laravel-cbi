<?php
namespace Condividendo\LaravelCBI\Entities\SDD;

use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Tags\SDD\CreditorSchemeId as CreditorSchemeIdTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use RuntimeException;

class CreditorSchemeId extends Entity
{
    use Makeable;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $id;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }  

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }  
    
    public function getTag(): CreditorSchemeIdTag
    {
        return CreditorSchemeIdTag::make()
                ->setId($this->name,$this->id);
    }    
}
