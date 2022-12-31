<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Enums\ServiceLevel;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentPriority;
use Condividendo\LaravelCBI\Tags\Tag;
use Condividendo\LaravelCBI\Tags\PaymentRequest\PaymentPriority as PaymentPriorityTag;
use Condividendo\LaravelCBI\Tags\ServiceLevel as ServiceLevelTag;
use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PaymentTypeInfo extends Tag
{
    use Makeable;

    /**
     * @var PaymentPriorityTag
     */
    private $paymentPriority;  

    /**
     * @var ServiceLevelTag
     */
    private $serviceLevel;  

    public function setPaymentPriority(PaymentPriority $paymentPriority): self
    {
        $this->paymentPriority = PaymentPriorityTag::make()->setPaymentPriority($paymentPriority);
        return $this;
    }    

    public function setServiceLevel(ServiceLevel $serviceLevel): self
    {
        $this->serviceLevel = ServiceLevelTag::make()->setServiceLevel($serviceLevel);
        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        $e = $dom->createElement('PmtTpInf');
        $e->appendChild($this->paymentPriority->toDOMElement($dom));
        $e->appendChild($this->serviceLevel->toDOMElement($dom));
        return $e;
    }
}
