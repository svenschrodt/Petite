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
class HtmlElementTest extends \PHPUnit\Framework\TestCase
{

    public function testInstatiationOfElement()
    {
        $foo = new \Petite\Internal\HtmlElement('h1');
        $this->assertInstanceOf('\Petite\Internal\HtmlElement', $foo);
    }
    
    public function testHandlingOfClassAttributes()
    {
        $foo = new \Petite\Internal\HtmlElement('h1');
        $foo->addClass('Bar');
        $foo->addClass('Baz');
        $foo->addClass('Foo');
        $this->assertTrue(count($foo->getClass())===3);
        $foo->removeClass('Baz');
        $this->assertTrue(count($foo->getClass())===2);
        $this->assertFalse(in_array('Baz', $foo->getClass()));
        $this->assertTrue(in_array('Foo', $foo->getClass()));
        $this->assertTrue(in_array('Bar', $foo->getClass()));
    }
    
}


