<?php
namespace App\Modules\Auth\Controllers;
use App\Controllers\IbemsController;
use App\Modules\Api\Models\UserModel;

class Users extends IbemsController {
    public function __construct(){
        parent::__construct();
        is_protected(['root','admin','backoffice']);
        $this->UserModel = new UserModel();

        self::set_crumb([
            ['text'=>'Utilisateurs','url'=>base_url('auth/users')]
        ]);
        self::set_data('page_title','Gestion des utilisateurs');
        self::set_data('breadcrumb',self::breadcrumb());
        //modal
        self::add_data('content', view('App\Modules\Auth\Views\users\create', self::get_data()));
        self::add_data('content', view('App\Modules\Auth\Views\users\update', self::get_data()));
        self::add_data('content', view('App\Modules\Auth\Views\users\delete', []));
        //self::add_data('content', view('App\Modules\Auth\Views\users\empty', []));
    }
    public function index()
    {
        add_module_js(null,'DT_Users.js');
        self::add_data('content',view('App\Modules\Auth\Views\users\list',self::get_data()));
        return view('backend/layout',self::get_data());
    }
    public function find($user_id){
        if($response = $this->UserModel::trouver(intval($user_id))){
            header('Content-Type: application/json');
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            exit(0);
        }
    }
    public function create(){
        if ($this->request->getMethod() == "post") {
            $response = [];
            if($this->UserModel::ajouter([]))
            {
                $response = [
                    'statut' => 'success',
                    'icon' => 'fad fa-exclamation',
                    'title' => 'Bravo !!!',
                    'message' => lang('Layout.msg_create_success'),
                ];
            } else {
                $response = [
                    'statut' => 'error',
                    'icon' => 'fad fa-times-circle',
                    'title' => 'Ooops !!!',
                    'message' => lang('Layout.msg_create_failed')
                ];
            }
            header('Content-Type: application/json');
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            exit(0);
        }
    }
    public function update(){
        if ($this->request->getMethod() == "post") {
            $response = [];
            if($this->UserModel::modifier($this->request->getVar('primary_key'),[]))
            {
                $response = [
                    'statut' => 'success',
                    'icon' => 'fad fa-exclamation',
                    'title' => 'Bravo !!!',
                    'message' => lang('Layout.msg_create_success'),
                ];
            } else {
                $response = [
                    'statut' => 'error',
                    'icon' => 'fad fa-times-circle',
                    'title' => 'Ooops !!!',
                    'message' => lang('Layout.msg_create_failed')
                ];
            }
            header('Content-Type: application/json');
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            exit(0);
        }
    }
    public function delete(){
        if ($this->request->getMethod() == "post") {
            $response = [];
            if($this->UserModel::supprimer($this->request->getVar('primary_key')))
            {
                $response = [
                    'statut' => 'success',
                    'icon' => 'fad fa-exclamation',
                    'title' => 'Bravo !!!',
                    'message' => lang('Layout.msg_create_success'),
                ];
            } else {
                $response = [
                    'statut' => 'error',
                    'icon' => 'fad fa-times-circle',
                    'title' => 'Ooops !!!',
                    'message' => lang('Layout.msg_create_failed')
                ];
            }
            header('Content-Type: application/json');
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            exit(0);
        }
    }
    public function fetch_users(array $args = [])
    {
        datatable()::fetch_data([
            'default_sort'=>'user_id',
            'query'=>'SELECT *                        
                        FROM users   
                        LEFT JOIN users_status ON users_status.status_code = users.user_status
                        LEFT JOIN users_roles ON users_roles.role_id = users.role_id
                        ',
            'where'=>[
                'users.role_id!=1',
            ],
            'columns'=>[
                'user_id',
                'user_login',
                'user_nicename',
                'role_name'
            ]
        ]);
    }
}
