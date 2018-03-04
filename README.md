# Unoficial Laravel integration for RDStation

[![Build Status](https://secure.travis-ci.org/umobi/rdstation-laravel.png?branch=master)](http://travis-ci.org/umobi/rdstation-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/umobi/rdstation-laravel.svg?style=flat-square)](https://packagist.org/packages/umobi/rdstation-laravel)
[![Downloads per month](https://img.shields.io/packagist/dm/umobi/rdstation-laravel.svg?style=flat-square)](https://packagist.org/packages/umobi/rdstation-laravel)
[![Latest stable version](https://img.shields.io/packagist/v/umobi/rdstation-laravel.svg?style=flat-square)](https://packagist.org/packages/umobi/rdstation-laravel)
[![License](http://img.shields.io/packagist/l/umobi/rdstation-laravel.svg?style=flat-square)](https://packagist.org/packages/umobi/rdstation-laravel)

Unoficial Laravel integration for [RDStation](https://rdstation.com.br/).

## Installation

### Laravel 5.x

Install the ``umobi/rdstation-laravel`` package:

```bash
$ composer require umobi/rdstation-laravel
```

### Setting up your RDStation service
Log in to your [RDStation dashboard](https://www.rdstation.com.br/integracoes/tokens/) and grab your Token and Private Token. Add them to `config/services.php`.  

```php
// config/services.php
...
'rdstation' => [
    'token' => env('RDSTATION_TOKEN'),
    'private_token' => env('RDSTATION_PRIVATE_TOKEN'),
],
```

Add your RDStation Tokens to ``.env`` file:

```
RDSTATION_TOKEN=f1c940384a971f2982c61a5e5f11e6b9
RDSTATION_PRIVATE_TOKEN=82ue82918du234j3j43ld9j2jpao91282
```

### Usage

```php
 app('rdstation')->register($source, [
    'name' => $name,
    'email' => $email,
    'mobile_phone' => $lead->phone_number,
    ... // RDStation Lead fields
]);
```