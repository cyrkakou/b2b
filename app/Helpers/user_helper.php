<?php
/**
 * CodeIgniter
 *
 * @package	CodeIgniter
 * @author	Kakou Cyr Leonce Anicet
 * @copyright Copyright (c) 2015, Ibems, Inc.
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://www.ibems.com
 * @since	Version 1.0.0
 * @filesource
 */
if (!function_exists('goto'))
{
    function to($uri = '', $method = 'auto', $code = NULL)
{
    if ( ! preg_match('#^(\w+:)?//#i', $uri))
    {
        $uri = site_url($uri);
    }

    // IIS environment likely? Use 'refresh' for better compatibility
    if ($method === 'auto' && isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== FALSE)
    {
        $method = 'refresh';
    }
    elseif ($method !== 'refresh' && (empty($code) OR ! is_numeric($code)))
    {
        if (isset($_SERVER['SERVER_PROTOCOL'], $_SERVER['REQUEST_METHOD']) && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1')
        {
            $code = ($_SERVER['REQUEST_METHOD'] !== 'GET')
                ? 303	// reference: http://en.wikipedia.org/wiki/Post/Redirect/Get
                : 307;
        }
        else
        {
            $code = 302;
        }
    }

    switch ($method)
    {
        case 'refresh':
            header('Refresh:0;url='.$uri);
            break;
        default:
            header('Location: '.$uri, TRUE, $code);
            break;
    }
    exit;
}
}

/*
| -------------------------------------------------------------------
|  USERS
| -------------------------------------------------------------------
*/
if (!function_exists('get_user_info'))
{
    function get_user_info($key = null) {
        $session = \Config\Services::session();
        return (is_null($key))?$session->user:@$session->user->{$key};
    }
}


/* Générer un identifiant unique */
if (!function_exists('salt')) {
    function salt(int $length = 12,int $rounds = 5000,string $private = 'TEK@sunnyv75'):string {
        $salt = substr(uniqid(bin2hex(openssl_random_pseudo_bytes(16)).'-'.$private,true),0,$length);
        return sprintf('$6$rounds=%d$%s$', $rounds, $salt);
    }
}
if (!function_exists('identifier')) {
    function identifier($length = 10) {
        $key = bin2hex(openssl_random_pseudo_bytes($length));
        return ($key);
    }
}
if (!function_exists('uiid')) {

    /**
     * uiid generate an UIID based on giving length
     *
     * @param int $length
     * @return string
     */
    function uiid(int $length = 10):string
    {
        return join('-', str_split(bin2hex(openssl_random_pseudo_bytes(10)), 4));
    }
}

if (!function_exists('pin')) {
    /**
     * pin generate a pin code based on giving length
     *
     * Add a file in the js_to_load array.
     *
     * @param  int  $length pin length

     */
    function pin(int $length = 6):int
    {
        return
            str_pad(
                mt_rand(pow(10, $length - 1) - 1, pow(10, $length) - 1),
                '0',STR_PAD_LEFT
            );
    }
}
if (!function_exists('token'))
{
    /**
     * token generate a token using a private key
     *
     * Add a file in the js_to_load array.
     *
     * @param  string  $private private key

     */
    function token(string $private = 'TEK@sunnyv75'):string
    {
        $crypt = bin2hex(openssl_random_pseudo_bytes(16));
        return password_hash($crypt.'-'.$private,1);
    }
}

/*
| -------------------------------------------------------------------
|  SECURITE
| -------------------------------------------------------------------
*/
//protection par droit d'acces
if (!function_exists('has_role')) {
    function has_role(array $the_role = []):bool
    {
        $role = strtolower(session()->user->role_code);
        if (is_array($the_role)){
            if(!in_array($role,$the_role)) return false;
        } else {
            if($the_role!=$role) return false;
        }
        return true;
    }
}
//protection par mot de passe
if (!function_exists('is_protected')) {
    function is_protected($roles = null) {
        $session = session();
        $config = config('config');
        $route = trim(service('router')->controllerName(),'\/');
        if (!$session->has('hash')) {
            to(site_url());
        } else {

        }
        if(!is_null($roles)){
            if(!has_role($roles))to(site_url());
        }
        //checking module credential
        if ($credential = @$config->credential[strtolower($route)]){
            if(!has_role($credential))to(site_url());
        }
        //checking class credential
        if ($credential = @$config->credential[strtolower($route)]){
            if(!has_role($credential))to(site_url());
        }
    }
}
//protection par permission
if (!function_exists('user_can')) {
    function user_can($permissions)
    {
        $session = session();
        if (!$session->has('hash')) {
            to(site_url());
        }
        $trigger = strtolower(basename(service('router')->controllerName()));
        $role = strtolower($session->user->role_code);
        $strategies = @$session->user->strategies[$trigger][$permissions];
        if ($role=='root') return true;
        if (empty($strategies)) return false;
        return ($strategies!=1) ? false : true;
    }
}
if (!function_exists('get_role')) {
    function get_role(string $code):int
    {
        if($rs = db('users_roles')
                ->select('role_id')
                ->where('role_code',htmlspecialchars ($code))
                ->get()){
            return $rs->getRow()->role_id;
        }
        return false;
    }
}
//
?>
