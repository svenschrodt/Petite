<?php
/**
 * Testing \Petite\Internal\HtmlHelper
 * 
 * @package Petite
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @link https://github.com/svenschrodt/Petite
 * @link https://travis-ci.org/github/svenschrodt/Petite
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 * @since 2020-06-12
 */
class HtmlHelperTest extends \PHPUnit\Framework\TestCase
{

    public function testInstatiationOfHelper()
    {
        $foo = new \Petite\Internal\HtmlHelper();
        $this->assertInstanceOf('\Petite\Internal\HtmlHelper', $foo);
    }
    
    public function testIfQuotationIsWorkingCorrectly()
    {
        $quoted = \Petite\Internal\HtmlHelper::quote('Sven');
        $this->assertTrue($quoted === '"Sven"');
        $quoted = \Petite\Internal\HtmlHelper::quote('Sven', "'");
        $this->assertTrue($quoted === "'Sven'");

    }
    
}


