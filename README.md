students-database
=================

<a href="https://travis-ci.org/ebessarabov/students-database"><img src="https://travis-ci.org/ebessarabov/students-database.svg?branch=master"></a>

A Symfony project created on May 15, 2016, 1:59 pm.

Run project:

    composer install

    php bin/console doctrine:database:create

    php bin/console doctrine:schema:create

    php bin/console h:d:f:l

    php bin/console students:generate:paths

    php bin/console assets:install

    php bin/console server:run

PhpUnit:

    ./vendor/bin/phpunit

Analysis Tools:

    PHP_CodeSniffer: ./vendor/bin/phpcs --standard=psr2 src

    PHP Mess Detector: ./vendor/bin/phpmd src html cleancode,codesize,controversial,design,naming,unusedcode --reportfile md-report.html

    PHP Copy/Paste Detector: ./vendor/bin/phpcpd src