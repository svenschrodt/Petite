<?php declare(strict_types = 1);

/**
 * \Petite\Errors
 * 
 * Class holding error messages
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

class Errors
{
    /**
     * Error message for non-existing template files for usage 
     * with *printf functions
     * 
     * @var string
     */
    const TEMPLATE_NOT_FOUND = 'Template file %s not found in %s';
}
