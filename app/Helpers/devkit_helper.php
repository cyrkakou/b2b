<?php
if (!function_exists('vd'))
{
    function vd($variable = null) {
        print_r($variable);
        die();
    }
}
if (!function_exists('qd'))
{
    function qd(mixed $variable = null) {
        print_r(db()->getLastQuery());
        die();
    }
}
