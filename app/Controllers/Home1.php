<?php

namespace App\Controllers;

class Home1 extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
}
