<?php
namespace Condividendo\LaravelCBI\Tags;

use Condividendo\LaravelCBI\Traits\Makeable;
use DOMDocument;
use DOMElement;

class MessageId extends Tag
{
    use Makeable;

    /**
     * @var string
     */
    private $messageId;  

    public function setMessageId(string $messageId): self
    {
        $this->messageId = $messageId;

        return $this;
    }    

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('MsgId',$this->messageId);
    }
}
