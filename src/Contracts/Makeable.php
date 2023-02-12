<?php

namespace Condividendo\LaravelCBI\Contracts;

interface Makeable
{
    /**
     * @return self
     * @noinspection PhpMissingReturnTypeInspection
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ReturnTypeHint
     */
    public static function make();
}
