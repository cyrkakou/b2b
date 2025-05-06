<?php

namespace App\Controllers;

use CodeIgniter\Model;


class IbemsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public static function sanitize_for($table, $data = [])
    {
        $post = (array_merge($_POST, $data));
        $fields = db()->getFieldNames($table);
        $data = [];
        foreach ($fields as $value) {
            if(isset($post[$value])) $data[$value] = trim($post[$value]);
        }
        return $data;
    }
}
