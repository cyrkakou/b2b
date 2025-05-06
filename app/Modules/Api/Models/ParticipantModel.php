<?php

namespace App\Modules\Api\Models;

use App\Controllers\IbemsModel;

class ParticipantModel extends IbemsModel
{
    protected $DBGroup              = 'default';
    protected $table                = 'participant';
    protected $primaryKey           = 'code';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDelete        = false;
    protected $protectFields        = true;
    protected $allowedFields        = [

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

    public static function ajouter(array $args = []): array
    {
        $added_by = get_user_info('user_id');
        db()->transStart();
        
        // Prepare company data
        $data = self::sanitize_for('company', $args);
        db('company')->insert($data);
        $companyID = db()->insertID();
        
        // Prepare company_business_line data
        $company_business_lines = [];
        foreach ($args['activities'] as $activity) {
            $company_business_lines[] = [
                'company_id' => $companyID,
                'business_line_id' => $activity
            ];
        }
        if (!empty($company_business_lines)) {
            $sanitized_data = array_map(function($item) {
                return self::sanitize_for('company_business_line', $item);
            }, $company_business_lines);
            db('company_business_line')->insertBatch($sanitized_data);
        }
        
        // Prepare company_goal data
        $company_goals = [];
        foreach ($args['goals'] as $goal) {
            $company_goals[] = [
                'company_id' => $companyID,
                'goal_id' => $goal
            ];
        }
        if (!empty($company_goals)) {
            $sanitized_data = array_map(function($item) {
                return self::sanitize_for('company_goal', $item);
            }, $company_goals);
            db('company_goal')->insertBatch($sanitized_data);
        }
        
        // Prepare company_profile data
        $company_profiles = [];
        foreach ($args['profiles'] as $profile) {
            $company_profiles[] = [
                'company_id' => $companyID,
                'profile_id' => $profile
            ];
        }
        if (!empty($company_profiles)) {
            $sanitized_data = array_map(function($item) {
                return self::sanitize_for('company_profile', $item);
            }, $company_profiles);
            db('company_profile')->insertBatch($sanitized_data);
        }
        
        // Prepare participants data
        $participants = [];
        foreach ($args['participants'] as $participant) {
            $participants[] = [
                'company_id' => $companyID,
                'prenom' => $participant['firstname'],
                'nom' => $participant['lastname'],
                'fonction' => $participant['function'],
                'email' => $participant['email'],
                'phone' => $participant['mobile'],
                'created_at' => $args['created_at']
            ];
        }
        if (!empty($participants)) {
            $sanitized_data = array_map(function($item) {
                return self::sanitize_for('participant', $item);
            }, $participants);
            db('participant')->insertBatch($sanitized_data);
        }
        
        // Prepare user data
        $users = [];
        foreach ($args['participants'] as $participant) {
            $password = self::random();
            
            $items[] = [
                'role_id' => 19,
                'user_login' => $participant['email'],
                'user_email' => $participant['email'],
                'user_nicename' => sprintf('%s %s', $participant['firstname'], $participant['lastname']),
                'user_phone' => $participant['mobile'],
                'created_at' => $args['created_at'],
                'added_by' => $added_by,
                'user_registered' => time(),
                'locked' => 1,
                'identifier' => identifier(16),
                'hash' => crypt($password, salt(32))
            ];
            $users[] = [
                'company_id' => $companyID,
                'email' => $participant['email'],
                'password' => $password,
                'firstname' => $participant['firstname'],
                'lastname' => $participant['lastname']
            ];
        }
        if (!empty($items)) {
            $sanitized_data = array_map(function($item) {
                return self::sanitize_for('users', $item);
            }, $items);
            db('users')->insertBatch($sanitized_data);
        }
        
        db()->transComplete();
        
        return db()->transStatus() !== false ? $users : [];

    }
    
      public static function updateCompanyTransactionId($companyId, $transactionId)
    {
        return db('company')
            ->where('id', $companyId)
            ->update(['transaction_id' => $transactionId]);
    }

    public static function getCompanyAndParticipantsByTransaction($transactionId)
    {
        $company = db('company')
            ->where('transaction_id', $transactionId)
            ->get()
            ->getRow();
            
        if (!$company) {
            return null;
        }

        $participants = db('participant')
            ->where('company_id', $company->id)
            ->get()
            ->getResult('array');

        return [
            'company' => $company,
            'participants' => $participants
        ];
    }
    
    public static function getPassword(string $email): ?string
    {
        // Generate new password
        $new_password = self::random();
        
        // Update user's password hash
        $updated = db('users')
            ->where('user_login', $email)
            ->update([
                'hash' => crypt($new_password, salt(32))
            ]);
            
        return $updated ? $new_password : null;
    }
    
    public function updatePaymentStatus(array $participants, string $companyId): bool
    {
        db()->transStart();
        
        // Enable company (using first participant's company ID)
            db('company')
                ->where('id', $companyId)
                ->update(['enabled' => 1]);
    
    
        foreach ($participants as $participant) {
            // Unlock user account
            db('users')
                ->where('user_login', $participant['email'])
                ->update(['locked' => 0]);
        }
            
        db()->transComplete();
        
        return db()->transStatus() !== false;
    }


    public static function deleteRegistration(array $participants): bool
    {
        if (empty($participants)) {
            return false;
        }

        db()->transStart();

        try {
            // Get all participant emails
            $emails = array_column($participants, 'email');
            
            // Delete users
            db('users')
                ->whereIn('user_login', $emails)
                ->delete();

            // Delete participants
            $participant_ids = array_column($participants, 'email');
            if (!empty($participant_ids)) {
                db('participant')
                    ->whereIn('email', $participant_ids)
                    ->delete();
            }

            // Delete company
            if (!empty($participants[0]['company_id'])) {
                db('company')
                    ->where('id', $participants[0]['company_id'])
                    ->delete();
            }

            db()->transComplete();
            return db()->transStatus() !== false;

        } catch (\Exception $e) {
            log_message('error', 'Error deleting registration: ' . $e->getMessage());
            return false;
        }
    }
    
    public static function listEnabledParticipants()
    {
        $current_user_email = get_user_info('user_email');
        
        // First get current user's company_id
        $current_user = db('participant')
            ->select('company_id')
            ->where('email', $current_user_email)
            ->get()
            ->getRow();
      
        
        return db('participant p')
            ->select('p.*, c.name as company_name, c.phone as company_phone, s.name as sector_name')
            ->join('company c', 'c.id = p.company_id')
            ->join('sector s', 's.id = c.sector_id')
            ->where('c.enabled', 1)
            ->where('p.email !=', $current_user_email)
            ->where('p.company_id !=', $current_user->company_id)  // Exclude same company
            ->orderBy('c.name', 'ASC')
            ->orderBy('p.nom', 'ASC')
            ->orderBy('p.prenom', 'ASC')
            ->get()
            ->getResult();
    }


    public static function modifier($participantCode = null,array $data = []): bool
    {
        $data = self::sanitize_for('participant', $data);
        $data['status'] = $_POST['status'];
        $data['updated_by'] = get_user_info('user_id');
        return db('participant')
            ->where('code', $participantCode)
            ->update($data);
    }

    public static function allPending()
    {
        if ($rs = db('participant')
            ->join('participant_status','participant_status.status_id = participant.status','left')
            ->where('participant.status', 0)
            ->get())
        {
            return $rs->getResult();
        }
    }

    public static function allValid()
    {
        if($rs = db('participant')
            ->join('participant_status','participant_status.status_id = participant.status','left')
            ->where('participant.status', 1)
            ->get()) {
            return $rs->getResult();
        }
    }

    public static function allRejected()
    {
        if($rs = db('participant')
            ->join('participant_status','participant_status.status_id = participant.status','left')
            ->where('participant.status', 2)
            ->get()){
            return $rs->getResult();
        }
    }

    public static function lister($args = [])
    {
        if($rs = db('participant')
            ->join('participant_status','participant_status.status_id = participant.status','left')
            ->orderBy('created_at', 'DESC')
            ->get()){
            return $rs->getResult();
        }
    }

    public static function trouver($participantId, $args = [])
    {
        if($rs = db('participant')
            ->select('*')
            ->where('id', $participantId)
            ->get()){
            return $rs->getRow();
        }
        return false;
    }


    public static function trouverEmail($participantCode, $args = [])
    {
        if($rs = db('participant')
            ->select('email, is_membre')
            ->where('code', $participantCode)
            ->get()){
                return $rs->getRow();
            }
        return false;
    }

    private static function random($length=12)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    }

}