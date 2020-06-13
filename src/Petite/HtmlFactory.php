<?php declare(strict_types = 1);
/**
 * \Petite\HtmlFactory 
 * 
 * Factory class for building HTML 5 element(s)
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
namespace Petite;
use \Petite\Internal\HtmlElement;
use \Petite\Internal\Html5Spec;
use \Petite\Internal\Errors;

class HtmlFactory
{
    
    /**
     * 
     * @var \Petite\Internal\Html5Spec
     */
    protected $spec;
    
    /**
     * Constructor function 
     * 
     */
    public function __construct()
    {
        $this->spec = new Html5Spec();
    }
    
    /**
     * Building HTML <select> element with children (<option>)
     * 
     * @TODO attribute handling for children!!!
     * 
     * @param string $name
     * @param array $data
     * @param array $attribs
     * @return \Petite\Internal\HtmlElement;
     */
    public function select(string $name, array $data, array $attribs) : \Petite\Internal\HtmlElement
    {
        $sel = new HtmlElement('select');
        $sel->setAttributes($attribs);
        $nodes = [];
        foreach ($data as $idx => $val) {
            $nodes[] = new HtmlElement('option', $val, ['value'=>(string) $idx]);
        }
        $sel->appendChildren($nodes);
        return $sel;
    }
   
    
    public function __call($name, $args)
    {
        
        if($this->spec->isElement($name)) {
            return new HtmlElement($name, $args[0], $args[1]);
        } else {
            throw new \InvalidArgumentException(sprintf(Errors::INVALID_HTML_ELEMENT, $name, implode(', ', $this->spec->getElements())));
        }
        
    }
   
}
