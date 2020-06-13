<?php declare(strict_types = 1);
/**
 * Class representing specification of HTML 5 Living Standard
 *
 * @see https://html.spec.whatwg.org/
 *
 *
 * @package Petite
 * @author Sven Schrodt<sven@schrodt-service.net>
 * @version 0.1
 * @since 2019-11-27
 * @link https://github.com/svenschrodt/Petite
 * @link https://travis-ci.org/github/svenschrodt/Petite
 * @license https://github.com/svenschrodt/Petite/blob/master/LICENSE.md
 * @copyright Sven Schrodt<sven@schrodt-service.net>
 */
namespace Petite\Internal;

class Html5Spec
{

    /**
     * List of valid html elements
     *
     * @todo redefine structure for attributes
     * @var array
     */
    protected $elements = [
        'html',
        'head',
        'title',
        'base',
        'link',
        'meta',
        'style',
        'body',
        'article',
        'section',
        'nav',
        'aside',
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
        'hgroup',
        'header',
        'footer',
        'address',
        'p',
        'hr',
        'pre',
        'blockquote',
        'ol',
        'ul',
        'menu',
        'li',
        'dl',
        'dt',
        'dd',
        'figure',
        'figcaption',
        'main',
        'div',
        'em',
        'strong',
        'small',
        's',
        'cite',
        'q',
        'dfn',
        'abbr',
        'ruby',
        'rt',
        'rp',
        'data',
        'time',
        'code',
        'var',
        'samp',
        'kbd',
        'sub',
        's',
        'i',
        'b',
        'u',
        'mark',
        'bdi',
        'bdo',
        'span',
        'br',
        'wbr'
    ];

    /**
     * List of global attribtes
     *
     * @var array
     */
    protected $_globalAttributes = [
        'accesskey',
        'autocapitalize',
        'autofocus',
        'contenteditable',
        'dir',
        'draggable',
        'enterkeyhint',
        'hidden',
        'inputmode',
        'is',
        'itemid',
        'itemprop',
        'itemref',
        'itemscope',
        'itemtype',
        'lang',
        'nonce',
        'spellcheck',
        'style',
        'tabindex',
        'title',
        'translate'
    ];
    
    /**
     * Checking, if given name is a valid HTML 5 element name
     * 
     * @param string $name
     * @return boolean
     */
    public static function isElement(string $name)
    {
        return in_array($name, $this->elements);
    }
}
