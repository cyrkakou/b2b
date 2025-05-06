<?php
namespace App\Modules\Profile\Controllers;
use App\Controllers\IbemsController;

class Profile extends IbemsController {
    private $role;

    function __construct()
    {
        parent::__construct();
        is_protected();
    }
    public function index(){
        self::add_data('content',view('App\Modules\Profile\Views\index',self::get_data()));
        return view('backend/layout',self::get_data());
    }

}
