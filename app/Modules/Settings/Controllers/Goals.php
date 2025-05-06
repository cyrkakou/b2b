<?php
namespace App\Modules\Settings\Controllers;
use App\Controllers\IbemsController;
use App\Modules\Api\Models\GoalModel;


class Goals extends IbemsController {

    private $goalModel;

   public function __construct(){
        parent::__construct();
        is_protected(['root','admin','backoffice']);
        $this->goalModel = new GoalModel();

        self::set_crumb([
            ['text'=>'objectifs','url'=>base_url('settings/goals')]
        ]);
        self::set_data('page_title','Gestion des objectifs');
        self::set_data('breadcrumb',self::breadcrumb());
        
        self::add_data('content', view('App\Modules\Settings\Views\goals\create', self::get_data()));
        add_module_js(null,"goal.js");

    }
    public function index()
    {
        self::add_crumb(['text'=>'Liste']);
        self::set_data('dataset',$this->goalModel::lister());
        self::add_data('content', view('App\Modules\Settings\Views\goals\list', self::get_data()));
        return view('backend/layout',self::get_data());
    }
    
    public function create(){
        if ($this->request->getMethod() == "post") {
            $response = '';
            if($this->goalModel::ajouter([]))
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
}










