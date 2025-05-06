<?php
namespace App\Modules\Api\Models;
use App\Controllers\IbemsModel;
class StrategieModel extends IbemsModel
{
    protected $DBGroup              = 'default';
    protected $table                = 'users_strategies';
    protected $primaryKey           = 'strategieID';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDelete        = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        "name",
        "email",
        "mobile"
    ];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];
    public function __construct()
    {
        parent::__construct();
    }
    public static function lister()
    {
        $data = [];
        $rs = db('users_strategies')
            ->get()
            ->getResult();
        foreach($rs as $k=>$v)
        {
            $data[$v->component_id][$v->role_id][$v->permission_id] = 1;
        }
        return($data);
    }
    public static function can($role_id, $component_id, $permission_id)
    {
        $rs = self::$DB->select('count(*) as can')
            ->from('users_strategies')
            ->where('role_id',$role_id)
            ->where('component_id',$component_id)
            ->where('permission_id',$permission_id)
            ->get()->row();

        return($rs->can >= 1);
    }
    public static function for_role(int $role_id):array
    {
        $data = [];
        if($rs = db('users_strategies')
            ->select('
                role_id,
                components.component_id,
                components.component_code,
                components.component_trigger,
                users_permissions.permission_id,
                users_permissions.permission_code')
            ->join('components','components.component_id = users_strategies.component_id')
            ->join('users_permissions','users_permissions.permission_id = users_strategies.permission_id')
            ->where('role_id', intval($role_id))
            ->get()){
            foreach($rs->getResult() as $k=>$v)
            {
                $data[$v->component_trigger][$v->permission_code] = 1;
            }
        }
        return($data);
    }
}
