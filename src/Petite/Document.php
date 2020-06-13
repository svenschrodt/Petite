<?php declare(strict_types = 1);

/**
 * \Petite\Document
 * 
 * Tiny class for rendering HTML 5 document templates - managing 'View' part of MVC
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

use Petite\HtmlFactory;
use Petite\Internal\Errors;

class Document
{

    protected $helper;
    
    /**
     * Default document title
     * 
     * @var string
     */
    const TITLE = 'No Title today';

    /**
     * Default document content
     * 
     * @var string
     */
    const CONTENT = 'No Content yet';

    /**
     * Default HTML 5 document template
     *
     * @var string
     */
    protected $tpl = 'Tpl/document.php';

    /**
     * Generic constructor function
     */
    public function __construct()
    {
        $this->helper = new HtmlFactory();
    }

    /**
     * Assigning new / or overwriting existing (public) property of Document instance
     * with current value
     *
     * @param string $key
     * @param string $val
     * @return \Petite\Document
     */
    public function assigns(string $key, string $val) : \Petite\Document
    {
        $this->$key = $val;
        return $this;
    }

    /**
     * Assigning new / or overwriting existing (public) properties of Document instance
     * with current value
     *
     * @param array $data
     * @return \Petite\Document
     */
    public function assign(array $data) : \Petite\Document
    {
        foreach ($data as $key => $val) {
            $this->$key = $val;
        }
        return $this;
    }

    /**
     * Rendering current HTML 5 template with current properties, with optional buffering of output,
     * by default direct output will occur
     * 
     * @param boolean $buffer
     * @return string
     */
    public function render($buffer = false)
    {
        // Setting default properties, if necessary
        $this->sanitizeProperties();
        
        // Buffering output for returning? 
        if ($buffer) {
            ob_start();
            $content = ob_get_contents();
        }
        
        // including template file for direct output or buffering
        require_once $this->tpl;
        
        // Buffering output for returning? 
        if ($buffer) {
            ob_end_flush();
            return $content;
        }
    }

    
    /**
     * Magical interceptor function for usage of Document in string context with direct output
     * 
     * @return string
     */
    public function __toString() : string
    {
        return $this->render(true);
    }

    /**
     * Setting template file for current view | document |*-resource
     * 
     * 
     * @TODO repair pathing!!
     * 
     * @param string $tpl
     * @throws \InvalidArgumentException
     * @return \Petite\Document
     */
    public function setTpl(string $tpl) : \Petite\Document
    {
        die(getcwd());
        if(!file_exists($tpl)) {
            throw new \InvalidArgumentException(sprintf(Errors::TEMPLATE_NOT_FOUND, $tpl, getcwd()));
        }
        
        $this->tpl = $tpl;
        return $this;
    }
    
    /**
     * Checking, if mandatory properties of template are set, or set defaults
     */
    protected function sanitizeProperties()
    {
        // Setting default document title
        if (! isset($this->title)) {
            $this->title = self::TITLE;
        }
        // Setting default document content (HTML body)
        if (! isset($this->content)) {
            $this->content = self::CONTENT;
        }
    }
}
