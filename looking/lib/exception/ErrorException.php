<?php

namespace looking\lib\exception;

class ErrorException extends \Exception {

    /**
     * 错误异常构造函数
     * @param string  $message  错误详细信息
     * @param integer  $code    错误编号
     * @param string  $file     出错文件路径
     * @param integer $line     出错行号
     */
    public function __construct($message, $code = 0, $file = '', $line = 0) {
        parent::__construct($message);

        $this->message = $message;
        $this->code = $code;
        $this->file = $file;
        $this->line = $line;
    }

}