<?php declare(strict_types = 1);
/**
 * \Petite\Internal\StringHelper
 * 
 * Class with static function for managing string data
 *
 * @package Petite
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-27
 * @link https://github.com/svenschrodt/Petite
 * @link https://travis-ci.org/github/svenschrodt/Petite
 * @license https://github.com/svenschrodt/Petite/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace Petite\Internal;

class StringHelper
{

    /**
     * Formatting given code for better readability
     * 
     * @TODO -> Do real formatting!
     * 
     * @param string $code
     * @param boolean $isHtml
     * @return string
     */
    public static function formatCode(string $code, $isHtml=true) : string
    {
        if ($isHtml) {
            return PHP_EOL . $code .PHP_EOL;
        }
    }
    
  }
