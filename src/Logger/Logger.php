<?php 
namespace App\Logger;


class Logger 
{

    public static function log ($action = '', $message = '', $data = null)
    
    {
        $data = json_encode($data);
        $time = date("d/m/Y H:i:s");
        $fileToLog = fopen("src/Logger/test.log", "a");
        fwrite($fileToLog, "\n");
        fwrite($fileToLog, "LOG\r\n");
        fwrite($fileToLog, "TIME: {$time}\r\n");
        fwrite($fileToLog, "ACTION: {$action} \r\n");
        fwrite($fileToLog, "MESSAGE: {$message}\r\n");
        fwrite($fileToLog, "DATA: {$data}\r\n");
        fwrite($fileToLog, "=================================");
        fclose($fileToLog);
    }
    public static function warning ($message = '', $error = '')
    
    {
        $time = date("d/m/Y H:i:s");
        $fileToLog = fopen("src/Logger/test.log", "a");
        fwrite($fileToLog, "\n");
        fwrite($fileToLog, "WARNING\r\n");
        fwrite($fileToLog, "TIME: {$time}\r\n");
        fwrite($fileToLog, "MESSAGE: {$message}\r\n");
        fwrite($fileToLog, "DATA: {$error}\r\n");
        fwrite($fileToLog, "=================================");
        fclose($fileToLog);
    }
}

// logger($action, $message, $array_data);

