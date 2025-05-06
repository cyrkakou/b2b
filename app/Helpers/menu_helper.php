<?php
if (! function_exists('url')) {

    function url(string $url): string
    {
        return base_url($url).'/';
    }
}
if (! function_exists('menu')) {

    function menu(): object
    {
        return service('menu');
    }
}
?>
