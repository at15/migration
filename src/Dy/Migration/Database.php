<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-1-2
 * Time: 上午12:20
 */
namespace Dy\Migration;

use Dy\Database\DB;
use Dy\Database\Forge;

class Database
{
    protected $_exists = false;

    public function __construct($databaseName = '')
    {
        if (!empty($databaseName) and $this->exists($databaseName)) {
            $this->_exists = true;
        }
    }

    public function exists($databaseName)
    {
        // TODO: recover the old database
        try {
            DB::getConnection()->exec("use {$databaseName}");
        } catch (\PDOException $e) {
            // TODO:use monolog
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public function create($databaseName)
    {
        $forge = new Forge();
        try {
            $forge->createDatabase($databaseName);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public function drop($databaseName)
    {
        $forge = new Forge();
        try {
            $forge->dropDatabase($databaseName);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }
}