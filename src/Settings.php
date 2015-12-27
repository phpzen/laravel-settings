<?php
namespace PHPZen\LaravelSettings;


use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Config;

class Settings
{
    protected $config;
    protected $db;
    protected $cache;

    public function __construct(DatabaseManager $db, Cache $cache, $config = [])
    {
        $this->db = $db;
        $this->cache = $cache;
        $this->config = $config;
    }

    public function hasKey($key)
    {
        if($this->cache->hasKey($key))
            return true;
        return $this->db->table($this->config['table_name'])->where('setting_key', $key)->count() > 0;
    }

    public function get($key, $default = null)
    {
        if($this->cache->hasKey($key))
            return $this->cache->get($key);

        $row = $this->db->table($this->config['table_name'])->where('setting_key', $key)->first(['setting_value']);
        $value = unserialize($row->setting_value);
        if(!is_null($value)) {
            $this->cache->set($key, $value);
            return $value;
        } else if(null != Config::get($key, null)) {
            return Config::get($key);
        } else
            return $default;

    }

    public function set($key, $value)
    {
        $row = $this->db->table($this->config['table_name'])->where('setting_key', $key)->first();
        if(!is_null($row)) {
            $row->setting_value = serialize($value);
            $row->save();
        } else {
            $this->db->table($this->config['table_name'])->insert([
                'setting_key' => $key,
                'setting_value' => serialize($value)
            ]);
        }
        $this->cache->set($key, $value);
        return $value;
    }

    public function delete($key)
    {
        $this->db->table($this->config['table_name'])->where('setting_key', $key)->delete();
        $this->cache->delete($key);
    }

    public function clear()
    {
        $this->cache->clear();
        $this->db->table($this->config['table_name'])->delete();
    }

    public function getAll()
    {
        return $this->cache->getAll();
    }
}