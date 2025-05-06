<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
/*
|--------------------------------------------------------------------------
| USER DEFINED
|--------------------------------------------------------------------------
|
*/
define('LATITUDE',5.3602164);
define('LONGITUDE',-3.9674370999999837);
define('SPECIMEN','SPECIMEN');
define('SERVER','TEST');
if($_SERVER['SCRIPT_NAME']=='spark'){
    define('DB_HOST','localhost');
    define('DB_NAME','geopromo');
    define('DB_USER_ID','root');
    define('DB_USER_PWD','');
    define('BASE_URL','http://localhost:8080/');
    return;
}
define('HTTP',((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'))? 'https://' : 'http://');
define('WWW',(strpos(@$_SERVER['HTTP_HOST'], "www")!== false)?'www.':'');
define('DOMAIN_NAME',preg_replace('/www\./i', '', $_SERVER['SERVER_NAME']));
define('HTTP_HOST',str_replace('','',@$_SERVER['HTTP_HOST']));
define('ADMIN_EMAIL',"jitender2@tekshapers.com");
define('ADMIN_NAME',"Admin");
define('API_KEY','A4646gth5674');
define('LOCALHOST','localhost');
    //'http://localhost:8080/'

if((DOMAIN_NAME==LOCALHOST || DOMAIN_NAME=='127.0.0.1') && HTTP_HOST!=LOCALHOST){
    define('DB_HOST','localhost');
    define('DB_NAME','sara');
    define('DB_USER_ID','root');
    define('DB_USER_PWD','');
    define('BASE_URL',HTTP.HTTP_HOST);
}elseif(HTTP_HOST!=WWW.DOMAIN_NAME || DOMAIN_NAME==LOCALHOST || DOMAIN_NAME=='127.0.0.1')
{
    define('DB_HOST','localhost');
    define('DB_NAME','sara');
    define('DB_USER_ID','root');
    define('DB_USER_PWD','');
    define('BASE_URL',HTTP.DOMAIN_NAME.'/sara/');

}elseif(SERVER == 'PRODUCTION'){
    define('DB_HOST','localhost');
    define('DB_NAME','u438288564_aita');
    define('DB_USER_ID','u438288564_aita');
    define('DB_USER_PWD','x$T6GWD/v?t');
    define('BASE_URL',HTTP.HTTP_HOST);
}elseif(SERVER == 'TEST'){
    define('DB_HOST','localhost');
    define('DB_NAME','u438288564_aita');
    define('DB_USER_ID','u438288564_aita');
    define('DB_USER_PWD','x$T6GWD/v?t');
    define('BASE_URL',HTTP.HTTP_HOST);
}
