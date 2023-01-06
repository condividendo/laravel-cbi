<?php
namespace Condividendo\LaravelCBI\Entities;

use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Enums\AddressType;
use Condividendo\LaravelCBI\Enums\Country;
use Condividendo\LaravelCBI\Tags\PostalAddress as PostalAddressTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use RuntimeException;

class PostalAddress extends Entity
{
    use Makeable;

    /**
     * @var AddressType
     */
    private $addressType;

    /**
     * @var string
     */
    private $streetName;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var Country
     */
    private $country;

    /**
     * @var array<string>
     */
    private $addressLines;

    public function setStreetName(string $streetName): self
    {
        $this->streetName = $streetName;
        return $this;
    }  

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }  

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;
        return $this;
    }  

    public function setCountry(Country $country): self
    {
        $this->country = $country;
        return $this;
    }  

    public function setAddressType(AddressType $addressType): self
    {
        $this->addressType = $addressType;
        return $this;
    }

    public function addAddressLine(string $addressLine): self
    {
        $this->addressLines[] = $addressLine;
        return $this;
    }  
    
    public function getTag(): PostalAddressTag
    {
        $tag = PostalAddressTag::make();
        if($this->addressType){        
            $tag->setAddressType($this->addressType);
        }
        if($this->streetName){        
            $tag->setStreetName($this->streetName);
        }
        if($this->city){    
            $tag->setCity($this->city);
        }
        if($this->postalCode){    
            $tag->setPostalCode($this->postalCode);
        }
        if($this->country){   
            $tag->setCountry($this->country); 
        }
        foreach($this->addressLines as $al){
            $tag->addAddressLine($al); 
        }
        return $tag;
    }
}
