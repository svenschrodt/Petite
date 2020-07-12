<?php declare(strict_types = 1);

/**
 * \Petite\Internal\Errors
 *
 * Class holding error messages as *printf - format strings 
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

class Errors
{

    /**
     * Error message for non-existing template files for usage
     * with *printf functions
     *
     * @var string
     */
    const TEMPLATE_NOT_FOUND = 'Template file %s not found in %s';
    
    
    /**
     * Error message for non-existing template files for usage
     * with *printf functions
     *
     * @var string
     */
    const CONFIG_NOT_FOUND = 'Configuration file %s not found';
    

    /**
     * Error message for usage of non-existing HTML 5 element name 
     * with *printf functions
     *
     * @var string
     */
    const INVALID_HTML_ELEMENT = 'The given name %s is not valid as element in HTML 5 - try those: %s';
    
    /**
     * Error message for usage of invalid property name for model instance
     * with *printf functions
     *
     * @var string
     */
    const INVALID_PROPERTY_NAME = 'The given name \'%s\' is not valid in context of class \'%s\'';
    
}
    

