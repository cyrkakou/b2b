<?php
namespace App\Libraries;
class Menu
{
    protected static $CI;
    private static $__items = [];
    public function  __construct($params = [])
    {

    }
    public static function add_item($args = []){
        self::$__items[] = $args;
    }
    public static function get_items(){
        return self::$__items;
    }
    public static function open($menuitems = [], $controllers = null, $class = 'menu-item-open'){

    }
    public static function active($menuitem, $trigger = null, $class = 'menu-item-active'):string{
        if(strpos(current_url(), trim($menuitem,'/')))
        {
            return $class;
        }
        return '';
    }

}
?>
