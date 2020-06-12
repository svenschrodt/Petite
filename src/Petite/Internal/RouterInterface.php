<?php declare(strict_types = 1);
/**
 * Petite\Internal\RouterInterface 
 * 
 * Defining API for http routing for several web servers
 *
 * @package Petite
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2012-06-12
 * @link https://github.com/svenschrodt/Petite
 * @link https://travis-ci.org/github/svenschrodt/Petite
 * @license https://github.com/svenschrodt/Petite/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace Petite\Internal;  

interface RouterInterface
{

    
    public static function getInstance();
    public function getController() : string;
    public function getAction() : string;
    
    
}
