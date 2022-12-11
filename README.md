# Laravel CBI

[![Latest Version](http://img.shields.io/packagist/v/condividendo/laravel-cbi.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/condividendo/laravel-cbi)
[![MIT License](https://img.shields.io/github/license/condividendo/laravel-cbi.svg?label=License&color=blue&style=for-the-badge)](https://github.com/condividendo/laravel-cbi/blob/master/LICENSE.md)

Implementation of [CBI Standards](https://www.cbi-org.eu/) in Laravel.

## Installation

```shell
composer require condividendo/laravel-cbi
```

## Usage

### SEPA Direct Debit

```php
use Brick\Money\Money;
use Condividendo\LaravelCBI\CBI;
use Condividendo\LaravelCBI\Entities\DirectDebitTransaction;
use Condividendo\LaravelCBI\Entities\DirectDebitTransactionInformation;
use Condividendo\LaravelCBI\Entities\FinancialInstitution;
use Condividendo\LaravelCBI\Entities\InitiatingParty;
use Condividendo\LaravelCBI\Entities\MandateRelatedInformation;
use Condividendo\LaravelCBI\Entities\PartyIdentification;
use Condividendo\LaravelCBI\Entities\PaymentId;
use Condividendo\LaravelCBI\Entities\SDD\PaymentInstruction;
use Condividendo\LaravelCBI\Entities\SDD\PaymentTypeInformation;
use Condividendo\LaravelCBI\Enums\LocalInstrument;
use Condividendo\LaravelCBI\Enums\SDD\PaymentMethod;
use Condividendo\LaravelCBI\Enums\SequenceType;
use Condividendo\LaravelCBI\Enums\ServiceLevel;
use Illuminate\Support\Facades\Date;

$sdd = CBI::sdd()
    ->setMessageId('1')
    ->setInitiatingParty(
        InitiatingParty::make()
            ->setName('Condividendo Italia s.r.l.')
            ->setId('12345678', 'CBI')
    )
    ->addPaymentInstruction(
        PaymentInstruction::make()
            ->setId('1')
            ->setPaymentMethod(PaymentMethod::DD())
            ->setPaymentTypeInformation(
                PaymentTypeInformation::make()
                    ->setServiceLevel(ServiceLevel::SEPA())
                    ->setLocalInstrument(LocalInstrument::B2B())
                    ->setSequenceType(SequenceType::RCUR())
            )
            ->setRequiredCollectionDate(Date::createFromDate(2022, 1, 1))
            ->setCreditor(
                PartyIdentification::make()
                    ->setName('Condividendo Italia s.r.l.')
            )
            ->setCreditorAccount('IT60X0542811101000000123456')
            ->setExecutingBank(
                FinancialInstitution::make()
                    ->setClearingSystemMemberId('01234')
            )
            ->setCreditorSchemeId(
                PartyIdentification::make()
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
                    ->setAmount(Money::of(100, 'EUR'))
                    ->setDirectDebitTransaction(
                        DirectDebitTransaction::make()
                            ->setMandateRelatedInformation(
                                MandateRelatedInformation::make()
                                    ->setMandateId('012345')
                                    ->setDateOfSignature(Date::createFromDate(2022, 1, 1))
                            )
                    )
                    ->setDebtor(
                        PartyIdentification::make()
                            ->setName('Pinco Pallino')
                    )
                    ->setDebtorAccount('IT60X0542811101000000123456')
            )
    );

/** @var \SimpleXMLElement $xml */
$xml = $sdd->toXML();

// do whatever you want with $xml variable...
```

### Payment Request

```php
use Brick\Money\Money;
use Condividendo\LaravelCBI\CBI;
use Condividendo\LaravelCBI\Entities\CreditTransferTransactionInformation;
use Condividendo\LaravelCBI\Entities\FinancialInstitution;
use Condividendo\LaravelCBI\Entities\InitiatingParty;
use Condividendo\LaravelCBI\Entities\PartyIdentification;
use Condividendo\LaravelCBI\Entities\PaymentId;
use Condividendo\LaravelCBI\Entities\PaymentRequest\PaymentInstruction;
use Condividendo\LaravelCBI\Entities\PaymentRequest\PaymentTypeInformation;
use Condividendo\LaravelCBI\Entities\RemittanceInformation;
use Condividendo\LaravelCBI\Enums\CategoryPurpose;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentMethod;
use Condividendo\LaravelCBI\Enums\PaymentRequest\PaymentPriority;
use Condividendo\LaravelCBI\Enums\PaymentRequest\CommissionPayer;
use Condividendo\LaravelCBI\Enums\ServiceLevel;
use Illuminate\Support\Facades\Date;

$sdd = CBI::paymentRequest()
    ->setMessageId('1')
    ->setInitiatingParty(
        InitiatingParty::make()
            ->setName('Condividendo Italia s.r.l.')
            ->setId('12345678', 'CBI')
    )
    ->setPaymentInstruction(
        PaymentInstruction::make()
            ->setId('1')
            ->setPaymentMethod(PaymentMethod::TRA())
            ->setPaymentPriority(PaymentPriority::NORM())
            ->setServiceLevel(ServiceLevel::SEPA())
            ->setCommissionPayer(CommissionPayer::SLEV())
            ->setRequiredExecutionDate(Date::createFromDate(2022, 1, 1))
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
                    ->setAmount(Money::of(100, 'EUR'))
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

/** @var \SimpleXMLElement $xml */
$xml = $sdd->toXML();

// do whatever you want with $xml variable...
```

## Changelog

Please see [Changelog File](CHANGELOG.md) for more information on what has changed recently.

## Testing

```shell
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
