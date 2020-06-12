<?php
declare(strict_types = 1);
/**
 * \Petite\Internal\HtmlHelper
 *
 * Representing instances of (nested) HTML elements internally using PHP's DOM API
 * @see https://www.php.net/manual/en/book.dom.php
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
    /**
     * Internally used instance of 
     * @var \DOMDocument
     */
    protected $doc = null;

    /**
     * Internally used instance of
     * @var \DOMElement
     */
    protected $ele = null;

    public function __construct(string $name, $content = null, array $attribs = [])
    {
        // We just do that, because DOM*-API forces us to so - otherwise DOMNode instances would be read only
        $this->doc = MockDoc::getInstance();
        $this->ele = new \DOMElement($name);
        $this->doc->appendChild($this->ele);

        // if we do have attributes, we will give them to the current element
        foreach ($attribs as $key => $val) {
            $this->ele->setAttribute($key, $val);
        }

        // No content, no problem and vice versa!
        if (! is_null($content)) {
            $this->ele->appendChild($this->ensureDomNode($content));
        }
    }

    /**
     * Returning string representation of \Petite\Internal\HtmlElement
     * (internally using: \DomNode)
     *
     * @return string
     */
    public function __toString() : string
    {
        // Canonicalize nodes to a string @see https://www.php.net/manual/en/domnode.c14n.php
        return $this->ele->C14N();
    }

    /**
     * Ensuring, that given content will be converted to an instance of \DomNode (or children)
     *
     * @param mixed $content
     * @return \DOMElement|\DomNode|\DOMText|\DOMNode
     */
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

    /**
     * Returning (internally used) instance of 
     * @return DOMElement
     */
    public function __toDomElement()
    {
        return $this->ele;
    }
}
