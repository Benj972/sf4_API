BileMo API REST
===============

This repository is the project 7 "BileMo" in course Php Symfony Web Developer with [OpenClassrooms](https://openclassrooms.com).

Version 1.0.0
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/daa9272cd8c74a2c887f2f2344c7add8)](https://www.codacy.com/app/Benj972/sf4_API?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Benj972/sf4_API&amp;utm_campaign=Badge_Grade)

This project is a REST API for Bilemo to allow clients to display their mobile phones catalog. This API was built with Symfony 4
https://github.com/Benj972/sf4_API.
You have access to the API documentation with the uri `api/doc` when you are on the local web server and and also on the repository [here](https://github.com/Benj972/sf4_API/blob/refactoring/docs/swagger.md).

Context:
--------
BileMo is a company offering a selection of high-end mobile phones.

You are in charge of the development of the showcase of BileMo mobile phones. The business model of BileMo is not to sell directly on the website, but to provide all platforms that wish to access the catalog via an API (Application Programming Interface). It is therefore sales exclusively B2B (business to business).

Prerequisites:
--------------
* PHP v7.0
* MySQL
* Composer

Dependencies:
-------------
This project uses:
* [FOSRestBundle](https://github.com/FriendsOfSymfony/FOSRestBundle)
* [JMSSerializerBundle](https://github.com/schmittjoh/JMSSerializerBundle)
* [NelmioApiDocBundle](https://github.com/nelmio/NelmioApiDocBundle)
* [BazingaHateoasBundle](https://github.com/willdurand/BazingaHateoasBundle)
* [LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle)

Those dependencies are included in composer.json.

Installation:
-------------
1. To be placed in the folder
2. Recover Repository: `git clone https://github.com/Benj972/sf4_API.git`
3. Install Composer: `php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`and`composer-setup.php`
4. Update Library : `php composer.phar update`
5. Configuring the [Database](https://symfony.com/doc/current/doctrine.html)
6. Create database: `php bin/console doctrine:database:create`
7. Update database: `php bin/console doctrine:schema:update --force`
8. Load database: `php bin/console doctrine:fixtures:load`
9. Generate [SSH keys](https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#installation) for use LexikJWTAuthenticationBundle.

This API is ready!

Authentication:
---------------
This API is restricted to Bilemo client.

To test API, you can create a client with the command `php bin/console demo:load client`

Set `Content-Type: application/json` in your request header and do POST request on `api/login_check` with those JSON parameters in request body:

    {
    	"_username": "admin@example.com",
    	"_password": "admin"
    }

You will get a token. You can now access API by setting these parameters in each request header of type `Authorization :Bearer token`.

Documentation:
--------------
* This API project is documented you find it with request `api/doc` or [here](https://github.com/Benj972/sf4_API/blob/refactoring/docs/swagger.md).
* You can also look at the [Diagrams](https://github.com/Benj972/sf4_API/tree/refactoring/diagram).