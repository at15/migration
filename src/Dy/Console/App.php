<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-1-2
 * Time: 下午12:02
 */
namespace Dy\Console;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

class App extends Application
{
    protected $_configDirPath = '';
    protected $_cachedConfig = array();

    public function __construct()
    {
        parent::__construct();
        $this->add(new Commands\Create());
        $this->add(new Commands\Drop());
    }

    public function setConfigDir($dir)
    {
        $this->_configDirPath = rtrim($dir, '/');
    }

    public function readConfig($name)
    {
        if (!isset($this->_cachedConfig[$name])) {
            $this->_cachedConfig[$name] = require_once($this->_configDirPath . '/' . $name . '.php');
        }
        return $this->_cachedConfig[$name];
    }
}