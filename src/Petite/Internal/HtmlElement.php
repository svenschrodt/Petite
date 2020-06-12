<?php
declare(strict_types = 1);
/**
 * \Petite\Internal\HtmlHelper
 *
 * @package Petite
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2020-06-10
 * @link https://github.com/svenschrodt/Petite
 * @link https://travis-ci.org/github/svenschrodt/Petite
 * @license https://github.com/svenschrodt/Petite/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace Petite\Internal;

class HtmlElement
{

    protected $doc = null;

    protected $ele = null;

    public function __construct(string $name, array $attribs, $content = null)
    {
        $this->doc = MockDoc::getInstance();
        $this->ele = new \DOMElement($name);
        $this->doc->appendChild($this->ele);
        foreach ($attribs as $key => $val) {
            $this->ele->setAttribute($key, $val);
        }
        if (! is_null($content)) {

            $this->ele->appendChild($this->ensureDomNode($content));
        }
    }

    /**
     * Returning string representation of \Petite\Internal\HtmlElement
     * (internal: \DomNode)
     *
     * @return string
     */
    public function __toString()
    {

        // Canonicalize nodes to a string @see https://www.php.net/manual/de/domnode.c14n.php
        return $this->ele->C14N();
    }

    protected function ensureDomNode($content)
    {
        switch (true) {
            case $content instanceof HtmlElement:
                return $content->__toDomElement();
            case $content instanceof \DomNode:
                return $content;
            case is_string($content):
                return new \DOMText($content);
            default:
                return new \DOMNode();
        }
    }

    public function __toDomElement()
    {
        return $this->ele;
    }
}
