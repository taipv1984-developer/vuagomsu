<?php
include(LIBRARY_PATH.'log4php/Logger.php');

class MyLoggerPatternConverterFile extends \LoggerPatternConverterFile
{

    public function convert(\LoggerLoggingEvent $event)
    {
        return basename(parent::convert($event));
    }
}

class MyLoggerLayoutPattern extends \LoggerLayoutPattern
{

    public function __construct()
    {
        parent::__construct();
        $this->converterMap['f'] = 'MyLoggerPatternConverterFile';
    }
}

\Logger::configure(PROTECTED_PATH  . '/config/log4php.xml');

class LogUtil
{
    public static function logElapedTime($message, $elapsedTime)
    {
        $backtrace = debug_backtrace();
        $fileinfo = '';
        try {
            if (!empty($backtrace[0]) && is_array($backtrace[0])) {
                $fileName = $backtrace[0]['file'];
                $fileName = empty($fileName) ? "" : $fileName;
                $fileName = basename($fileName);
                $fileinfo = $fileName . ":" . $backtrace[0]['line'];
            }
            $myMessage = $message;
            if (is_object($message) || is_array($message)) {
                $myMessage = json_encode($message);
            }
        } catch (Exception $e) {
        }
        \Logger::getLogger("ELAPSED TIME")->trace("[" . $fileinfo . "] " . $myMessage . " | Processed time(ms): " . $elapsedTime);
    }

    public static function sql($message)
    {
        $backtrace = debug_backtrace();
        $fileinfo = '';
        try {
            if (!empty($backtrace[0]) && is_array($backtrace[0])) {
                $fileName = $backtrace[0]['file'];
                $fileName = empty($fileName) ? "" : $fileName;
                $fileName = basename($fileName);
                $fileinfo = $fileName . ":" . $backtrace[0]['line'];
            }
            $myMessage = $message;
            if (is_object($message) || is_array($message)) {
                $myMessage = json_encode($message);
            }
        } catch (Exception $e) {
        }
        \Logger::getLogger("SQL")->trace("[" . $fileinfo . "] " . $myMessage);
    }

    public static function trace($message, $exception = null, $logger = null)
    {
        $backtrace = debug_backtrace();
        $fileinfo = '';
        try {
            if (!empty($backtrace[0]) && is_array($backtrace[0])) {
                $fileName = $backtrace[0]['file'];
                $fileName = empty($fileName) ? "" : $fileName;
                $fileName = basename($fileName);
                $fileinfo = $fileName . ":" . $backtrace[0]['line'];
            }
            $myMessage = $message;
            if (is_object($message) || is_array($message)) {
                $myMessage = json_encode($message);
            }
        } catch (Exception $e) {
        }
        \Logger::getLogger($logger)->trace("[" . $fileinfo . "] " . $myMessage, $exception);
    }

    public static function info($message, $exception = null, $logger = null)
    {
        $backtrace = debug_backtrace();
        $fileinfo = '';
        try {
            if (!empty($backtrace[0]) && is_array($backtrace[0])) {
                $fileName = $backtrace[0]['file'];
                $fileName = empty($fileName) ? "" : $fileName;
                $fileName = basename($fileName);
                $fileinfo = $fileName . ":" . $backtrace[0]['line'];
            }
            $myMessage = $message;
            if (is_object($message) || is_array($message)) {
                $myMessage = json_encode($message);
            }
        } catch (Exception $e) {
        }
        \Logger::getLogger($logger)->info("[" . $fileinfo . "] " . $myMessage, $exception);
    }

    public static function debug($message, $exception = null, $logger = null)
    {
        $backtrace = debug_backtrace();
        $fileinfo = '';
        try {
            if (!empty($backtrace[0]) && is_array($backtrace[0])) {
                $fileName = $backtrace[0]['file'];
                $fileName = empty($fileName) ? "" : $fileName;
                $fileName = basename($fileName);
                $fileinfo = $fileName . ":" . $backtrace[0]['line'];
            }
            $myMessage = $message;
            if (is_object($message) || is_array($message)) {
                $myMessage = json_encode($message);
            }
        } catch (Exception $e) {
        }
        \Logger::getLogger($logger)->debug("[" . $fileinfo . "] " . $myMessage, $exception);
    }

    public static function error($message, $exception = null, $logger = null)
    {
        $backtrace = debug_backtrace();
        $fileinfo = '';
        try {
            if (!empty($backtrace[0]) && is_array($backtrace[0])) {
                $fileName = $backtrace[0]['file'];
                $fileName = empty($fileName) ? "" : $fileName;
                $fileName = basename($fileName);
                $fileinfo = $fileName . ":" . $backtrace[0]['line'];
            }
            $myMessage = $message;
            if (is_object($message) || is_array($message)) {
                $myMessage = json_encode($message);
            }
        } catch (Exception $e) {
        }
        \Logger::getLogger($logger)->error("[" . $fileinfo . "] " . $myMessage, $exception);
    }

    public static function warn($message, $exception = null, $logger = null)
    {
        $backtrace = debug_backtrace();
        $fileinfo = '';
        try {
            if (!empty($backtrace[0]) && is_array($backtrace[0])) {
                $fileName = $backtrace[0]['file'];
                $fileName = empty($fileName) ? "" : $fileName;
                $fileName = basename($fileName);
                $fileinfo = $fileName . ":" . $backtrace[0]['line'];
            }
            $myMessage = $message;
            if (is_object($message) || is_array($message)) {
                $myMessage = json_encode($message);
            }
        } catch (Exception $e) {
        }
        \Logger::getLogger($logger)->warn("[" . $fileinfo . "] " . $myMessage, $exception);
    }

    public static function fatal($message, $exception = null, $logger = null)
    {
        $backtrace = debug_backtrace();
        $fileinfo = '';
        try {
            if (!empty($backtrace[0]) && is_array($backtrace[0])) {
                $fileName = $backtrace[0]['file'];
                $fileName = empty($fileName) ? "" : $fileName;
                $fileName = basename($fileName);
                $fileinfo = $fileName . ":" . $backtrace[0]['line'];
            }
            $myMessage = $message;
            if (is_object($message) || is_array($message)) {
                $myMessage = json_encode($message);
            }
        } catch (Exception $e) {
        }
        \Logger::getLogger($logger)->fatal("[" . $fileinfo . "] " . $myMessage, $exception);
    }

    public static function devInfo($message, $exception = null, $logger = null)
    {
        $backtrace = debug_backtrace();
        $fileinfo = '';
        try {
            if (!empty($backtrace[0]) && is_array($backtrace[0])) {
                $fileName = $backtrace[0]['file'];
                $fileName = empty($fileName) ? "" : $fileName;
                $fileName = basename($fileName);
                $fileinfo = $fileName . ":" . $backtrace[0]['line'];
            }
        } catch (Exception $e) {
        }
        \Logger::getLogger($logger)->info("[" . $fileinfo . "] log content ----------------------------------- ");
        \Logger::getLogger($logger)->info($message, $exception);
    }
}