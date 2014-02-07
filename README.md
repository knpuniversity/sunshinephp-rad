Symfony2 RAD Project for SunshinePHP
====================================

Hi there! This is a simple example project for
a Symfony2 RAD presentation at SunshinePHP 2014!

The `master` branch is the starting point of the project,
while the `finish` branch is the finished product.

To get this running:

1) Install via Composer:

```
php composer.phar install
```

2) Configure your database settings in parameters.yml

3) Install the database and fixtures

```
php app/console doctrine:database:create
php app/console doctrine:schema:create
php app/console doctrine:fixtures:load
```

4) Permissions

If you get any permissions errors, make sure app/cache and app/logs
exist and are writable (777 them to be sure).

5) Load up the site!

If you have PHP 5.4, simply run:

```
php app/console server:run
```

Then open up the site at http://localhost:8000
