<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 14-10-25
 * Time: 下午2:15
 */

namespace Dy\Database;

/**
 * Class Builder
 *
 * 查询构造器
 * @package Dy\Database
 */
class Builder
{
    /**
     * @param $sql
     * @param $binds
     * @return bool|\PDOStatement
     */
    public static function query($sql, $binds)
    {
        $stmt = DB::getConnection()->prepare($sql);
        if ($stmt->execute($binds)) {
            return $stmt;
        } else {
            return false;
        }
    }
}