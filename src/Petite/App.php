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
use Petite\Internal\ApacheRouter;

class App
{
    
    
    /**
     * Name of (non-existing) application for testing purposes only
     *
     * @var string
     */
    const MOCK_APP = 'Petite dry-run app ';
    
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
    
        
        public function __construct(string $appName = self::MOCK_APP)
        {
            
            $this->appName = $appName;
            
            //@todo DI for different http server routing 
            $this->router = ApacheRouter::getInstance();
            $this->controller = $this->router->getController();
            $this->action = $this->router->getAction();
            
//             if ($this->appName != self::MOCK_APP) {
//                 $this->_checkApplicationSanity();
            
            $this->request = new Request();
            $this->response = new Response();
        }
        
        public function setJson()
        {
            $this->response->setType('application/json');
        }
        
        public function setXml()
        {
            $this->response->setType('application/xml');
        }
        
        public function setHtml()
        {
            $this->response->setType('text/html');
        }
        
        public function setJavascript()
        {
            $this->response->setType('text/javascript');
        }
   
}
