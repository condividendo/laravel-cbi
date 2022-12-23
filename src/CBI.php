<?php

namespace Condividendo\LaravelCBI;

class CBI 
{
    public static function paymentRequest(){
        return PaymentRequest::build();
    }


    public static function SDD(){
        return SDD::build();
    }

}
