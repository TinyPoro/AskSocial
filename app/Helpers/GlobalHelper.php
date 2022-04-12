<?php

if (!function_exists('getExceptionLogMessage')) {
    function getExceptionLogMessage(\Throwable $e, $level) {
        return \Carbon\Carbon::now() . " | " . $level . " | " . getAppVersion() . " | " . $e->getFile() . " | " . $e->getLine() . " | " . $e->getMessage();
    }
}

if (!function_exists('getInfoLogMessage')) {
    function getInfoLogMessage($file, $line, $message) {
        return \Carbon\Carbon::now() . " | INFO | " . getAppVersion() . " | " . $file . " | " . $line . " | " . $message;
    }
}

if (!function_exists('getallheaders')) {
    function getallheaders()
    {
           $headers = [];
       foreach ($_SERVER as $name => $value)
       {
           if (substr($name, 0, 5) == 'HTTP_')
           {
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
           }
       }
       return $headers;
    }
}

if (!function_exists('getAppVersion')) {
    function getAppVersion()
    {
        $headers = getallheaders();
        if(isset($headers['app-version'])) {
            return $headers['app-version'];
        }
        else {
            return 'undefined';
        }
    }
}
