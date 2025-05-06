<?php

namespace App\Modules\Settings\Models;

use App\Controllers\IbemsModel;

class SectorModel extends IbemsModel
{
    protected $table = 'sector';
    protected $primaryKey = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $allowedFields = ['name', 'created_by'];
    protected $useTimestamps = true;
    protected $returnType = 'array';


    // Validation
    protected $validationRules      = [
        'name'        => 'required|is_unique[vector.name]',
    ];
    protected $validationMessages   = [
        'name'        => [
            'is_unique' => 'Sorry. That name has already been taken. Please choose another.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;


    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public static function ajouter(array $args = []):bool{
        $data = self::sanitize_for('sector',$args);
        return db('sector')
            ->insert($data);
    }
    public static function modifier($primary_keys = null,array $data = []): bool
    {
        $data = self::sanitize_for(self::table,$data);
        return db(self::table)
            ->where('id',intval($primary_keys))
            ->update($data);
    }
    public static function supprimer(mixed $primary_keys):bool{
        if(is_array($primary_keys)){
            return db('sector')
                ->whereIn('id',$primary_keys)
                ->delete();
        }else{
            return db('sector')
                ->where('id',intval($primary_keys))
                ->delete();
        }
    }

    public function getAll(){
        $rs = $this->db
            ->table('sector')
            ->select('sector.*')
            ->orderBy('id','DESC')
            ->get()
            ->getResult();
        return $rs;
    }

    public function find($sector_id=0){
        $rs = $this->db
            ->table('sector')
            ->select('sector.*')
            ->where('id',$sector_id)
            ->orderBy('id','DESC')
            ->get()
            ->getResult();
        return $rs;
    }
}