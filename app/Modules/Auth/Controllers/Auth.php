<?php
namespace App\Modules\Auth\Controllers;
use App\Controllers\IbemsController;
use App\Modules\Api\Models\UserModel;

class Auth extends IbemsController {
    public function __construct(){
        parent::__construct();
        $this->UserModel = new UserModel();
        add_js(null,'assets/js/login.js');
        add_css(null,'assets/css/login.css');
    }
    public function index()
    {
        self::add_data('content', view('App\Modules\Auth\Views\form_login', self::get_data()));
        echo view('backend/layout.login.php', self::get_data());
    }
    public function signup(){
        if ($this->request->getMethod() == "post") {
            if(!$this->UserModel::check_user(
                $this->request->getVar('email'),
                $this->request->getVar('telephone')
            )){
                $this->UserModel::account([
                    'user_login'=>$this->request->getVar('email'),
                    'user_email'=>$this->request->getVar('email'),
                    'user_phone'=>$this->request->getVar('telephone'),
                    'user_password'=>$this->request->getVar('password'),
                    'user_nicename'=>$this->request->getVar('fullname'),
                    'role_id'=>get_role('client')
                ]);
            }
            return redirect()->to(base_url());
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
        exit(0);
    }
}
