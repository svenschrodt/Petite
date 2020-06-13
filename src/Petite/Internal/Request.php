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
     * Generic costructor function
     */
    public function __construct()
    {
        $this->init();
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
            return;
        }
       
        $this->meta = array(
            'queryString' => $_SERVER['QUERY_STRING'],
            'uri' => $_SERVER['REQUEST_URI'],
            'method' => $_SERVER['REQUEST_METHOD'],
            'serverPort' => $_SERVER['SERVER_PORT'],
            'serverName' => $_SERVER['SERVER_NAME'],
            'serverSoftware' => $_SERVER['SERVER_SOFTWARE'],
            'serverAddress' => $_SERVER['SERVER_ADDR'],
            'protocol' => $_SERVER['SERVER_PROTOCOL'],
            'remotePort' => $_SERVER['REMOTE_PORT'],
            'remoteHost' => $_SERVER['HTTP_HOST'],
            'remoteAddress' => $_SERVER['REMOTE_ADDR'],
            'userAgent' => $_SERVER['HTTP_USER_AGENT'],
            'accept' => $_SERVER['HTTP_ACCEPT'],
            'acceptLanguage' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
            'acceptEncoding' => $_SERVER['HTTP_ACCEPT_ENCODING'],
            'connection' => $_SERVER['HTTP_CONNECTION']
        );
        // extract URL from URI if needed
        $this->meta['url'] = (strstr($_SERVER['REQUEST_URI'], '?')) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?')) : $_SERVER['REQUEST_URI'];
        list ($this->meta['scheme'], $this->meta['version']) = explode('/', $this->meta['protocol']);
    }
}
