<?php declare(strict_types = 1);
/**
 * Petite\Internal\Router
 *  
 *  Apache specific routing mechanisms
 *
 * Routing given URI to Controller name, action name and parameter list
 *
 * @todo Implementing:
 * 
 *       - REGEX-based Routing and
 *       - static routes
 *       - decoupling from global context via DI to \Petite\App
 *      
 * @package Petite
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2012-06-12
 * @link https://github.com/svenschrodt/Petite
 * @link https://travis-ci.org/github/svenschrodt/Petite
 * @license https://github.com/svenschrodt/Petite/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace Petite\Internal;
                            
final class ApacheRouter implements RouterInterface
{

    /**
     * Current instance of Router (Singleton)
     *
     * @var \Petite\Internal\RouterInterface | null
     */
    private static $_instance = null;

    /**
     * Document root (in file system)of current application
     * (root directory with index.php and .htaccess)
     *
     * @var string
     */
    private $appDocRoot = '';

    /**
     * Application Http Root (in URI) of current application
     * (root directory with index.php and .htaccess)
     *
     * @var string
     */
    private $appHttpRoot = '';

    /**
     * Name of current controller,extracted from URI by routing
     *
     * @var string
     */
    private $controller = '';

    /**
     * Name of current action (method function of ccurrent controller),extracted
     * from URI by routing
     *
     * @var string
     */
    private $action = '';

    /**
     * Current parameters,extracted from URI by routing
     * + HTTP GET parameters (from super global $_GET)
     *
     * (separated form URL by '?')
     *
     * @var array
     */
    private $get = array();

    /**
     * Current POST parameters send within payload, when method POST is used
     * (extracted from super global $_POST)
     *
     * @var array
     */
    private $post = array();

    /**
     * Current PUT parameters send within payload, when method PUT is used
     * (extracted from PHP input stream 'php://')
     *
     * Hint: this input stream can only be read once
     *
     * @var array
     */
    private $put = array();

    /**
     * Name of index file used for bootstrapping
     *
     * @var string
     */
    private $index = 'index.php';
    
    /**
     * Default name of controller
     * @var string
     */
    private $defaultController = 'default';

    /**
     * Default name of Action
     * @var string
     */
    private $defaultAction = 'default';
    

    /**
     * Private constructor function for being Router Singleton
     */
    private function __construct()
    {
        $this->init();
    }

    // @TODO private __clone etc. for ensuring being Singleton

    /**
     * Getting single/same instance of this Router by run time
     *
     * @return \Petite\Internal\RouterInterface
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    
    /**
     * Getting name of current controller retrieved from URI routing
     * (part of URI or default fallback)
     *
     * @return string
     */
    public function getController() : string
    {
        return $this->controller;
    }
    
    /**
     * Getting name of current action retrieved from URI routing
     * (part of URI or default fallback)
     *
     * @return string
     */
    public function getAction() : string 
    {
        return $this->action; 
    }

    /**
     * Getting application Routing information from URI and Http context data
     * [GET, POST; PUT etc.]
     *
     * @todo -> add commenting!
     *      
     */
    private function init()
    {
        if (php_sapi_name() === 'cli') {
            
            //@TODO get Mock/Stub data for testing purposes, if not in http context
            return;
        }
        $path = $_SERVER['REQUEST_URI'];
        if(strstr($path, '?')) {
            $tmp = explode('?',$path);
            $path = $tmp[0];
        }
        $this->appHttpRoot = str_replace($this->index,'',$_SERVER['SCRIPT_NAME']);
        print_r ($this->appHttpRoot);
        
        
        $contAction = str_replace($this->appHttpRoot,'',$path);
       

        $applicationParts = explode('/', $contAction);
        
        // routing by number of given URI parts
        switch (count($applicationParts)) {
            case 0: // no controller and action given -> both default

                $this->controller = $this->defaultController;
                $this->action = $this->defaultAction;
                break;
                
            case 1: // no action given -> default action
                $this->controller = array_shift($applicationParts);
                $this->action = $this->defaultAction;
                break;
                
            default: // all other URIs
                $this->controller = array_shift($applicationParts);
                $this->action = array_shift($applicationParts);
                $this->get = $applicationParts;
                //@TODO work this mess!!
                if (count($_GET) > 0) {
                    $this->get = array_merge($this->get, $_GET);
                }
        }
    }
}