<?php declare(strict_types = 1);
/**
 * \Petite\Element
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

class ElementFactory
{
    
   public static function img($uri)
   {
       return '<img src="'.$uri.'">';
   }
    
   
   public static function getElement(string $name, array $attribs, $content = null)
   {
       $ele = new HtmlElement($data);
   }
   
}