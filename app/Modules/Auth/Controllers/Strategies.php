<?php
namespace App\Modules\Auth\Controllers;
use App\Controllers\IbemsController;
use App\Modules\Api\Models\ComponentModel;
use App\Modules\Api\Models\PermissionModel;
use App\Modules\Api\Models\RoleModel;
use App\Modules\Api\Models\StrategieModel;

class Strategies extends IbemsController {
    public function __construct(){
        parent::__construct();
        is_protected(['root','admin','backoffice']);
        $this->RoleModel = new RoleModel();
        $this->PermissionModel = new PermissionModel();
        $this->ComponentModel = new ComponentModel();
        $this->StrategieModel = new StrategieModel();


        self::set_crumb([
            ['text'=>"Droit d'accés",'url'=>base_url('auth/strategies')]
        ]);
        self::set_data('page_title',"Gestion des droits d'accés");
        self::set_data('breadcrumb',self::breadcrumb());
    }
    public function index()
    {
        if ($this->request->getMethod() == "post") {

            $select = $this->request->getPost('selected');
            $row = [];
            $response = [];            
            db('users_strategies')->emptyTable();
            if(is_array($select)){
                foreach($select as $role_id=>$components)
                {
                    foreach($components as $component_id=>$permissions)
                    {
                        foreach($permissions as $permission_id=>$value)
                        {
                            $row[] = [
                                'role_id'=>$role_id,
                                'component_id'=>$component_id,
                                'permission_id'=>$permission_id,
                            ];
                        }
                    }
                };
                //
                if(db('users_strategies')->insertBatch($row))
                {
                   // reload_user();
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
            }

            
            

      




            if (is_array($response)){
                session()->setFlashdata("response", $response);
            }
            return redirect()->to(base_url('auth/strategies/'));
        }
        $roles = $this->RoleModel
            ->asObject()
            ->where("role_code!='root'")
            ->findAll();
        $permissions = $this->PermissionModel
            ->asObject()
            ->findAll();
        $components = $this->ComponentModel
            ->asObject()
            ->findAll();
        $strategies = $this->StrategieModel
            ->asObject()
            ->findAll();
        $this->set_data('roles',$roles);
        $this->set_data('components',$components);
        $this->set_data('permissions',$permissions);
        $this->set_data('strategies',$this->StrategieModel::lister());
        self::add_data('content',view('App\Modules\Auth\Views\strategies\list',self::get_data()));
        return view('backend/layout',self::get_data());
    }
}
