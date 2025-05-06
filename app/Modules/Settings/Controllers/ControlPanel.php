<?php
namespace App\Modules\Settings\Controllers;

use App\Controllers\IbemsController;

class ControlPanel extends IbemsController {
    public function __construct()
    {
        parent::__construct();
        is_protected(['root','admin','backoffice']);
    }
    public function index()
    {
        self::set_data('menuitems',self::menuitems());
        self::add_data('content',view('App\Modules\Settings\Views\index',self::get_data()));
        return view('backend/layout',self::get_data());
    }
    public function menuitems()
    {
        return [
//            [
//                'title'=>'Assurance',
//                'items'=>[
//                    [
//                        'icon'=>'fal fa-folder-tree fa-2x',
//                        'url'=>'settings/assurance',
//                        'text'=>'Assurance',
//                        'description'=>"Les branches d'assurance"
//                    ]
//                ]
//            ],
            [
                'title'=>'Configuration',
                'items'=>[
                    [
                        'icon'=>'fal fa-users fa-2x',
                        'url'=>'settings/medecin',
                        'text'=>'Médecin',
                        'description'=>'Gestion des médecins'
                    ],
                    [
                        'icon'=>'fal fa-list fa-2x',
                        'url'=>'settings/pharmacie',
                        'text'=>'Pharmacie',
                        'description'=>"Gestion des pharmacies"
                    ]
                ]
            ]
        ];
    }
}
?>
