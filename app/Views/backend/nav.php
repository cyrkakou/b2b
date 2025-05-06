<?php
if(empty($nav)):
    $nav = get_user_info('role_code');
    $file_to_include = "nav/{$nav}.php";
    if (is_file("{$module_path}views/nav/index.php")) {
        $this->load->view('nav/index.php');
    } elseif (file_exists(platform_slashes(APPPATH."views/backend/$file_to_include"))) {
        include_once($file_to_include);
    } else {
        include_once('nav/default.php');
    }
elseif(@$nav!=false):
else:
    echo $nav;
endif;
?>
