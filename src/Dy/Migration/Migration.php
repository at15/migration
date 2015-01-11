<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-1-3
 * Time: 下午4:23
 */

namespace Dy\Migration;


class Migration
{
    // in order to use ci's model and all etc in migration
    protected $ci;

    public function __construct()
    {
        if (function_exists('get_instance')) {
            $this->ci = &get_instance();
        } else {
            $this->ci = NULL;
        }
    }

    public function up()
    {

    }

    public function down()
    {

    }
}