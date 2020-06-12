<?php declare(strict_types = 1);

/**
 * Tiny class for rendering HTML 5 document templates
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

class Document
{

    const TITLE = 'No Title';

    const CONTENT = 'No Content';

    /**
     * Default HTML 5 document template
     *
     * @var string
     */
    protected $tpl = 'tpl/document.php';

    /**
     * Generic constructor function
     */
    public function __construct()
    {
        // @TODO wtf?
    }

    /**
     * Assigning new / or overwriting existing (public) property of Document instance
     * with current value
     *
     * @param string $key
     * @param string $val
     * @return Document
     */
    public function assigns(string $key, string $val)
    {
        $this->$key = $val;
        return $this;
    }

    /**
     * Assigning new / or overwriting existing (public) properties of Document instance
     * with current value
     *
     * @param array $data
     * @return Document
     */
    public function assign(array $data)
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
        $this->sanitizeProperties();
        if ($buffer) {
            ob_start();
            $content = ob_get_contents();
        }

        require_once $this->tpl;
        
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
    public function __toString()
    {
        return $this->render(true);
    }

    public function setTpl(string $tpl)
    {
        if(!file_exists($tpl)) {
            throw new \InvalidArgumentException(sprintf(Errors::TEMPLATE_NOT_FOUND, $tpl, getcwd()));
        }
        
        $this->tpl = $tpl;
    }
    
    /**
     * Checking, if mandatory properties of template are set, or set defaults
     */
    protected function sanitizeProperties()
    {
        if (! isset($this->title)) {
            $this->title = self::TITLE;
        }

        if (! isset($this->content)) {
            $this->content = self::CONTENT;
        }
    }
}