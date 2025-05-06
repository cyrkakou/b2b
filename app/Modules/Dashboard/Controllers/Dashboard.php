<?php
namespace App\Modules\Dashboard\Controllers;
use App\Controllers\IbemsController;
use App\Modules\Api\Models\ParticipantModel;

class Dashboard extends IbemsController {
    private $role;

    function __construct()
    {
        parent::__construct();
        is_protected();
        $this->role = get_user_info('role_code');
        $this->participant_model = new ParticipantModel();
        $config = config('App');
        self::set_data('subheader',false);
    }

    public function index() {
        $all = $this->participant_model::lister();
        $pending = $this->participant_model::allPending();
        $valid = $this->participant_model::allValid();
        $rejected = $this->participant_model::allRejected();

        self::set_data('all', @count($all));
        self::set_data('pending', @count($pending));
        self::set_data('valid', @count($valid));
        self::set_data('rejected', @count($rejected));
        self::add_data('content',view('App\Modules\Dashboard\Views\index',self::get_data()));

        return view('backend/layout',self::get_data());

    }

}
