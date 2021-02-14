<?php

namespace App\Services\Cache;

use Illuminate\Support\Facades\Cache;

class Cache {
    
    const TTL = 300;
    
    public static function set($key, $value, $ttl = self::TTL){
        $lock = Cache::lock('block');
        try{
            $lock->block(5);
            Cache::put($key, $value, $ttl);
            return true;
        }catch(Illuminate\Contracts\Cache\LockTimeoutException $e){
            return false;
        }finally{
            optional($lock)->release();
        }
        
    }
    
    public static function get($key){
        if(Cache::has($key)){
            return Cache::get($key);
        }
        return false;
    }
    
    public static function delete($key){
        if(Cache::has($key)){
            return Cache::flush($key);
        }
    }
    
}
