<?php

namespace App\Services\Errors;

use Illuminate\Foundation\Http\Exceptions;
use Illuminate\Support\Facades\Log;

class ErrorsService extends Exceptions {
    public function writeLog($error_text = '', $channel = 'slack', $error_type = 'info'){
        $log = Log::channel($channel)->$error_type($error_text);
        if(!$log){
            Log::channel('single')->$error_type($error_text);   
        }
    }
}
