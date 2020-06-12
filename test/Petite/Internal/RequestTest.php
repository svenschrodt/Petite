<?php
/**
 * Testing \Petite\Internal\Request
 * 
 * 
 * @TODO  Mocking http context variables etc. for testing
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
class RequestTest extends \PHPUnit\Framework\TestCase
{

    public function testInstatiationOfRequest()
    {
        $foo = new \Petite\Internal\Request();
        $this->assertInstanceOf('\Petite\Internal\Request', $foo);
    }

    
}


