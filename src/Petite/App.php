<?php declare(strict_types = 1);

/**
 * Main app(lication) class instantiating app and managing http routing etc.
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

namespace Petite;

use Petite\Internal\Request;
use Petite\Internal\Response;
//@TODO -> dynamic loading
use Petite\Internal\ApacheRouter;
use Petite\Internal\Config;

class App
{
    
    
    /**
     * Name of (non-existing) application for testing purposes only
     *
     * @var string
     */
    const MOCK_APP = 'Petite dry-run app';
    
    /**
     * Name of current application
     *
     * @var string
     */
    protected $appName = '';
    
    /**
     * Instance of application router
     *
     * @var \Petite\Internal\RouterInterface $router
     */
    protected $router;
    
    /**
     * Instance of current http request
     *
     * @var \Petite\Internal\Request
     */
    protected $request;
    
    /**
     * Instance of current http response
     *
     * @var \Petite\Internal\Response
     */
    protected $response;
    
    /**
     * Current controller for response
     *
     * @var \Petite\Front
     */
    protected $controller;
    
    /**
     * Name of current action for response
     *
     * @var string
     */
    protected $action;
    
        /**
         * Constructor function 
         * 
         * @param string $appName
         */
        public function __construct(string $appName = self::MOCK_APP)
        {
            
            $this->appName = $appName;
            
            //@todo DI for different http server routing 
//             $routerName = Config::getProperty('router');
            $this->router = ApacheRouter::getInstance();
            
            // Setting up, controller, action function and parameters from current request
            $this->controller = $this->router->getController();
            $this->action = $this->router->getAction();
       
            // Setting up request and response object
            $this->request = new Request($this->router );
            $this->response = new Response();
        }
        
        /**
         * Setting up response as JSON
         */
        public function setJson()
        {
            $this->response->setType('application/json');
        }
        
        /**
         * Setting up response as XML
         */
        public function setXml()
        {
            $this->response->setType('application/xml');
        }
        
        /**
         * (Re-)Setting up response as HTML
         */
        public function setHtml()
        {
            $this->response->setType('text/html');
        }
        
        /**
         * Setting up response as Javascript
         */
        public function setJavascript()
        {
            $this->response->setType('text/javascript');
        }
        
        /**
         * Setting up response as plain text
         */
        public function setPlainText()
        {
            $this->response->setType('text/plain');
        }
        
        public function getRouter() 
        {
            return $this->router;
        }
   
}
