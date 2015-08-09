<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-8-9
 * Time: 下午9:09
 */

$dockerMysqlName = 'migration-mysql';
$password = 'docker';
$port = 4407;
$startCmd = "docker run --name {$dockerMysqlName} -e MYSQL_ROOT_PASSWORD={$password} " .
    "-d -p {$port}:3306 mysql:5.5";
$removeCmd = "docker rm -f {$dockerMysqlName}";

//echo $startCmd;
//echo $removeCmd;

exec($removeCmd);
exec($startCmd);