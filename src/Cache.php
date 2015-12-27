<?php
namespace PHPZen\LaravelSettings;

/**
 * Class Cache
 * @package PHPZen\LaravelSettings
 */
class Cache
{
    protected $cacheFile;
    protected $settings;

    public function __construct($cacheFile)
    {
        $this->cacheFile = $cacheFile;
        if(!file_exists($this->cacheFile))
            $this->clear();
        $this->settings = $this->getAll();
    }

    public function hasKey($key)
    {
        return array_key_exists($key, $this->settings);
    }
    
    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->settings) ? $this->settings[$key] : $default;
    }

    public function getAll()
    {
        $values = json_decode(file_get_contents($this->cacheFile), true);
        foreach ($values as $key => $value) {
            $values[$key] = unserialize($value);
        }
        return $values;
    }

    public function set($key, $value)
    {
        $this->settings[$key] = $value;
        $this->store();
        return $value;
    }

    private function store()
    {
        $settings = [];
        foreach ($this->settings as $key => $value) {
            $settings[$key] = serialize($value);
        }
        file_put_contents($this->cacheFile, json_encode($settings));
    }

    public function delete($key)
    {
        if(array_key_exists($key, $this->settings))
            unset($this->settings[$key]);
        $this->store();
    }

    public function clear()
    {
        file_put_contents($this->cacheFile, json_encode([]));
    }
}