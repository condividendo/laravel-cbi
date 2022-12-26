<?php
namespace Condividendo\LaravelCBI\Entities;

use Condividendo\LaravelCBI\Tags\InitiatingParty as InitiatingPartyTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use RuntimeException;

class InitiatingParty extends Entity
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

    /**
     * @var string
     */
    private $issr;
    
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setId(string $id, string $issr): self
    {
        $this->id = $id;
        $this->issr = $issr;
        return $this;
    }    
    
    public function getTag(): InitiatingPartyTag
    {
        return InitiatingPartyTag::make()
            ->setName($this->name)
            ->setId($this->id,$this->issr);
    }

}