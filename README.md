# CodeIgniter-JWT-Sample using CodeIgniter 4

Simple CodeIgniter 4 JWT implementation.

Developers who want to use CodeIgniter 3:
=====

Use following command to switch to CodeIgniter 3 branch

    git checkout CI3

Setup using this repo
=====

- Clone this project on php server XAMPP/WAMP. 

- This project uses [Composer] (https://getcomposer.org/) as Dependency Manager

- Use following command to auto install required dependencies


    composer install

- In `/app/Config/Services.php` change `secret key` at `line 23`

- Run or Test code using **Postman** or any other Rest Client

Setup for existing CodeIgniter 4 project
=====

- Use composer to manage your dependencies and download PHP-JWT:
  
 ```bash
  composer require firebase/php-jwt
  ```

- [Filter] (https://codeigniter.com/user_guide/incoming/filters.html)

Copy `app/Filters/AuthFilter.php` to your project

In `/app/Config/Filters.php` add following line at the end of `$aliases` array

```
'authFilter' => \App\Filters\AuthFilter::class,
```
Add following in `$filters` array

```
'authFilter' => [
    'before' => [
        'api/user/*',
        'api/user',
    ],
],
```

- In `/app/Config/Routes.php` add routes to your Auth controller and resource

```
$routes->resource('api/auth', ['controller' => 'Auth']);
$routes->resource('api/user', ['controller' => 'User']);
```
    
- In `/app/Config/Services.php` add function to return secret key
```
public static function getSecretKey()
{
    return 'example_key';
}
```
- Add logic to generate token in your `AuthController` after validating login credentials
```
$key = Services::getSecretKey();
$payload = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

$jwt = JWT::encode($payload, $key);
```
- Run or Test code using **Postman** or any other Rest Client


Run
=====

Generate auth token using login credentials

    URL: http://localhost/CodeIgniter-JWT-Sample/public/index.php/api/auth
    Method: POST
    Params type: x-www-form-urlencoded
    Params: email:same_text
            password:same_text

Access resource - User for this example

    URL: http://localhost/CodeIgniter-JWT-Sample/public/index.php/api/user
    Method: GET
    Header Key: Authorization
    Value: Bearer <Token value from above call>
    
Project uses
===== 
[CodeIgniter 4] (https://www.codeigniter.com/)  
[php-jwt] (https://github.com/firebase/php-jwt)  

Contact
=====
For any questions mail me paritoshvaidya@gmail.com
  
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://github.com/ParitoshVaidya/CodeIgniter-JWT-Sample/blob/master/license.txt)


<!--
Original ReadMe

# CodeIgniter 4 Development

[![Build Status](https://travis-ci.org/codeigniter4/CodeIgniter4.svg?branch=develop)](https://travis-ci.org/codeigniter4/CodeIgniter4)
[![Coverage Status](https://coveralls.io/repos/github/codeigniter4/CodeIgniter4/badge.svg?branch=develop)](https://coveralls.io/github/codeigniter4/CodeIgniter4?branch=develop)
[![Downloads](https://poser.pugx.org/codeigniter4/framework/downloads)](https://packagist.org/packages/codeigniter4/framework)
[![GitHub release (latest by date)](https://img.shields.io/github/v/release/codeigniter4/CodeIgniter4)](https://packagist.org/packages/codeigniter4/framework)
[![GitHub stars](https://img.shields.io/github/stars/codeigniter4/CodeIgniter4)](https://packagist.org/packages/codeigniter4/framework)
[![GitHub license](https://img.shields.io/github/license/codeigniter4/CodeIgniter4)](https://github.com/codeigniter4/CodeIgniter4/blob/develop/license.txt)
[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/codeigniter4/CodeIgniter4/pulls)
<br>

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible, and secure.
More information can be found at the [official site](http://codeigniter.com).

This repository holds the source code for CodeIgniter 4 only.
Version 4 is a complete rewrite to bring the quality and the code into a more modern version,
while still keeping as many of the things intact that has made people love the framework over the years.

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

### Documentation

The [User Guide](https://codeigniter4.github.io/userguide/) is the primary documentation for CodeIgniter 4.

The current **in-progress** User Guide can be found [here](https://codeigniter4.github.io/CodeIgniter4/).
As with the rest of the framework, it is a work in progress, and will see changes over time to structure, explanations, etc.

You might also be interested in the [API documentation](https://codeigniter4.github.io/api/) for the framework components.

## Important Change with index.php

index.php is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!
The user guide updating and deployment is a bit awkward at the moment, but we are working on it!

## Repository Management

CodeIgniter is developed completely on a volunteer basis. As such, please give up to 7 days
for your issues to be reviewed. If you haven't heard from one of the team in that time period,
feel free to leave a comment on the issue so that it gets brought back to our attention.

We use Github issues to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

If you raise an issue here that pertains to support or a feature request, it will
be closed! If you are not sure if you have found a bug, raise a thread on the forum first -
someone else may have encountered the same thing.

Before raising a new Github issue, please check that your bug hasn't already
been reported or fixed.

We use pull requests (PRs) for CONTRIBUTIONS to the repository.
We are looking for contributions that address one of the reported bugs or
approved work packages.

Do not use a PR as a form of feature request.
Unsolicited contributions will only be considered if they fit nicely
into the framework roadmap.
Remember that some components that were part of CodeIgniter 3 are being moved
to optional packages, with their own repository.

## Contributing

We **are** accepting contributions from the community!

We will try to manage the process somewhat, by adding a ["help wanted" label](https://github.com/codeigniter4/CodeIgniter4/labels/help%20wanted) to those that we are
specifically interested in at any point in time. Join the discussion for those issues and let us know
if you want to take the lead on one of them.

At this time, we are not looking for out-of-scope contributions, only those that would be considered part of our controlled evolution!

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) section in the user guide.

## Server Requirements

PHP version 7.2 or higher is required, with the following extensions installed:


- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- xml (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)

## Running CodeIgniter Tests

Information on running the CodeIgniter test suite can be found in the [README.md](tests/README.md) file in the tests directory.

-->
