<?php
namespace Condividendo\LaravelCBI\Entities;

use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Entities\PostalAddress;
use Condividendo\LaravelCBI\Tags\PostalAddress as PostalAddressTag;
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

    /**
     * @var PostalAddressTag
     */ 
    private $postalAddress; 

    /**
     * @var string
     */ 
    private $privateId; 
    
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }  
    
    public function setPrivateId(string $privateId): self
    {
        $this->privateId = $privateId;
        return $this;
    }  
    
    public function setPostalAddress(PostalAddress $postalAddress): self
    {
        $this->postalAddress = $postalAddress->getTag();
        return $this;
    }  
    
    public function getTag(): PartyIdentificationTag
    {
        $tag = PartyIdentificationTag::make()
                ->setName($this->name);
        if($this->privateId){
            $tag->setPrivateId($this->privateId);
        }
        if($this->postalAddress){
            $tag->setPostalAddress($this->postalAddress);
        }
        return $tag;
    }
}