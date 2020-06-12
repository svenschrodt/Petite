<?php
declare(strict_types = 1);
/**
 * \Petite\Internal\MockDoc
 *
 * Internally used for representation of an instance of hidden \DOMDocument Singleton
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

    protected static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new \DOMDocument();
        }
        return self::$instance;
    }

    private function __clone()
    {}
}
