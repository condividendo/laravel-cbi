<?php

namespace Condividendo\LaravelCBI;

class PaymentRequest
{
    public static function build(): PaymentRequestBuilder
    {
        return new PaymentRequestBuilder();
    }
}
