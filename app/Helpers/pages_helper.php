<?php
if (!function_exists('get_body_class')) {
    function get_body_class($class ='', $args = [])
    {
        $default = 'header-fixed header-tablet-and-mobile-fixed';
        switch(strtolower(get_user_info('role_code')))
        {
            case 'admin':
                $class.='aside-enabled aside-fixed aside-minimize-hoverable';
                break;
            case 'client':
                $class.='';
                break;
            case 'agent':
                $class.='';
                break;
            case 'annonceur':
                $class.='';
                break;
            default:;
                $class.='aside-enabled aside-fixed aside-minimize-hoverable';
                break;
        }
        return $default.$class;
    }
}
?>
