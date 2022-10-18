<?php
namespace Modules\Core\Supports;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config as FacadesConfig;
use InvalidArgumentException;
use Modules\Core\Entities\AdminSetting;

class Config
{
    public static function load($refresh = false)
    {
        if(!Helper::isConnectedDatabase()) {
            return false;
        };

        if($refresh) {
            Cache::forget('admin_settings');
        }

        if(!Cache::has('admin_settings')) {
            $settings = Cache::rememberForever('admin_settings', function() {
                return AdminSetting::get();
            });
        } else {
            $settings = Cache::get('admin_settings');
        }

        foreach($settings as $setting) {
            if(is_numeric($setting->value)) {
                if((int)$setting->value === 0 || (int)$setting->value === 1) {
                    FacadesConfig::set(str_replace('_', '.', $setting->key), $setting->value == 1 ? true : false);
                } else {
                    FacadesConfig::set(str_replace('_', '.', $setting->key), $setting->value);
                }
            } else {
                FacadesConfig::set(str_replace('_', '.', $setting->key), $setting->value);
            }
        }
    }

    public static function set(...$args)
    {
        if(isset($args[0]) && is_array($args[0])) {
            foreach($args[0] as $key => $value) {
                AdminSetting::updateOrCreate([
                    'key' => $key
                ], [
                    'value' => is_array($value) ? json_encode($value) : $value
                ]);                
            }
        } else if(isset($args[0]) && isset($args[1])) {
            AdminSetting::updateOrCreate([
                'key' => $args[0]
            ], [
                'value' => is_array($args[1]) ? json_encode($args[1]) : $args[1]
            ]);
        } else {
            throw new InvalidArgumentException("Invalid config arguments.");
        }

        self::load(true);
    }
}