<?php declare(strict_types = 1);

/**
 * Class representing http request(s)
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

class Request
{

    /**
     * Meta infomation aquired from super globals in http context
     *
     * @var array
     */
    protected $meta;

    
    /**
     * Instance of application router
     *
     * @var \Petite\Internal\RouterInterface $router
     */
    protected $router;
    
    /**
     * Generic costructor function
     */
    public function __construct(\Petite\Internal\RouterInterface $router)
    {
        $this->init();
        //@todo DI for different http server routing
        $this->router = $router;
    }

    /**
     * Getter for used HTTP method of current request 
     * 
     * @return NULL|string
     */
    public function getMethod()
    {
        return $this->getMetaInfo('method');
    }

    /**
     * Getter for meta information on current HTTP context
     * 
     * @param string $key
     * @return array
     */
    public function getMetaInfo(string $key) : array 
    {
        return $this->meta[$key] ?? [];
    }

    /**
     * Getting meta information for current HTTP context from super globals
     *
     * @todo Do more commenting
     */
    protected function init()
    {
        if (php_sapi_name() === 'cli') {
            
            //@TODO get Mock/Stub data for testing purposes, if not in http context
            return ;
        }
        
        //@todo DI for different http server routing
        $this->router = ApacheRouter::getInstance();
      
        $this->meta = $this->router->getMeta(); 
        
        
    }
}
