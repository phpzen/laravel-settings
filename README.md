# Laravel Settings
Persistent settings for Laravel 5

## Installation
Require this package with composer ([Packagist](https://packagist.org/packages/phpzen/laravel-settings)) using the following command

    composer require phpzen/laravel-settings

or modify your `composer.json`

    "require": {
        "phpzen/laravel-settings": "0.2"
    }

then run `composer update`.

After installation register the ServiceProvider to the `providers` array in `config/app.php`

    'PHPZen\LaravelSettings\SettingsServiceProvider',

Add an alias for the facade to `aliases` array in  your `config/app.php`

    'Settings'  => PHPZen\LaravelSettings\Facades\Settings::class,

Publish the config and migration files

    $ php artisan vendor:publish --provider="PHPZen\LaravelSettings\SettingsServiceProvider" --force

`config/settings.php` provides default settings for you. If you need to change `table_name` or `cache_file` add `SETTINGS_TABLE_NAME` and `SETTINGS_CACHE_FILE` to your .env file.
If you change `table_name` don't forget to change the table name in the migration file as well.

Create the `settings` table

    $ php artisan migrate

## Usage


### License

The Laravel 5 Persistent Settings is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)