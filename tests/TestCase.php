<?php

namespace Condividendo\LaravelCBI\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Condividendo\LaravelCBI\ServiceProvider;
use XMLReader;
use XmlValidator\XmlValidator;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    protected function validateXmlAgainstXsd(string $xmlPath, string $xsdPath)
    {
        // Use 2 different XML libraries
        // to validate the XML against the schema:
        // 'XMLReader' and 'XmlValidator'

        // Validate w/ XMLReader
        libxml_use_internal_errors(true);
        libxml_clear_errors();
        $xml = new XMLReader();
        $xml->open($xmlPath);
        $xml->setSchema($xsdPath);
        while ($xml->read());
        $errors = libxml_get_errors();
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $exceptionMsg = "validateXmlAgainstXsd(): XMLReader found an error. ";
                $exceptionMsg .= "$error->message (line: {$error->line}, column: {$error->column})";
                throw new \Exception($exceptionMsg);
            }
        }
        $xml->close();

        // Validate w/ XmlValidator
        $xml = file_get_contents($xmlPath);
        $xmlValidator = new XmlValidator();
        $xmlValidator->validate($xml, $xsdPath);
        if (!$xmlValidator->isValid()) {
            foreach ($xmlValidator->errors as $error) {
                throw new \Exception("validateXmlAgainstXsd(): XmlValidator found an error. $error");
            }
        }

        return true;
    }
}
