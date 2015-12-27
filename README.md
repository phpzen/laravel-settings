# Laravel Settings
Persistent settings for Laravel 5.
Settings are stored in database and cached in file.

## Installation
Require this package with composer ([Packagist](https://packagist.org/packages/phpzen/laravel-settings)) using the following command

    composer require phpzen/laravel-settings

or modify your `composer.json`

    "require": {
        "phpzen/laravel-settings": "0.2"
    }

then run `composer update`.

After installation register the ServiceProvider to the `providers` array in `config/app.php`

    PHPZen\LaravelSettings\SettingsServiceProvider::class,

Add an alias for the facade to `aliases` array in  your `config/app.php`

    'Settings'  => PHPZen\LaravelSettings\Facades\Settings::class,

Publish the config and migration files

    $ php artisan vendor:publish --provider="PHPZen\LaravelSettings\SettingsServiceProvider" --force

`config/settings.php` provides default package settings. If you need to change `table_name` or `cache_file` add `SETTINGS_TABLE_NAME` and `SETTINGS_CACHE_FILE` to your .env file.
    
    SETTINGS_TABLE_NAME=your_settings_table_name
    SETTINGS_CACHE_FILE=path_to_settings_cache_file
    
If you change `table_name` don't forget to change the table name in the migration file as well.

Create the `settings` table

    $ php artisan migrate

## Usage

### Via Facade

    $value = Settings::get('key'); // get value of setting
    $value = Settings::get('key', 'default'); // get value of setting or default if key does not exists
    
    Settings::set('key', 'value'); // create or update setting
    
    Settings::delete('key'); // remove setting
    
    Settings::clear(); // clear all settings
    
### Via helper
    
    $value = settings('key'); // get value of setting
    $value = settings('key', 'default'); // get value of setting or default if key does not exists

### License

The Laravel Settings is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)