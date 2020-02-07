<?php

namespace looking\lib;

use looking\lib\exception\ErrorException;

class Config {

    /**
     * @var array 配置文件
     */
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

                require CONFIG_PATH . $file;
            }
        }

        return true;
    }

    /**
     * 获得指定配置文件配置内容
     * @param string $key 配置文件内容，例如：database.username
     * @return mixed|null
     */
    public static function get($key = '') {

        if (empty($key)) {
            return null;
        }

        if (empty(static::$configFile)) {
            return null;
        }

        list($configFileName, $configKeyName) = explode('.', $key);

        foreach (static::$configFile as $configFileNameWithExt) {
            if (false !== strpos($configFileNameWithExt, $configFileName)) {
                $configFileContent = require CONFIG_PATH . $configFileNameWithExt;
                
                return array_key_exists($configKeyName, $configFileContent) ? $configFileContent[$configKeyName] : null;
            }
        }

        return null;
    }

}
