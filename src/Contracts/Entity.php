<?php

namespace Condividendo\LaravelCBI\Contracts;

interface Entity extends Makeable
{
    /**
     * @return \Condividendo\LaravelCBI\Contracts\Tag
     * @noinspection PhpMissingReturnTypeInspection
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ReturnTypeHint
     */
    public function getTag();
}
