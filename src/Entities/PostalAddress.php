<?php
namespace Condividendo\LaravelCBI\Entities;

use Condividendo\LaravelCBI\Entities\Entity;
use Condividendo\LaravelCBI\Enums\AddressType;
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
     * @var string
     */
    private $country;

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

    public function setCountry(string $country): self
    {
        $this->country = $country;
        return $this;
    }  

    public function setAddressType(AddressType $addressType): self
    {
        $this->addressType = $addressType;
        return $this;
    }
    
    public function getTag(): PostalAddressTag
    {
        return PostalAddressTag::make()
                ->setAddressType($this->addressType)
                ->setStreetName($this->streetName)
                ->setCity($this->city)
                ->setPostalCode($this->postalCode)
                ->setCountry($this->country);
    }
}
