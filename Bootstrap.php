<?php declare(strict_types = 1);
/**
 * Bootstrapping for namespace /Petite/
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


// Enabling full error reporting for dev environment
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
                    
define('PETITE_NS', '\\Petite');
define('PETITE_LIB_DIR', 'Petite');

/**
 * Auto loading for project classes 
 */
spl_autoload_register(function ($className) {
    
    // Check if namespace of class to be instantiated is belonging to us (Petite)
    
    if (substr($className, 0, strlen(PETITE_LIB_DIR)) === PETITE_LIB_DIR) {
        $file = 'src/' . str_replace('\\', '/', $className) . '.php';
        // Check if destination class file exists
        if (file_exists($file)) {
            // including class file once
            require_once $file;
        } else { // throw exception, if not
            throw new \Exception("NO SUCH FILE OR DIRECTORY: {$file} \n class: {$className}");
        }
    }
    
});



