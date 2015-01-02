<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 14-10-25
 * Time: 上午11:32
 */
namespace Dy\Database;

/**
 * Class DB
 * @package Dy\Database
 */
class DB
{
    /**
     * @var DB
     */
    private static $_instance = null;
    /**
     * @var \PDO
     */
    private static $_conn = null;
    /**
     * @var array
     */
    private static $config = array();
    private static $createMode = false;

    protected function __construct()
    {
        $default_config = array(
            'host' => 'localhost',
            'database' => '',
            'username' => 'root',
            'password' => ''
        );
        // merge the config
        static::$config = array_merge($default_config, static::$config);

    }

    protected function __clone()
    {
        // disallow clone
    }

    public static function setConfig($config, $merge = true)
    {
        if ($merge) {
            static::$config = array_merge(static::$config, $config);
        } else {
            static::$config = $config;
        }
    }

    public static function enableCreateMode()
    {
        static::$createMode = true;
    }

    public static function disableCreateMode()
    {
        static::$createMode = false;
    }

    /**
     * @return DB
     */
    public static function getInstance()
    {
        if (static::$_instance === null) {
            static::$_instance = new self();
        }
        return static::$_instance;
    }

    /**
     *
     * only connect when getConnection is called
     *
     * @todo reconnect
     * @return \PDO
     */
    public static function getConnection()
    {
        if (static::$_instance === null) {
            static::getInstance();
        }

        if (static::$_conn === null) {
            // generate dsn.
            // only support mysql currently
            $dsn = 'mysql:host=' . static::$config['host'];
            if (!empty(static::$config['database']) and !static::$createMode) {
                $dsn .= ';dbname=' . static::$config['database'];
            }
            // set the options when first connect. reduce query for set attributes? (set attributes doesn't query mysql?)
            $driver_options = array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ);
            try {
                static::$_conn = new \PDO($dsn,
                    static::$config['username'], static::$config['password'], $driver_options);
            } catch (\PDOException $exception) {
                throw new \InvalidArgumentException(sprintf(
                    'There was a problem connecting to the database: %s',
                    $exception->getMessage()
                ));
            }

        }
        return static::$_conn;
    }

    /**
     * reconnect database using different config. eg:u want to create database
     *
     * @todo implements
     * @param $config
     */
    public static function reconnect($config)
    {
        static::setConfig($config);
        static::$_instance = null;
        static::getConnection();
    }
}