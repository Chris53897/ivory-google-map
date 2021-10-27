# Installation

To install the Ivory Google Map library, you will need [Composer](https://getcomposer.org).

## Set up Composer

Composer comes with a simple phar file. To easily access it from anywhere on your system, you can execute:

``` bash
$ curl -s https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```

## Download the library

Require the library in your `composer.json` file:

``` bash
$ composer require ivory/google-map
```

## Download additional libraries

### Httplug

If you want to use a service (geocoder, direction, ...), you will need a http client and message factory which implements [PSR-7](https://www.php-fig.org/psr/psr-7/) like [php-http/guzzle7-adapter](https://packagist.org/packages/php-http/guzzle7-adapter):

``` bash
$ composer require php-http/guzzle7-adapter
```

### Ivory Serializer

If you want to use a service (geocoder, direction, ...), you will need the 
[Ivory Serializer](https://packagist.org/packages/ivory/serializer) in order to deserialize the http response:

``` bash
$ composer require ivory/serializer
```

## Autoload

So easy, you just have to require the generated autoload file and you are already ready to play:

``` php
<?php

require __DIR__.'/vendor/autoload.php';

use Ivory\GoogleMap;

// ...
```

The Ivory Google Map library follows the [PSR-4 Standard](https://www.php-fig.org/psr/psr-4/). 
If you prefer install it manually, it can be autoload by any convenient autoloader.
