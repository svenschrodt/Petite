<?php
/**
 * Testing \Petite\Internal\Response
 * 
 * @package P7Tools
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @link https://github.com/svenschrodt/Petite
 * @link https://travis-ci.org/github/svenschrodt/Petite
 * @license https://github.com/svenschrodt/Petite/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 * @version 0.0.23
 * @since 2020-06-12
 */
class ResponseTest extends \PHPUnit\Framework\TestCase
{

    public function testInstatiationOfResponse()
    {
        $foo = new \Petite\Internal\Response();
        $this->assertInstanceOf('\Petite\Internal\Response', $foo);       
    }
    
    public function testStatusCodeOfResponse()
    {
        $foo = new \Petite\Internal\Response();
        $this->assertTrue(is_int($foo->getStatus()));
        $this->assertTrue(200 === $foo->getStatus());
        $foo->setStatus(500);
        $this->assertTrue(is_int($foo->getStatus()));
        $this->assertTrue(500 === $foo->getStatus());
    }
    
    
    public function testContentTypeOfResponse()
    {
        $foo = new \Petite\Internal\Response();
        $this->assertTrue(is_string($foo->getContent()));
        $this->assertTrue('text/html' === $foo->getContent());
        $bar = 'application/json';
        $foo->setType($bar);
        $this->assertTrue(is_string($foo->getContent()));
        $this->assertTrue($bar=== $foo->getContent());
    }
    
}


