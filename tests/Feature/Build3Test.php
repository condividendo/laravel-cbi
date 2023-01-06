<?php
namespace Condividendo\LaravelCBI\Tests\Feature;

use Condividendo\LaravelCBI\Tests\TestCase;
use Condividendo\LaravelCBI\CBI;
use Condividendo\LaravelCBI\SDDBuilder;
use Condividendo\LaravelCBI\Entities\PaymentTypeInfo;
use Condividendo\LaravelCBI\Entities\FinancialInstitution;
use Condividendo\LaravelCBI\Entities\InitiatingParty;
use Condividendo\LaravelCBI\Entities\PartyIdentification;
use Condividendo\LaravelCBI\Entities\PaymentId;
use Condividendo\LaravelCBI\Entities\RemittanceInformation;
use Condividendo\LaravelCBI\Entities\PostalAddress;
use Condividendo\LaravelCBI\Entities\SDD\PaymentInstruction;
use Condividendo\LaravelCBI\Entities\SDD\CreditorSchemeId;
use Condividendo\LaravelCBI\Entities\SDD\MandateRelatedInformation;
use Condividendo\LaravelCBI\Entities\SDD\DirectDebitTransaction;
use Condividendo\LaravelCBI\Entities\SDD\DirectDebitTransactionInformation;
use Condividendo\LaravelCBI\Enums\ServiceLevel;
use Condividendo\LaravelCBI\Enums\OrgIdType;
use Condividendo\LaravelCBI\Enums\Country;
use Condividendo\LaravelCBI\Enums\SDD\PaymentMethod;
use Condividendo\LaravelCBI\Enums\SDD\LocalInstrument;
use Condividendo\LaravelCBI\Enums\SDD\SequenceType;
use Condividendo\LaravelCBI\Enums\SDD\Purpose;
use Condividendo\LaravelCBI\Traits\UsesDecimal;
use Illuminate\Support\Facades\Date;

class Build3Test extends TestCase
{
    use UsesDecimal; 

    public function test_xml(): void
    {
        $xml = $this->build()->toXML()->asXML();
        echo "test_xml() xml:\r\n$xml\r\n"; 
        assert(is_string($xml));

        $this->assertXmlStringEqualsXmlFile(__DIR__ . '/../fixtures/3.xml', $xml);
    }
    
    public function test_schema(): void
    {
        $dom = $this->build()->toDOM();

        $this->assertTrue(
            $dom->schemaValidate(__DIR__ . "/../fixtures/CBISDDReqLogMsg.00.01.00.xsd"),
            "XML not compliant to payment request schema!"
        );
    }

    private function build(): SDDBuilder
    {
        return CBI::sdd()
        ->setMessageId('1')
        ->setNumberOfTxs(1)
        ->setCreditTime("2022-02-05T18:19:00+01:00")
        ->setControlSum("100")
        ->setInitiatingParty(
            InitiatingParty::make()
                ->setName('Condividendo Italia s.r.l.')
                ->setId('12345678', OrgIdType::CBI())
        )
        ->setPaymentInstruction(
            PaymentInstruction::make()
                ->setId('1')
                ->setPaymentMethod(PaymentMethod::DD())
                ->setBatchBooking(true)
                ->setPaymentTypeInfo(
                    PaymentTypeInfo::make()
                        ->setServiceLevel(ServiceLevel::SEPA())
                        ->setLocalInstrument(LocalInstrument::B2B())
                        ->setSequenceType(SequenceType::RCUR())
                )
                ->setRequiredCollectionDate(Date::createFromDate(2022, 1, 1))
                ->setCreditor(
                    PartyIdentification::make()
                        ->setName('Condividendo Italia s.r.l.')
                        ->setPostalAddress(
                            PostalAddress::make()
                                ->setCountry(Country::IT())
                                ->addAddressLine("Viale Sardegna, 31")
                                ->addAddressLine("47838 Riccione (RN)")
                    )
                )
                ->setCreditorAccount('IT60X0542811101000000123456')
                ->setExecutingBank(
                    FinancialInstitution::make()
                        ->setClearingSystemMemberId('01234')
                )
                ->setCreditorSchemeId(
                    CreditorSchemeId::make()
                        ->setName('Condividendo Italia s.r.l.')
                        ->setId('IT210010000000123456789')
                )
                ->addDirectDebitTransactionInformation(
                    DirectDebitTransactionInformation::make()
                        ->setPaymentId(
                            PaymentId::make()
                                ->setInstructionId('1')
                                ->setEndToEndId('1.1')
                        )
                        ->setAmount(self::makeDecimal("100"))
                        ->setMandateRelatedInformation(
                            MandateRelatedInformation::make()
                                ->setMandateId('012345')
                                ->setDateOfSignature(Date::createFromDate(2022, 1, 1))
                                ->setAmendmentIndicator(false)
                        )
                        ->setDebtor(
                            PartyIdentification::make()
                                ->setName('Pinco Pallino')
                                ->setPostalAddress(
                                    PostalAddress::make()
                                        ->setCity("ROVIGO")
                                        ->setCountry(Country::IT())
                                        ->addAddressLine("VIA DE GASPERI 181")
                                        ->addAddressLine("XXXXX ROVIGO (RO)")
                                )
                                ->setPrivateId("12345678901")
                        )
                        ->setDebtorAccount('IT60X0542811101000000123456')
                        ->setPurpose(Purpose::PADD())
                        ->setRemittanceInformation(
                            RemittanceInformation::make()
                                ->setUnstructured('Abcd 123')
                        )
                )
        );
    }
}
