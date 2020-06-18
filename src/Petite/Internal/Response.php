<?php declare(strict_types = 1);

/**
 * Class representing HTTP response object(s) 
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

class Response
{
    /**
     * Default HTTP status code
     * 
     * @var integer
     */
    protected $status = 200;
    
    /**
     * Default MIME-type for Content-Type response header
     * 
     * @var string
     */
    protected $content = 'text/html';
    
    /**
     * Array holding (custom) HTTTP response headers
     * 
     * @var array
     */
    protected $headers = [];

    /**
     * Set status code for current HTTP response
     * 
     * @param int $code
     * @return \Petite\Internal\Response
     */
   public function setStatus(int $code)
   {
    $this->status = $code;   
    return $this;
   }
   
   /**
    * Set (custom) HTTP response header
    * 
    * @param string $name
    * @param string $value
    * @return \Petite\Internal\Response
    */
   public function setHeader(string $name, string $value) : \Petite\Internal\Response
   {
       $this->headers[$name] = $value;
       if($name==='Content-Type') {
           $this->setContent($value);
       }
       return $this;
   }
   
   /**
    * Sending (custom) HTTP response headers
    * 
    * @return \Petite\Internal\Response
    */
   public function sendHeaders() : \Petite\Internal\Response
   {
       // Setting current http status code for response
       http_response_code($this->status);
       
       // Sending (custom) http response headers
       foreach($this->headers as $name=> $val) {
           header($name .': ' . $val);       
       }
       return $this;
   }
   
   
   /**
    * Getter for HTTP status code of current response
    * 
    * @return int
    */
   public function getStatus() : int
   {
       return $this->status;
   }
   
   
   /**
    * Setter for MIME-type of current HTTP response
    * 
    * @param string $type
    * @return \Petite\Internal\Response
    */
   public function setType(string $type) : \Petite\Internal\Response
   {
       
       //@TODO add optional . '; charset=UTF-8'
       $this->setHeader('Content-Type', $type);
       return $this;
   }
   
   /**
    * Internal setter for Content-Type header
    * 
    * @param string $type
    * @return \Petite\Internal\Response
    */
   protected function setContent(string $type) : \Petite\Internal\Response
   {
       //@todo validation
       $this->content = $type;
       return $this;
   }
   
   /**
    * Getter for Content-Type header
    * 
    * @return string
    */
   public function getContent() : string
   {
       return $this->content;
   }
}

