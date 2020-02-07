<?php

namespace looking\lib;

use looking\lib\exception\ErrorException;

class Config {

    private static $configFile = [];

    /**
     * 注册配置文件
     * @return bool
     * @throws ErrorException
     */
    public static function register() {

        // 配置文件目录
        if (!is_dir(CONFIG_PATH)) {
            return false;
        }

        // 打开配置文件目录
        $dirSource = opendir(CONFIG_PATH);
        if (false === $dirSource) {
            throw new ErrorException('打开配置文件目录句柄失败');
        }

        // 读取所有配置文件
        while (($file = readdir($dirSource)) !== false) {
            if (strpos($file, '.php')) {
                static::$configFile[] = $file;
            }
        }

        // 载入配置文件
        if (!empty(static::$configFile)) {
            foreach (static::$configFile as $configFileName) {
                require CONFIG_PATH . $configFileName;
            }
        }

        return true;
    }

}
