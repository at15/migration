<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-8-9
 * Time: 下午5:30
 */

// Test if we can connect to docker mysql server
print_r(mysqli_connect('0.0.0.0','root','docker','','4407'));
//print_r(mysqli_connect('localhost','root','vagrant','','7788'));