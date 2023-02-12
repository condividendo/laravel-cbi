<?php
namespace Condividendo\LaravelCBI\Entities;

use Condividendo\LaravelCBI\Contracts\Entity as EntityContract;

abstract class Entity implements EntityContract
{
    final public function __construct() { }
}
