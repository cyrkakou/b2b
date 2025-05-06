<?php
if ( ! function_exists('request'))
{
    function request()
    {
        return \Config\Services::request();
    }
}
/*
| -------------------------------------------------------------------
|  DIRECTORY SHORTCUT
| -------------------------------------------------------------------
*/
if (!function_exists('platform_slashes')) {
    function platform_slashes($path) {
        if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
            $path = str_replace('/', DIRECTORY_SEPARATOR, $path);
        }
        return $path;
    }
}
if ( ! function_exists('plugins_js'))
{
    function plugins_js(string $filename = ''):string
    {
        return base_url('assets/plugins/').'/'.$filename;
    }
}
if ( ! function_exists('assets_js'))
{
    function assets_js(string $filename = ''):string
    {
        return base_url('assets/js/').'/'.$filename;
    }
}
if ( ! function_exists('module_dir'))
{
    function module_dir():string
    {
        $router = \Config\Services::router();
        $_method = $router->methodName();
        $_controller = $router->controllerName();
        $path = explode('Controllers',($_controller));
        return trim(str_replace('App', 'app', reset($path)),'\/');
    }
}
if ( ! function_exists('controller'))
{
    function controller(string $method = ''):string
    {
        $router = \Config\Services::router();
        $_controller = $router->controllerName();

        return $_controller;
    }
}
//
if (!function_exists('trim_space')) {
    function trim_space($string)
    {
        return preg_replace('/\s+/', '', $string);
    }
}
if (!function_exists('thousand')) {
    function thousand($number,array $args = []) {
        return number_format(intval($number),0,'.',' ');
    }
}
/*
| -------------------------------------------------------------------
|  JS AND CSS ON RUNTIME
| -------------------------------------------------------------------
*/
if ( ! function_exists('add_css'))
{
    /**
     * add_css
     *
     * Add a file in the css_to_load array.
     *
     * @param   string  $src path to file

     */
    function add_css($handle, $src, $options = [])
    {
        if(is_null($handle)||empty($handle)) $handle = 'id_'.uniqid(md5(rand()));
        if (empty($src)){return false;}
        $config = Config('Config');
        $options['id'] = $handle;
        $options['src'] = $src;
        $css_to_load  = $config->css_files;
        $css_to_load[] = $options;
        $config->css_files = $css_to_load;
    }
}
if(!function_exists('load_css')){
    function load_css()
    {
        $config = Config('Config');
        $str = '';    
        if (is_array($config->css_files)){
            foreach($config->css_files AS $properties)
            {
                $id = (isset($properties['id']))?'id="'.$properties['id'].'"':'';
                $url = parse_url($properties['src']);
                $src = $properties['src'];
                if((@$url['scheme']!= 'https')&&(@$url['scheme']!= 'https'))
                {
                    $src = base_url($properties['src']);
                }
                $str .= "<link {$id} href=\"$src\" rel=\"stylesheet\" type=\"text/css\" />\n";
            }
        }
        return $str;
    }
}
if (!function_exists('add_js'))
{
    /**
     * add_js
     *
     * Add a file in the js_to_load array.
     *
     * @param   string  $src path to file

     */
    function add_js($handle, $src, $options = [],$media = false)
    {
        $config = Config('Config');
        if(is_null($handle)||empty($handle)) $handle = 'id_'.uniqid(md5(rand()));
        $options['id'] = $handle;
        $options['src'] = $src;
        $js_files  = $config->js_files;
        $js_files[] = $options;
        $config->js_files = $js_files;
        if(!$media)
        {
            $bottom_js_files  = $config->bottom_js_files;
            $bottom_js_files[] = $options;
            $config->bottom_js_files = $bottom_js_files;
        } else {
            $top_js_files  = $config->top_js_files;
            $top_js_files[] = $options;
            $config->top_js_files = $top_js_files;
        }
    }
    function add_module_js($handle, $src, $options = [],$media = false)
    {
        $src = platform_slashes(module_dir()."/assets/js/{$src}?t=".time());
        add_js($handle, $src, $options = [],$media = false);
    }
}
if(!function_exists('load_js')){
    function load_js($media = false)
    {
        $config = Config('Config');
        $str = '';
        $files = (!$media)?$config->bottom_js_files:$config->top_js_files;
        if (is_array($files)){
            foreach($files AS $properties)
            {
                $id = (isset($properties['id']))?'id="'.$properties['id'].'"':'';
                $url = parse_url($properties['src']);
                $src = $properties['src'];
                if((@$url['scheme']!= 'https')&&(@$url['scheme']!= 'https'))
                {
                    $src = base_url().'/'.$properties['src'];
                }
                $str .= '<script '.$id.' src="'.$src.'" type="text/javascript"></script>'."\n";
            }
        }
        return $str;
    }
}
/*
| -------------------------------------------------------------------
|  FORM
| -------------------------------------------------------------------
*/
if(!function_exists('isPostBack')){
    function isPostBack($trigger = '')
    {
        if(strtoupper($_SERVER['REQUEST_METHOD'])=='POST') return true;
        if(count($_POST) > 0) return true;
        if(!empty($trigger)&&!array_key_exists($trigger,$_POST)) return false;
        return false;
    }
}
/*
| -------------------------------------------------------------------
|  DROPDOWN
| -------------------------------------------------------------------
*/
function is_json(mixed $string):bool {
    if(empty($string)) return false;
    json_decode($string,true,JSON_NUMERIC_CHECK );
    return json_last_error() === JSON_ERROR_NONE;
}
if(!function_exists('dropDown')){
    function dropDown(string $sql,array $options = [],bool $utf8 = true)
    {
        $query = db()->query($sql);
        $timestamp = bin2hex(openssl_random_pseudo_bytes(16));
        $opt = array(
            'name'=>"name_{$timestamp}",
            'id'=>"id_{$timestamp}",
            'class'=>'select',
            'attr'=>'',
            'selected'=>''
        );
        $opt = array_merge($opt, $options);
        $name  = $opt['name'];
        $id    = $opt['id'];
        $class = $opt['class'];
        $attr  = $opt['attr'];
        $choice= $opt['selected'];
        $blank = @$opt['blank'];
        $blank = @explode('|',$blank);
        if(is_array($blank)){
            $blank_value = reset($blank);
            $blank_text = end($blank);
        }else{
            $blank_value = '';
            $blank_text = $blank;
        }

        $js_choice = @json_decode($choice);
        $rows  = $query->getResultArray();
        $fields = @array_keys($rows[0]);
        if(count($fields)<=1)$fields[1] = $fields[0];
        echo "<select name=\"$name\" id=\"$id\" class=\"$class\" $attr>";
        if(!empty($blank_text)){
            echo '<option value="'.$blank_value.'">'.$blank_text.'</option>';
        }
        foreach ($rows as $keys => $values)
        {
            $selected = 'selected="selected"';
            if(is_array($choice)){
                if(!in_array($values[$fields[0]], $choice))$selected = '';
            }elseif($values[$fields[0]]!=$choice){
                $selected = '';
            }elseif(is_json($choice)){
                //if(!in_array($values[$fields[0]], $js_choice))$selected = '';
            }
            $value_enc = strtolower(mb_detect_encoding($values[$fields[0]]));
            $text_enc = strtolower(mb_detect_encoding($values[$fields[1]]));
            $value = (in_array($value_enc,array('utf-8')))?$values[$fields[0]]:utf8_decode($values[$fields[0]]);
            $text = (in_array($text_enc,array('utf-8')))?$values[$fields[1]]:utf8_decode($values[$fields[1]]);
            echo "<option value=\"".trim($value)."\" {$selected}>".trim($text)."</option>";
        }
        echo '</select>';
    }
}
if(!function_exists('dropChained')){
    function dropChained($sql, $options = [],$utf8 = true)
    {
        $query = db()->query($sql);
        if ($query->getNumRows() > 0)
        {
            $timestamp = bin2hex(openssl_random_pseudo_bytes(16));
            $opt = array(
                'name'=>"name_{$timestamp}",
                'id'=>"id_{$timestamp}",
                'class'=>'select',
                'attr'=>'',
                'selected'=>''
            );
            $opt = array_merge($opt, $options);
            $name  = $opt['name'];
            $id    = $opt['id'];
            $class = $opt['class'];
            $attr  = $opt['attr'];
            $choice= $opt['selected'];
            $js_choice = @json_decode($choice);
            $rows  = $query->getResultArray();
            $fields = array_keys($rows[0]);
            if(count($fields)<=1)$fields[1] = $fields[0];
            echo "<select name=\"$name\" id=\"$id\" class=\"$class\" $attr>";
            echo "<option></option>";
            foreach ($rows as $keys => $values)
            {
                $selected = 'selected="selected"';
                if(is_json($choice)){
                    if(!in_array($values[$fields[0]], $js_choice))$selected = '';
                }elseif(is_array($choice)){
                    if(!in_array($values[$fields[0]], $choice))$selected = '';
                }elseif($values[$fields[0]]!=$choice){
                    $selected = '';
                }
                $value_enc = strtolower(mb_detect_encoding($values[$fields[0]]));
                $text_enc  = strtolower(mb_detect_encoding($values[$fields[1]]));
                $value = (in_array($value_enc,array('utf-8')))?$values[$fields[0]]:utf8_decode($values[$fields[0]]);
                $text = (in_array($text_enc,array('utf-8')))?$values[$fields[1]]:utf8_decode($values[$fields[1]]);
                $class = $values[$fields[2]];
                echo "<option value=\"{$value}\" data-chained=\"{$class}\" {$selected}>{$text}</option>";
            }
            echo '</select>';
        }
    }
}
if(!function_exists('show_notification')){
    function show_notification()
    {
        $icon = [
            'info'=>'fa fa-info',
            'success'=>'fa fa-check',
            'danger'=>'fa fa-exclamation-triangle',
            'warning'=>'fa fa-exclamation'
        ];
        $title = [
            'info'=>'Information !',
            'success'=>'Bravo !',
            'danger'=>'Erreur',
            'warning'=>'Attention'
        ];
        if($alert = session()->getFlashdata('.php'))
        {
            if(@$alert['type']=='error') @$alert['type']='danger';
            $icon = (isset($alert['icon']))?$alert['icon']:$icon[@$alert['type']];
            $title = (isset($alert['title']))?$alert['title']:$title[@$alert['type']];
            $message = @$alert['message'];
            ?>
            <script>
                $(document).ready(function () {
                    var notify = $.notify(
                        {
                            message :"<?=$message?>",
                            title:"<?=$title?>",
                            icon:'icon <?=$icon?>'
                        }, {
                            type: '<?=@$alert['type']?>',
                            allow_dismiss: true,
                            placement: {from: 'top', align: 'center'},
                            animate: {
                                enter: 'animated bounceIn',
                                exit: 'animated bounceOut'
                            },
                            delay: 2000,
                            z_index: 10000,
                        });
                });
            </script>
            <?php
        }
    }
}
if(!function_exists('swal_notification')){
    function swal_notification()
    {
        $icon = [
            'info'=>'fa fa-info',
            'success'=>'fa fa-check',
            'danger'=>'fa fa-exclamation-triangle',
            'warning'=>'fa fa-exclamation'
        ];
        $title = [
            'info'=>'Information !',
            'success'=>'Bravo !',
            'danger'=>'Erreur',
            'warning'=>'Attention'
        ];
        if(session()->has('response'))
        {
            $response = session()->get('response');
            $title = (isset($response['title']))?$response['title']:$title[@$response['statut']];
            ?>
            <script>
                $(document).ready(function () {
                    swal.fire({
                        title: '<?=@$title?>',
                        text: '<?=@$response['message']?>',
                        icon: '<?=@$response['statut']?>',
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-lg font-weight-bold btn-light-success"
                        }
                    })
                });
            </script>
            <?php
        }
    }
}
if (!function_exists('get_language')) {
    function get_language($language = '') {
      return 'french';
    }
}
/*
| -------------------------------------------------------------------
|  FORMATING
| -------------------------------------------------------------------
*/
if (!function_exists('phoneformat')) {
    function phoneformat(string $phone_number = '',string $country_code = 'CI', $glue = '-'):string
    {
        return implode($glue,str_split($phone_number,2));
    }
}

?>
