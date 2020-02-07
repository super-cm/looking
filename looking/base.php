<?php

namespace looking;

use app\v1\controller\Index;
use looking\lib\Error;
use looking\lib\Config;

define('DS', DIRECTORY_SEPARATOR);
defined('LOOKING_PATH') or define('LOOKING_PATH', __DIR__ . DS);

defined('INDEX_PATH') or define('INDEX_PATH', dirname($_SERVER['SCRIPT_FILENAME']) . DS);
defined('ROOT_PATH') or define('ROOT_PATH', dirname(INDEX_PATH) . DS);
defined('CONFIG_PATH') or define('CONFIG_PATH', ROOT_PATH . 'config' . DS);

// 引入composer自动加载
require __DIR__ . '/../vendor/autoload.php';

// 注册异常处理机制
Error::register();
Config::register();

(new Index())->index();