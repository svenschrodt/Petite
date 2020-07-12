<?php

/**
 * Testing \Petite\App
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
class AppTest extends \PHPUnit\Framework\TestCase
{

    public function testInstatiationOfRequest()
    {
        $foo = new \Petite\App();
        $this->assertInstanceOf('\Petite\App', $foo);
    }

    
//     public function testIfRouterIsValid()
//     {
// //         \Petite\Internal\RouterInterface $router
//         $foo = new \Petite\App();
//         var_dump($foo);
//         die;
//         $this->assertInstanceOf('\Petite\Internal\RouterInterface', $foo);
        
        
//     }
 
}



