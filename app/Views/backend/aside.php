<?php
if (empty($aside)):
    $role = get_user_info('role_code');
    $file_to_include = "backend/aside/{$role}.php";
    if (is_file("{$module_path}views/aside/index.php")) {
        $aside = view('aside/index.php', []);
    } elseif (file_exists(platform_slashes(APPPATH . "Views/$file_to_include"))) {
        $aside = view($file_to_include, []);
    } else {
        $aside = view('backend/aside/default.php');
    }
endif;
?>
