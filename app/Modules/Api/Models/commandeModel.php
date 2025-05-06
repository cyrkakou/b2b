<?php

namespace App\Modules\Api\Models;

use App\Controllers\IbemsModel;

class CommandeModel extends IbemsModel
{
    protected $DBGroup              = 'default';
    protected $table                = 'commandes';
    protected $primaryKey           = 'commandeID';
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
        $added_by = get_user_info('user_id');
        db()->transStart();
        //personne
        $data = self::sanitize_for('personnes',$args);
        db('personnes')->insert($data);
        $personneID = db()->insertID();
        //patient
        $data = self::sanitize_for('patients',$args);
        $data['personneID'] = $personneID;
        $data['added'] = time();
        $data['added_by'] = $added_by;
        db('patients')->insert($data);
        $patientID = db()->insertID();
        db()->transComplete();
        return db()->transStatus() !== false;
    }
    public static function modifier($primary_keys = null,array $data = []): bool
    {
        if($patient = self::trouver($primary_keys)){
            db()->transStart();
            $data = self::sanitize_for('patients',$data);
            db('patients')
                ->where('patientID', $patient->patientID)
                ->update($data);
            $data = self::sanitize_for('personnes',$data);
            db('personnes')
                ->where('personneID',$patient->personneID)
                ->update($data);
            db()->transComplete();
            return db()->transStatus() !== false;
        }
        return false;
    }
    public static function supprimer(int $primary_keys):bool{
        if($rs = self::trouver($primary_keys)){
            db()->transStart();
            db('patients')
                ->where('patientID',intval($primary_keys))
                ->delete();
            db()->transComplete();
            return db()->transStatus() !== false;
        }
        return false;
    }
    public static function lister()
    {
        if($rs =  db('patients')
            ->select('*')
            ->join('personnes','personnes.personneID = patients.personneID','left')
            ->get()){
            return $rs->getResult();
        }
        return [];
    }
    public static function trouver(int $primary_key)
    {
        if($rs =  db('patients')
            ->select('*')
            ->join('personnes','personnes.personneID = patients.personneID','left')
            ->where('patients.patientID',intval($primary_key))
            ->get()
            ){
            return $rs->getRow();
        }
        return false;
    }
}
