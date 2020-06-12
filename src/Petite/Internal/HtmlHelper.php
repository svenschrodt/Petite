<?php

declare(strict_types = 1);
/**
 * \Petite\Internal\HtmlHelper
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

class HtmlHelper
{

    /**
     * Quoting a value
     *
     * @param string $value
     * @param string $qs
     * @return string
     */
    public static function quote(string $value, string $qs = '"')
    {
        return sprintf("$qs%s$qs", $value);
    }

    /**
     * Creating assignment like $Key = '$value'
     *
     * @param string $key
     * @param mixed $value
     * @param string $quote
     * @param string $eol
     * @param string $assignId
     * @return string
     */
    public static function getAttributeAssignment(string $key, string $value, string $quote = '"', string $eol = '', string $assignId = '=') : string
    {
        /**
         * Handling HTML class(es)- generating attribute assignment value part
         * e.g:
         *
         * <code>
         * "name" || "classOne classTwo"
         * </code>
         */
        if ($key === 'class' && is_array($value)) {
            $value = implode(' ', $value);
        }

        /**
         * Handling null values - e.g: pre-defined $this->_attributes['id']
         */
        if (is_null($value)) {
            return '';
        }

        /**
         * Generating assignment - e.g:
         * <code>
         * href="Foo.php"
         * </code>
         */
        return implode('', array(
            $key,
            $assignId,
            self::quote($value)
        )) . $eol;
    }

    /**
     * Creating list of assignments
     *
     * @param array $data
     * @param string $quote
     * @return string
     */
    public static function getAttributeList(array $data, string $quote = '"') : string
    {
        $tmp = array();
        foreach ($data as $key => $value) {
            $tmp[] = self::getAttributeAssignment($key, $value, $quote);
        }
        return implode(' ', $tmp);
    }
}
