<?php
/**
 * Created by PhpStorm.
 * User: at15
 * Date: 15-1-2
 * Time: 上午12:20
 */
namespace Dy\Migration;

class Database
{
    protected $_exists = FALSE;

    public function __construct($db_name = '')
    {
        if (!empty($db_name) AND $this->exists($db_name)) {
            $this->_exists = TRUE;
        }
    }

    public function exists($db_name)
    {

        return TRUE;
    }
}