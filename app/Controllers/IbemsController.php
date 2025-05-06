<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Menu;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class IbemsController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];
    protected static $_data = [];
    protected static $breadcrumb = [];
    protected $module_path;
    protected $module;
    protected $class;
    /**
     * Constructor.
     */
    public function __construct(...$params)
    {
        $this->helpers = ['ibems','database','user','menu','pages','devkit'];
        helper($this->helpers);
        $this->session = \Config\Services::session();
        $router = \Config\Services::router();
        $_method = $router->methodName();

        $_controller = str_replace('\\', DIRECTORY_SEPARATOR, $router->controllerName());
        $path = explode('Controllers',($_controller));

        $this->module_path = str_replace('App','app',(trim(reset($path),'\/')));

        $this->module_path = str_replace('\\','/',$this->module_path);

        $this->module = basename($this->module_path);
        $this->class = strtolower(basename($_controller));



        //language files
        $locale = service('request')->getLocale();
        $module_lang = platform_slashes("{$this->module_path}/language/{$locale}/{$this->module}_lang.php");
        if (file_exists($module_lang)) {
            include_once($module_lang);
        }
        $class_lang = platform_slashes("{$this->module_path}/language/{$locale}/{$this->class}_lang.php");
        if (file_exists($class_lang)) {
            include_once($class_lang);
        }
        //javascript files

        $js_module = $this->module_path.'/assets/js/'.strtolower($this->module).'.js';
        if (file_exists($js_module)) {
            add_js(null,$js_module,[],true);
        }
        $js_class = $this->module_path.'/assets/js/controllers/'.$this->class.'.js';
        if (file_exists($js_class)) {
            add_js(null,$js_class,[],true);
        }
        //css files
        $css_module = platform_slashes($this->module_path."/assets/css/{$this->module}.css");
        if (file_exists($css_module)) {
            add_css(null,$css_module,[],true);
        }
        $css_class = platform_slashes($this->module_path."/assets/css/controllers/{$this->class}.css");
        if (file_exists($css_class)) {
            add_css(null,$css_class,[],true);
        }



        self::set_data('module_path', $this->module_path);
        self::set_data('module_base', $this->module_path);
        self::set_data('config', self::config());


    }
    /*
     *     public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
        {
            die('12');
            // Do Not Edit This Line
            parent::initController($request, $response, $logger);
            helper($this->helpers);
            $this->config = 12;

            // Preload any models, libraries, etc, here.

            // E.g.: $this->session = \Config\Services::session();
        }
     */
    public function get_instance(){
        return( $this );
    }
    public static function set_data(string $key, $value)
    {
        self::$_data[$key] = $value;
    }
    public static function add_data(string $key, $data)
    {
        $html = '';
        if(!isset(self::$_data[$key])) self::$_data[$key] = '';
        if (is_array($data)){
            foreach ($data as $k=>$v) $html.=$v;
        }else{
            $html = $data;
        }
        return (self::$_data[$key].=$html);
    }
    public static function get_data($key = '')
    {
        return (empty($key)?self::$_data:@self::$_data[$key]);
    }
    //
    public static function set_crumb($value = [])
    {
        self::$breadcrumb = $value;
    }
    public static function add_crumb($value = [],$update = true)
    {
        self::$breadcrumb[] = $value;
        if($update){
            self::set_data('breadcrumb', self::$breadcrumb);
        }
    }
    public static function breadcrumb()
    {
        return (self::$breadcrumb);
    }
    public static function config(string $key = null, mixed $value = null) {
        $data = [];
        if(is_null($value))
        {
            $rs = db('config')
                ->orderBy("meta_group", "asc")
                ->orderBy("meta_key", "asc")
                ->get()
                ->getResult();
            foreach($rs as $k=>$v)
            {
                $data[$v->meta_key] = $v->meta_value;
            }
            return is_null($key) ? @(object)$data : @$data->$key;
        }else{
            $data['meta_key'] = $key;
            $data['meta_value'] = $value;
            $rs = @db('config')->replace($data);
        }
    }
}
