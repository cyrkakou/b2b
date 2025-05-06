<?php

namespace Config;

use CodeIgniter\Config\BaseConfig ;

class Config extends BaseConfig 
{
    /**
     * Parser Filters map a filter name with any PHP callable. When the
     * Parser prepares a variable for display, it will chain it
     * through the filters in the order defined, inserting any parameters.
     * To prevent potential abuse, all filters MUST be defined here
     * in order for them to be available for use within the Parser.
     *
     * Examples:
     *  { title|esc(js) }
     *  { created_on|date(Y-m-d)|esc(attr) }
     *
     * @var array
     */
    public $css_files = [];
    public $js_files = [];
    public $top_js_files = [];
    public $bottom_js_files = [];    
    
    public function __construct(){
        
    }
}
