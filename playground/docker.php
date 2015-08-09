<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-8-9
 * Time: 下午6:08
 */

// use docker commandline to create and remove mysql container

// create container
//exec('docker run --name migration-mysql -e MYSQL_ROOT_PASSWORD=docker -d -p 4407:3306 mysql:5.5');
// remove the old container
print_r(exec('docker rm -f migration-mysql',$output,$returnVar));
print_r($output);
print_r($returnVar);