<?php

namespace Condividendo\LaravelCBI\Contracts;

use DOMDocument;
use DOMElement;

interface Tag extends Makeable
{
    public function toDOMElement(DOMDocument $dom): DOMElement;
}
