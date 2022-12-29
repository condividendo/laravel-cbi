<?php
namespace Condividendo\LaravelCBI\Tags\PaymentRequest;

use Condividendo\LaravelCBI\Enums\PaymentRequest\AddressType;
use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\StreetName;
use Condividendo\LaravelCBI\Tags\PaymentRequest\City;
use Condividendo\LaravelCBI\Tags\PaymentRequest\Country;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PostalCode;
use Condividendo\LaravelCBI\Tags\PaymentRequest\AddressType as AddressTypeTag;
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
     * @var City
     */
    private $city;

    /**
     * @var PostalCode
     */
    private $postalCode;

    /**
     * @var Country
     */
    private $country;

    public function setStreetName(string $streetName): self
    {
        $this->streetName = StreetName::make()->setStreetName($streetName);
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

    public function setCountry(string $country): self
    {
        $this->country = Country::make()->setCountry($country);
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
        $e->appendChild($this->addressType->toDOMElement($dom));
        $e->appendChild($this->streetName->toDOMElement($dom));
        $e->appendChild($this->postalCode->toDOMElement($dom));
        $e->appendChild($this->city->toDOMElement($dom));
        $e->appendChild($this->country->toDOMElement($dom));
        return $e;
    }
}
