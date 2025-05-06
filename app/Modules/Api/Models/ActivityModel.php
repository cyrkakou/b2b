<?php

namespace App\Modules\Api\Models;

use App\Controllers\IbemsModel;

class ActivityModel extends IbemsModel
{
    protected $table = 'business_line';
    protected $primaryKey = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $allowedFields = ['name', 'created_by'];
    protected $useTimestamps = true;
    protected $returnType = 'array';


    // Validation
    protected $validationRules      = [
        'name'        => 'required|is_unique[business_line.name]',
    ];
    protected $validationMessages   = [
        'name'        => [
            'is_unique' => 'Sorry. That name has already been taken. Please choose another.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;


     public function __construct(){
        parent::__construct();
    }

    public static function ajouter(array $args = []):bool{
                $added_by = get_user_info('user_id');
        $data = self::sanitize_for('business_line',$args);
        $data['created_by'] = $added_by;
        return db('business_line')
            ->insert($data);
    }
    public static function modifier($primary_keys = null,array $data = []): bool
    {
        $data = self::sanitize_for(self::table,$data);
        return db(self::table)
            ->where('id',intval($primary_keys))
            ->update($data);
    }

    
       public static function supprimer(int $primary_keys):bool{
        if($rs = self::trouver($primary_keys)){
            db()->transStart();
            db('business_line')
                ->where('id',intval($primary_keys))
                ->delete();
            db()->transComplete();
            return db()->transStatus() !== false;
        }
        return false;
    }

    
       public static function lister()
    {
        if($rs =  db('business_line')
            ->select('*')
            ->get()){
            return $rs->getResult();
        }
        return [];
    }
    
        public static function trouver(int $primary_key)
    {
        if($rs =  db('business_line')
            ->select('*')
            ->where('id',intval($primary_key))
            ->get()
            ){
            return $rs->getRow();
        }
        return false;
    }
}