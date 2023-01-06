<?php
namespace Condividendo\LaravelCBI\Tests\Feature;

use Condividendo\LaravelCBI\Tests\TestCase;
use Condividendo\LaravelCBI\CBI;
use Condividendo\LaravelCBI\PaymentRequestBuilder;
use Condividendo\LaravelCBI\Entities\PartyIdentification;
use Condividendo\LaravelCBI\Entities\InitiatingParty;
use Condividendo\LaravelCBI\Entities\PaymentTypeInfo;
use Condividendo\LaravelCBI\Entities\PaymentId;
use Condividendo\LaravelCBI\Entities\RemittanceInformation;
use Condividendo\LaravelCBI\Entities\FinancialInstitution;
use Condividendo\LaravelCBI\Entities\PaymentRequest\CreditTransferTransactionInformation;
use Condividendo\LaravelCBI\Entities\PaymentRequest\PaymentInstruction;
use Condividendo\LaravelCBI\Entities\PaymentRequest\PaymentTypeInformation;
use Condividendo\LaravelCBI\Enums\PaymentRequest\CategoryPurpose;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentMethod;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentPriority;
use Condividendo\LaravelCBI\Enums\PaymentRequest\CommissionPayer;
use Condividendo\LaravelCBI\Enums\ServiceLevel;
use Condividendo\LaravelCBI\Enums\OrgIdType;
use Condividendo\LaravelCBI\Traits\UsesDecimal;
use Illuminate\Support\Facades\Date;

class Build2Test extends TestCase
{
    use UsesDecimal; 

    public function test_xml(): void
    {
        $xml = $this->build()->toXML()->asXML();
        echo "test_xml() xml:\r\n$xml\r\n"; 
        assert(is_string($xml));

        $this->assertXmlStringEqualsXmlFile(__DIR__ . '/../fixtures/2.xml', $xml);
    }
    
    public function test_schema(): void
    {
        $dom = $this->build()->toDOM();

        $this->assertTrue(
            $dom->schemaValidate(__DIR__ . "/../fixtures/CBIPaymentRequest.00.04.00.xsd"),
            "XML not compliant to payment request schema!"
        );
    }

    private function build(): PaymentRequestBuilder
    {
        // TODO: add instructions for San Marino

        return CBI::paymentRequest()
                ->setMessageId('1')
                ->setNumberOfTxs(1)
                ->setCreditTime("2022-02-05T18:19:00+01:00")
                ->setControlSum("760")
                ->setInitiatingParty(
                    InitiatingParty::make()
                        ->setName('Condividendo Italia s.r.l.')
                        ->setId('12345678', OrgIdType::CBI())
                )
                ->setPaymentInstruction(
                    PaymentInstruction::make()
                        ->setId('1')
                        ->setPaymentMethod(PaymentMethod::TRA())
                        ->setPaymentTypeInfo(
                            PaymentTypeInfo::make()
                                ->setPaymentPriority(PaymentPriority::NORM())
                                ->setServiceLevel(ServiceLevel::SEPA())
                        )
                        ->setCommissionPayer(CommissionPayer::SLEV())
                        ->setRequiredExecutionDate(Date::createFromDate(2022, 2, 6))
                        ->setBatchBooking(true)
                        ->setDebtor(
                            PartyIdentification::make()
                                ->setName('Condividendo Italia s.r.l.')
                        )            
                        ->setDebtorAccount('IT60X0542811101000000123456')
                        ->setExecutingBank(
                            FinancialInstitution::make()
                                ->setClearingSystemMemberId('01234')
                        )
                        ->addCreditTransferTransactionInformation(
                            CreditTransferTransactionInformation::make()
                                ->setPaymentId(
                                    PaymentId::make()
                                        ->setInstructionId('1')
                                        ->setEndToEndId('1.1')
                                )
                                ->setPaymentTypeInformation(
                                    PaymentTypeInformation::make()
                                        ->setCategoryPurpose(CategoryPurpose::SUPP())
                                )
                                ->setAmount(self::makeDecimal("760"))
                                ->setCreditor(
                                    PartyIdentification::make()
                                        ->setName('Pinco Pallino')
                                )
                                ->setCreditorAccount('IT60X0542811101000000123456')
                                ->setRemittanceInformation(
                                    RemittanceInformation::make()
                                        ->setUnstructured('Abcd 123')
                                )
                        )
                );
    }
}
