# Petite

## Overview


## Design goals

 - As fast as possible
 - Easy to learn | understand
 - ...tbc.
 
 

Very tiny class collection for building small MVC apps with PHP 7.2*

 - Currently Petite only supports http routing for Apache with .htaccess
 
 
 ### \Petite\Internal

In most cases you do nt have to use this classes, but those in root folder only, for building web app(lication)s 
 
## TODO
  - Supporting several routing mechanism for other http servers via DI to App 
  
## Apendix

### Files 
<code>

├── Bootstrap.php
├── index.php
├── LICENSE
├── phpunit.withLog.xml
├── phpunit.xml
├── README.md
├── src
│   └── Petite
│       ├── App.php
│       ├── Document.php
│       ├── Errors.php
│       ├── Front.php
│       ├── HtmlFactory.php
│       ├── Internal
│       │   ├── ApacheRouter.php
│       │   ├── Html5Spec.php
│       │   ├── HtmlElement.php
│       │   ├── MockDoc.php
│       │   ├── Request.php
│       │   ├── Response.php
│       │   ├── RouterInterface.php
│       │   └── StringHelper.php
│       └── Tpl
│           ├── document.php
│           └── foo.php
├── temp.txt
├── test
│   └── Petite
│       ├── AppTest.php
│       ├── BasicTest.php
│       ├── Internal
│       │   ├── HtmlElementTest.php
│       │   ├── RequestTest.php
│       │   └── ResponseTest.php
│       └── readme.md
└── 
</code> 
