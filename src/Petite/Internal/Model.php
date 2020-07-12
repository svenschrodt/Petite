<?php declare(strict_types = 1);
/**
 * \Petite\Internal\Model
 *
 * Abstract class for data structures oof an entity - managing 'Model' part of MVC here
 *
 *
 * @package Petite
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2020-06-21
 * @link https://github.com/svenschrodt/Petite
 * @link https://travis-ci.org/github/svenschrodt/Petite
 * @license https://github.com/svenschrodt/Petite/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace Petite\Internal;

use Petite\Internal\Errors;

class Model
{

    /**
     * Property holding date time of creation
     *
     * @var \DateTime
     */
    protected $created;

    /**
     * Property holding date time of last modification
     *
     * @var \DateTime
     */
    protected $modified;

    /**
     * Array of valid property names for entity or empty array allowing all names
     * 
     * @var array
     */
    protected $allowedProp = [];

    /**
     * Constructor function
     * 
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->created = $data['created'] ?? new \DateTime();
    }

    /**
     * Updating current date time for property modified
     *
     * @return \Petite\Internal\Model
     */
    protected function touch(): \Petite\Internal\Model
    {
        $this->modified = new \DateTime();
        return $this;
    }

    /**
     * Checking if given name is a valid property of model instance
     *
     * @param string $name
     * @return boolean
     */
    public function isValidProperty(string $name): bool
    {
        if (count($this->allowedProp) === 0) {
            return true;
        } elseif(in_array($name, $this->allowedProp)) {
            return true;
        } else {
            throw new \InvalidArgumentException(sprintf(Errors::INVALID_PROPERTY_NAME, $name, __CLASS__));
        }
    }
}
