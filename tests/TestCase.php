<?php

namespace Condividendo\LaravelCBI\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Condividendo\LaravelCBI\ServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }
}
