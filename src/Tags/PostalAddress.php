<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Enums\Country;
use Condividendo\LaravelCBI\Enums\AddressType;
use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\StreetName;
use Condividendo\LaravelCBI\Tags\City;
use Condividendo\LaravelCBI\Tags\Country as CountryTag;
use Condividendo\LaravelCBI\Tags\PostalCode;
use Condividendo\LaravelCBI\Tags\AddressType as AddressTypeTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PostalAddress extends Tag
{
    use Makeable;

    /**
     * @var AddressTypeTag
     */
    private $addressType;

    /**
     * @var StreetName
     */
    private $streetName;

    /**
     * @var array<AddressLine>
     */
    private $addressLines;

    /**
     * @var City
     */
    private $city;

    /**
     * @var PostalCode
     */
    private $postalCode;

    /**
     * @var CountryTag
     */
    private $country;

    public function setStreetName(string $streetName): self
    {
        $this->streetName = StreetName::make()->setStreetName($streetName);
        return $this;
    }  

    public function addAddressLine(string $addressLine): self
    {
        $this->addressLines[] = AddressLine::make()->setAddressLine($addressLine);
        return $this;
    }  

    public function setCity(string $city): self
    {
        $this->city = City::make()->setCity($city);
        return $this;
    }  

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = PostalCode::make()->setPostalCode($postalCode);
        return $this;
    }  

    public function setCountry(Country $country): self
    {
        $this->country = CountryTag::make()->setCountry($country);
        return $this;
    }  

    public function setAddressType(AddressType $addressType): self
    {
        $this->addressType = AddressTypeTag::make()->setAddressType($addressType);
        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('PstlAdr');
        if($this->addressType){
            $e->appendChild($this->addressType->toDOMElement($dom));
        }
        if($this->streetName){
            $e->appendChild($this->streetName->toDOMElement($dom));
        }
        if($this->postalCode){
            $e->appendChild($this->postalCode->toDOMElement($dom));
        }
        if($this->city){
            $e->appendChild($this->city->toDOMElement($dom));
        }
        if($this->country){
            $e->appendChild($this->country->toDOMElement($dom));
        }
        if($this->addressLines){
            foreach($this->addressLines as $al){
                $e->appendChild($al->toDOMElement($dom));
            }
        }
        return $e;
    }
}
