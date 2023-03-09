<?php

namespace Condividendo\LaravelCBI;

class SDD
{
    public static function build(): SDDBuilder
    {
        return new SDDBuilder();
    }
}
