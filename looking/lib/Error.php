<?php

namespace looking\lib;

use looking\lib\exception\ErrorException;

class Error {

    public static function register() {

        // 报告所有php错误
        error_reporting(E_ALL);
        set_error_handler([__CLASS__, 'appError']);
        set_exception_handler([__CLASS__, 'appException']);
        register_shutdown_function([__CLASS__, 'appShutdown']);
    }

    /**
     * 自定义异常处理
     * @param \Exception $exception
     */
    public static function appException($exception) {
        var_dump("File error：" . $exception->getFile());
        var_dump("Error Line：" . $exception->getLine());
        var_dump($exception->getMessage());
        exit(0);
    }

    /**
     * 自定义错误处理
     * @param integer $errno     错误编号
     * @param string $errStr     详细错误信息
     * @param string $errFile    出错的文件
     * @param int $errLine       出错行号
     * @throws ErrorException
     */
    public static function appError($errno, $errStr, $errFile = '', $errLine = 0) {

        if (!(error_reporting () & $errno)) {
            return;
        }

        // 投递给错误异常处理
        throw new ErrorException($errStr, $errno, $errFile, $errLine);

    }


    public static function appShutdown() {

    }

}
