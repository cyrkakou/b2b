<?php

namespace App\Modules\Api\Models;

use App\Controllers\IbemsModel;

class UserModel extends IbemsModel
{
    public static function ajouter(array $args = []):bool{

        $mobile = request()->getVar("user_phone");
        $password = request()->getVar("user_password");
        $args['added_by'] = get_user_info('user_id');
        $args['user_registered'] = time();
        $data = self::sanitize_for('users',$args);


        db()->transStart();






        $data['user_phone'] = str_replace(['-',' '],['',''],$mobile);
        $data['identifier'] = identifier(16);
        $data['hash'] = crypt($password,salt(32));
        db('users')->insert($data);
        db()->transComplete();
        return db()->transStatus() !== false;
    }
    public static function account(array $args = []):bool{

        if(!isset($args['user_phone'])) die('telephone obligatoire');
        if(!isset($args['user_password'])) die('password obligatoire');
        $mobile = $args['user_phone'];
        $password = $args['user_password'];
        $args['added_by'] = get_user_info('user_id');
        $args['user_registered'] = time();
        $data = self::sanitize_for('users',$args);

        db()->transStart();


        $data['user_phone'] = str_replace(['-',' '],['',''],$mobile);
        $data['identifier'] = identifier(16);
        $data['hash'] = crypt($password,salt(32));
        db('users')->insert($data);
        db()->transComplete();
        return db()->transStatus() !== false;
    }
    public static function modifier($user_id, array $args = []):bool{
        $mobile = request()->getVar("user_phone");
        $password = request()->getVar("user_password");
        db()->transStart();
        $args['modified'] = time();
        $args['modified_by'] = get_user_info('user_id');
        $data = self::sanitize_for('users',$args);
        if (!empty($mobile)){
            $data['user_phone'] = str_replace(['-',' '],['',''],$mobile);
        }
        if (!empty($password)){
            $data['hash'] = crypt($password,salt(32));
        }
        db('users')
            ->where('user_id', intval($user_id))
            ->update($data);
        db()->transComplete();
        return db()->transStatus() !== false;
    }
    public static function trouver(int $primary_key)
    {
        if($rs =  db('users')
            ->where('user_id',intval($primary_key))
            ->get()
        ){
            return $rs->getRow();
        }
        return false;
    }
    public static function supprimer( $primary_keys):bool{
        if(is_array($primary_keys)){
            return db('users')
                ->whereIn('user_id',$primary_keys)
                ->delete();;
        }else{
            return db('users')
                ->where('user_id',intval($primary_keys))
                ->delete();;
        }
    }

    public static function is_user(string $login, string $password)
    {
        $db      = \Config\Database::connect();
        $builder =
            $db->table('users')
                ->select('*')
                ->join('users_roles','users_roles.role_id = users.role_id')
                ->where("user_login", $login)
                ->orWhere("user_email", $login)
                ->orWhere("user_phone", $login)
                ->get();
        if($builder->getNumRows()){
            $row = $builder->getRow();
            if (hash_equals($row->hash, crypt($password, $row->hash))){
                return $row;
            }
        }
        return false;
    }
    public static function check_user(string $email, string $phone):bool
    {
            $rs = db('users')
                ->select('*')
                ->where("user_email", $email)
                ->orWhere("user_phone", $phone)
                ->get();
        return ($rs->getNumRows() > 0);
    }

    public static function password_change(int $userID,string $password):bool {
        if(intval($userID)<=0) return false;
        if(empty($password)) return false;
        return db('users')
            ->where('user_id',$userID)
            ->update([
                'hash'=>crypt($password,salt(32))
            ]);
    }
}
