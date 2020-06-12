<?php
/**
 * Basic testing of PHPUnit's functionality
 * 
 * 
 * @link https://github.com/svenschrodt/P7User
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @package P7Tools
 * @license https://github.com/svenschrodt/P7Tools/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 */
class BasicTest extends \PHPUnit\Framework\TestCase
{

    public function testInstatiationOfFoo()
    {
        $foo = new \Petite\Document();
        $this->assertInstanceOf('\Petite\Document', $foo);
       
    }
    public function testInstatiationOfBar()
    {
        $foo = new \Petite\Internal\HtmlElement('h2', 'FOO', []);
        $this->assertTrue(is_object($foo));
        
    }
}


