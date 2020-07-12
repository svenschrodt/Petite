<?php declare(strict_types = 1);
/**
 * \Petite\Internal\Config
 *
 * Main configuration class - holding properties for static getters
 *
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

use Petite\Internal\Errors;

class Config
{

    /**
     * Internally used static instance of
     *
     * @var \DOMDocument
     */
    protected static $cfg = null;

    /**
     * Name of main ini file
     *
     * @var string
     */
    protected static $ini = 'App.ini';

    /**
     * Static getter for array from parsed ini file
     *
     * @todo allowing other cfg formts than ini (php, xml etc.)
     */
    public static function getConfig()
    {
        if (is_null(self::$cfg)) {
            self::$cfg = parse_ini_file(self::$ini);
        }
        return self::$cfg;
    }

    /**
     * Static getter for named config property
     *
     * @param string $name
     * @return string | null
     */
    public static function getProperty(string $name)
    {
        $cfg = self::getConfig();
        return $cfg[$name] ?? null;
    }

    /**
     * Setting configuration file
     *
     * @param string $name
     * @throws \InvalidArgumentException
     */
    public static function setIniFile(string $name)
    {
        if (! file_exists($name)) {
            throw new \InvalidArgumentException(sprintf(Errors::CONFIG_NOT_FOUND, $name));
        } else {
            self::$ini = $name;
        }
    }

    /**
     * Private clone interceptor function
     */
    private function __clone()
    {}

    /**
     * Private constructor function
     */
    private function __construct()
    {}
}
