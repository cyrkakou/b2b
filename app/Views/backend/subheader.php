<?php
if(@$subheader!==false)
{
    if (!empty(@$subheader))
    {
        $header_file = "backend/subheader/{$subheader}.php";
        if (file_exists(platform_slashes(APPPATH.'/views/'.$header_file))) {
            echo view($header_file);
        }
    } else{
        echo view('backend/subheader/default.php');
    }
}
?>
