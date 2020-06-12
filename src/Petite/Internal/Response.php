<?php declare(strict_types = 1);

/**
 * Class representing http response(s) 
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
    protected $status = 200;
    
    protected $content = 'text/html';
    
    protected $headers = [];

   public function setStatus(int $code)
   {
    $this->status = $code;   
    return $this;
   }
   
   public function setHeader(string $name, string $value)
   {
       $this->headers[$name] = $value;
       if($name==='Content-Type') {
           $this->setContent($value);
       }
       return $this;
   }
   
   public function sendHeaders()
   {
       // Setting current http status code for response
       http_response_code($this->status);
       
       // Sending (custom) http response headers
       foreach($this->headers as $name=> $val) {
           header($name .': ' . $val);       
       }
   }
   
   
   public function getStatus()
   {
       return $this->status;
   }
   
   
   
   public function setType($type)
   {
       $this->setHeader('Content-Type', $type);
   }
   
   //
   protected function setContent(string $type)
   {
       //@todo validation
       $this->content = $type;
       return $this;
   }
   
   public function getContent()
   {
       return $this->content;
   }
}

