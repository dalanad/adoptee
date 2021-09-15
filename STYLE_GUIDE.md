# Project Style Guide - DRAFT

All rules and guidelines in this document apply to PHP files unless otherwise noted. References to PHP/HTML files can be interpreted as files that primarily contain HTML, but use PHP for templating purposes.

> The keywords "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD", "SHOULD NOT", "RECOMMENDED", "MAY", and "OPTIONAL" in this document are to be interpreted as described in [RFC 2119](http://www.ietf.org/rfc/rfc2119.txt).

## 1. Files

This section describes the format and naming convention of PHP only files.

#### Filename - PHP

1. **Name** MUST be CamelCase
   - e.g. `AdoptionRequest.php`
2. **Name** MUST be class name + type of class
   - e.g. `AdoptionsController.php`

#### Filename - Views (HTML)

1. **Letters** MUST be all lowercase
   - e.g. `home.php`
2. **Words** MUST be separated with a hyphen
   - e.g. `sign_up_organization.php`

## 2. PHP Tags

This section describes the use of PHP tags in PHP and PHP/HTML files.

1. **Open tag** MUST be on its own line and MUST be followed by a blank line
   - i.e. `<?php` `↵` `↵` `...`
2. **Close tag** MUST NOT be used in PHP files
   - i.e. no `?>`
3. **Open/close tag** MUST be on one line in PHP/HTML files
   - i.e. `<?php ... ?>`
4. **Short open tag** MUST NOT be used
   - i.e. `<?` &rarr; `<?php`
5. **Short echo tag** SHOULD be used in PHP/HTML files
   - i.e. `<?php echo` &rarr; `<?=`

## 3. Includes

This section describes the format for including and requiring files.

1. **Include/require once** SHOULD be used
   - i.e. `include` &rarr; `include_once`, `require` &rarr; `require_once`
2. **Parenthesis** MUST NOT be used
   - e.g. `include_once('file.php');` &rarr; `include_once 'file.php';`
3. **Purpose of include** MUST be documented with a comment
   - e.g. `// Provides helper functions` `↵` `require_once 'wp-load.php';`

## 4. Models

1. **Class** MUST be in the Class Diagram
2. **Scope** MUST be the Entity (not controller functionality)

#### SQL queries

1. **Keywords** MUST be all uppercase
2. **Prepared Statements** MUST be used 

#### Methods

1. **Static Methods** MAY be used
2. **Method Name** SHOULD be meaningful and relevant.

##### Inserts

1. **Columns** MUST be defined in the query
2. MUST return **lastInsertId** when available
3. SHOULD not insert to auto_increment columns.

##### Selects

1. **Single Selects** MUST return just one the object when selecting a single item (not a array of one object)
2. **Empty Parameters** SHOULD be taken into consideration

## 5. Views

1. **Repeated Logic** MAY be refactored into functions
2. **Database Access** MUST NOT be done. only the data passed by the controller SHOULD be used.

## 6. Controllers

1. **Parameters** MUST be validated for existence & validity
2. **Reasonable Defaults** MAY be used for empty parameters.

## 7. Formatting

1. **Formatter** MUST be "bmewburn.vscode-intelephense-client" vs code extension.
2. **ALL FILES** MUST be formatted before committing

Inspired in part by style guides from:<br />
[CodeIgniter](http://ellislab.com/codeigniter/user-guide/general/styleguide.html), [Drupal](https://drupal.org/coding-standards), [Horde](http://www.horde.org/apps/horde/docs/CODING_STANDARDS), [Pear](http://pear.php.net/manual/en/standards.php), [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md), [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md), [Symfony](http://symfony.com/doc/current/contributing/code/standards.html), and [WordPress](http://make.wordpress.org/core/handbook/coding-standards/php/).