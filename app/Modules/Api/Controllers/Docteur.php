<?php
namespace App\Modules\Api\Controllers;
use App\Modules\Api\Models\DocteurModel;
use CodeIgniter\RESTful\ResourceController;
use App\Controllers\IbemsController;

class Docteur extends ResourceController
{
    private $session;
    public function __construct(){
        $ci = new IbemsController();
        $this->session = $ci->session;
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {


        $data = [];

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => "Members Found",
            "data" => $data,
        ];
        return $this->respond($response);
    }


}
