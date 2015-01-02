<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 14-10-25
 * Time: 下午2:17
 */

namespace Dy\Database;

/**
 * Class Forge
 *
 * 类似ci的db forge只是用来migration的,不过不会去缓存查询结果
 *
 * @package Dy\Database
 */
final class Forge
{
    public function tableExists($tableName)
    {
        $sql = 'select COUNT(*) AS num from information_schema.tables where table_schema = DATABASE() and table_name = :tbl_name';
        $query = Builder::query($sql, array('tbl_name' => $tableName));
        if ($query) {
            return $query->fetch()->num === '1';
        }
        return false;
    }

    public function columnExists($tableName, $columnName)
    {
        $sql = 'select COUNT(*) AS num from information_schema.columns where table_schema = DATABASE() and table_name = :tbl_name and column_name = :col_name';
        $query = Builder::query($sql, array(':tbl_name' => $tableName, ':col_name' => $columnName));
        if ($query) {
            return $query->fetch()->num === '1';
        }
        return false;
    }

    public function createTable($tableName, $info)
    {
        return DB::getConnection()->exec("CREATE TABLE `{$tableName}` $info");
    }

    public function createDatabase($databaseName)
    {
        DB::getConnection()->exec("CREATE DATABASE {$databaseName}");
        $config = array('database' => $databaseName);
        DB::reconnect($config);
    }

    public function dropDatabase($databaseName)
    {
        DB::getConnection()->exec("DROP DATABASE {$databaseName}");
        $config = array('database' => '');
        DB::reconnect($config);
    }
}