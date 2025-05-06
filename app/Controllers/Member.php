<?php
namespace App\Modules\Api\Controllers;
//use App\Models\MemberModel;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{
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

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function login($id = null)
    {


        if (@$data) {
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => "Member Found",
                "data" => $data,
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound('No Member Found with id ' . $id);
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function logout()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {


        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'mobile' => $this->request->getVar('mobile'),
        ];



        $response = [
            'status' => 200,
            'error' => null,
            'messages' => "Member Saved",
        ];

        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {


        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'mobile' => $this->request->getVar('mobile'),
        ];



        $response = [
            'status' => 200,
            'error' => null,
            'messages' => "Data Updated"
        ];
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new MemberModel();

        $data = $model->find($id);

        if ($data) {

            $model->delete($id);

            $response = [
                'status' => 200,
                'error' => null,
                'messages' => "Data Deleted",
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }
}
