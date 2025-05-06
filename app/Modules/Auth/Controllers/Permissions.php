<?php
namespace App\Modules\Auth\Controllers;
use App\Controllers\IbemsController;
use App\Modules\Api\Models\PermissionModel;

class Permissions extends IbemsController {
    protected $PermissionModel;
    public function __construct(){
        parent::__construct();
        is_protected(['root','admin','backoffice']);
        $this->PermissionModel = new PermissionModel();


        self::set_crumb([
            ['text'=>'Permissions','url'=>base_url('security/users')]
        ]);
        self::set_data('page_title','Gestion des permissions');
        self::set_data('breadcrumb',self::breadcrumb());
        //modal
        self::add_data('content', view('App\Modules\Auth\Views\permissions\create', []));
        self::add_data('content', view('App\Modules\Auth\Views\permissions\update', []));
        self::add_data('content', view('App\Modules\Auth\Views\permissions\delete', []));
    }
    public function index()
    {
        $data = $this->PermissionModel
            ->asObject()
            ->findAll();
        self::set_data('datagrid',$data);
        self::add_data('content',view('App\Modules\Auth\Views\permissions\list',self::get_data()));
        return view('backend/layout',self::get_data());
    }
    public function do_find($permission_id)
    {
        if($response = $this->PermissionModel->find(intval($permission_id))){
            header('Content-Type: application/json');
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            exit(0);
        }
    }
    public function do_create()
    {
        if (isPostBack()) {
            $response = [];
            if($this->PermissionModel::ajouter())
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
    public function do_update()
    {
        if (isPostBack()) {
            $response = [];
            if($this->PermissionModel::modifier($this->request->getPost('permission_id')))
            {
                $response = [
                    'statut' => 'success',
                    'icon' => 'fad fa-exclamation',
                    'title' => 'Bravo !!!',
                    'message' => lang('Layout.msg_update_success'),
                ];
            } else {
                $response = [
                    'statut' => 'error',
                    'icon' => 'fad fa-times-circle',
                    'title' => 'Ooops !!!',
                    'message' => lang('Layout.msg_update_failed')
                ];
            }
            header('Content-Type: application/json');
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            exit(0);
        }
    }
    public function do_delete(){

        if (isPostBack()) {
            $response = [];
            if($this->PermissionModel::supprimer($this->request->getPost('primary_key')))
            {
                $response = [
                    'statut' => 'success',
                    'icon' => 'fad fa-exclamation',
                    'title' => 'Bravo !!!',
                    'message' => lang('Layout.msg_delete_success'),
                ];
            } else {
                $response = [
                    'statut' => 'error',
                    'icon' => 'fad fa-times-circle',
                    'title' => 'Ooops !!!',
                    'message' => lang('Layout.msg_delete_failed')
                ];
            }
            header('Content-Type: application/json');
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            exit(0);
        }
    }
}
