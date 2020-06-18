<?php declare(strict_types = 1);
/**
 * \Petite\Internal\MockDoc
 *
 * Internally used for representation of an instance of hidden \DOMDocument Singleton,
 * allowing us internal use of PHP's DOM API
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

final class MockDoc
{

    /**
     * Internally used static instance of 
     * @var \DOMDocument
     */
    protected static $instance = null;

    /**
     * Private constructor function
     */
    private function __construct()
    {}

    /**
     * Static getter for singleton instance of Petite\Internal\MockDoc
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new \DOMDocument();
        }
        return self::$instance;
    }
    
    /**
     * Private clone interceptor function
     */
    private function __clone()
    {}
}
