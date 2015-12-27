<?php
use PHPZen\LaravelSettings\Facades\Settings;

if(!function_exists('settings')) {
    function settings($key, $default = null) {
        return Settings::get($key, $default);
    }
}