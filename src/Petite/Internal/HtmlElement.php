<?php
declare(strict_types = 1);
/**
 * \Petite\Internal\HtmlElement 
 *
 * Representing instances of (nested) HTML elements internally using PHP's DOM API (@see https://www.php.net/manual/en/book.dom.php)
 * 
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
use \Petite\Internal\StringHelper;

class HtmlElement
{
    
    /**
     * Flag, for HTML source formating
     * @var boolean
     */
    protected $beautify = true;
    
    /**
     * Name of current element 
     * 
     * @var string
     */
    protected $name = '';
    
   /**
    * Array holding class name(s) for current element
    * 
    * @var array
    */
    protected $class = [];
    
    /**
     * Optional name of current element's ID
     * 
     * @var string | null
     */
    protected $id = null;
    
    /**
     * Internally used instance of
     *
     * @var \DOMDocument
     */
    protected $doc = null;

    /**
     * Internally used instance of
     *
     * @var \DOMElement
     */
    protected $ele = null;

    /**
     * Constructor function 
     *
     * @param string $name
     * @param mixed $content
     * @param array $attribs
     */
    public function __construct(string $name, $content = null, array $attribs = [])
    {
       
        $this->name = $name;
        // We just do that, because DOM*-API forces us to so - otherwise DOMNode instances would be read only
        $this->doc = MockDoc::getInstance();
        $this->ele = new \DOMElement($name);
        $this->doc->appendChild($this->ele);

        $this->setAttributes($attribs);
        
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
    public function __toString(): string
    {
        // Canonicalize nodes to a string @see https://www.php.net/manual/en/domnode.c14n.php
        if($this->beautify) {
            return StringHelper::formatCode($this->ele->C14N());
        } else {
            return $this->ele->C14N();
        }
        
    }

    /**
     * Setting value for attribute 
     * 
     * @param string $key
     * @param string $val
     * @return \Petite\Internal\HtmlElement
     */
    public function setAttribute(string $key, string $val) : \Petite\Internal\HtmlElement
    {
        $this->ele->setAttribute($key, $val);
        return $this;
    }

    /**
     * Setting attributes 
     * 
     * @param array $attribs
     * @return \Petite\Internal\HtmlElement
     */
    public function setAttributes(array $attribs) : \Petite\Internal\HtmlElement
    {
        
        // if we do have attributes, we will give them to the current element
        foreach ($attribs as $key => $val) {
            $this->ele->setAttribute($key, $val);
            switch(mb_strtolower($key)) {
                case 'class' :
                    $this->addClass($val);
                    break;
                case 'id' :
                    $this->setId($val);
                    break;
            }
        }
        return $this;
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
     * Appending child node to current element
     * 
     * @param mixed $node
     *v
     */
    public function appendChild($node) : \Petite\Internal\HtmlElement
    {
        $this->ele->appendChild($this->ensureDomNode($node));
        return $this;
    }

    /**
     * Appending list of child nodes to current element 
     * 
     * @param array $nodeList
     * @return \Petite\Internal\HtmlElement
     */
    public function appendChildren(array $nodeList) : \Petite\Internal\HtmlElement
    {
        foreach($nodeList as $node) {
            $this->appendChild($node);
        }
        return $this;
    }
    
    /**
     * Addig class to element 
     * 
     * @param string $name
     * @return \Petite\Internal\HtmlElement
     */
    public function addClass(string  $name) : \Petite\Internal\HtmlElement
    {
        if(in_array($name, $this->class)) {
            return $this;
        } else {
            $this->class[] = $name;
            // Setting new attribute value for class to internal \DOMElement
            $this->setAttribute('class', implode(' ', $this->class));
        }
        return $this;
    }
    
    /**
     * Removing class from  element
     *  
     * @param string $name
     * @return \Petite\Internal\HtmlElement
     */
    public function removeClass(string $name) : \Petite\Internal\HtmlElement
    {
        if (($key = array_search($name, $this->class)) !== false) {
            unset($this->class[$key]);
            // Setting new attribute value for class to internal \DOMElement
            $this->setAttribute('class', implode(' ', $this->class));
        }
        return $this;
    }
    
    /**
     * Returning array with class name(s) for current element
     * 
     * @return array
     */
    public function getClass() : array
    {
        return $this->class;
    }
    
    
    /**
     * Setting (new) value for ID attribute of current element
     * 
     * @param string $name
     * @return \Petite\Internal\HtmlElement
     */
    public function setId(string $name) : \Petite\Internal\HtmlElement
    {
        $this->id = $name;
        // Setting new attribute value for id to internal \DOMElement
        $this->setAttribute('id',$name); 
        return $this;
    }
    
    /**
     * Getting attribute value for ID of current element 
     * 
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }
    
    /**
     * Returning (internally used) instance of
     *
     * @return \DOMElement
     */
    protected function __toDomElement() : \DOMElement
    {
        return $this->ele;
    }
}
