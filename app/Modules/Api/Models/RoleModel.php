<?php

namespace App\Modules\Api\Models;

use App\Controllers\IbemsModel;

class RoleModel extends IbemsModel
{
    protected $DBGroup              = 'default';
    protected $table                = 'users_roles';
    protected $primaryKey           = 'role_id';
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
    public function __construct(){
        parent::__construct();
    }
    public static function ajouter(array $args = []):bool{
        $data = self::sanitize_for('users_roles',$args);
        return db('users_roles')
            ->insert($data);;
    }
    public static function modifier($primary_keys = null,array $data = []): bool
    {
        $data = self::sanitize_for('users_roles',$data);
        return db('users_roles')
            ->where('role_id',intval($primary_keys))
            ->update($data);;
    }
    public static function supprimer(mixed $primary_keys):bool{
        if(is_array($primary_keys)){
            return db('users_roles')
                ->whereIn('role_id',$primary_keys)
                ->delete();;
        }else{
            return db('users_roles')
                ->where('role_id',intval($primary_keys))
                ->delete();;
        }
    }
}
