<?php
namespace App\Modules\Api\Controllers;
use App\Modules\Api\Models\UserModel;
use App\Modules\Api\Models\StrategieModel;
use CodeIgniter\RESTful\ResourceController;
use App\Controllers\IbemsController;

class Auth extends ResourceController
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

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function login($id = null)
    {
        $username =  $this->request->getVar('username');
        $password =  $this->request->getVar('password');
        $pin =  $this->request->getVar('pin');
        if(!empty($username) && !empty($password))
        {
            $model = new UserModel();
            $user = $model::is_user($username, $password);
            if(!$user){
                $response = [
                    'status' => 'error',
                    'message' => "Mot de passe ou nom d'utilisateur incorrecte.",
                    "data" =>[],
                ];
                return $this->respond($response);
            }else{

                if(in_array($user->user_status,[4])){
                    $response = [
                        'status' => 'error',
                        'code' => 1,
                        'message' => "Compte suspendu",
                        "data" =>[],
                    ];
                    return $this->respond($response);
                }elseif(!empty($pin)){
                    $query =  db('users')
                        ->select('*')
                        ->join('users_roles','users_roles.role_id = users.role_id')
                        ->where('users.user_pin',$pin)
                        ->whereIn('users.role_id',[1,2])
                        ->get();
                    if($query->getNumRows()){
                        $response = [
                            'status' => 'success',
                            'message' => "OK",
                        ];
                        self::initSession($query->getRow());
                        return $this->respond($response);
                    }
                }
                $response = [
                    'status' => 'success',
                    'message' => "OK",
                ];
                self::initSession($user);
                return $this->respond($response);
            }
        }
        return $this->failNotFound('user not founded');
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
    private function initSession(object $user)
    {
        if($user)
        {
            $token = token();
            $pin   = pin(6);
            $request = \Config\Services::request();
            $agent = $request->getUserAgent();
            //mise à jour du statut
            if ($agent->isBrowser()) {
                $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
            } elseif ($agent->isRobot()) {
                $currentAgent = $agent->getRobot();
            } elseif ($agent->isMobile()) {
                $currentAgent = $agent->getMobile();
            } else {
                $currentAgent = 'Unidentified User Agent';
            }

            $data = [
                'user_id'=>$user->user_id,
                'ip_adress'=>$request->getIPAddress(),
                'device'=>$currentAgent,
                'user_agent'=>$agent->getAgentString(),
                'timestamp'=>time()
            ];
            db('users_connections_history')
                ->insert($data);

            $data = [
                'lastvisit'=>time(),
                'user_pin'=>$pin,
                'online'=>1
            ];
            db('users')
                ->where('user_id', $user->user_id)
                ->update($data);
            //insertion du token
            db('tokens')
                ->where('user_id', $user->user_id)
                ->replace([
                'user_id'=>$user->user_id,
                'token'=>$token
            ]);
            //recuperation des données à jour
            //
            $model = new StrategieModel();
            $user->strategies = $model::for_role($user->role_id);
            $user->user_pin = $pin;
            //
            //$personne = (array)personnes_model::get_by_user($user_id, $user['role_name']);
            //$me = (object)array_merge($user, $personne,['token'=>$token]);
            $this->session->set('hash', md5(uniqid(rand(), true)));
            $this->session->set('user', $user);
            //$this->session->set('me', $me);
            return true;

        }
        return false;
    }
}
