<?php
namespace App\Modules\Module1\Controllers;

class Test extends \CodeIgniter\Controller
{
    public function index()
    {
        $json_string = json_encode($_POST);
$file_handle = fopen('my_filename.json', 'w');
fwrite($file_handle, $json_string);
fclose($file_handle);
 http_response_code(200);
    }
    public function show()
    {
        echo 'Hello show!';
    }    
}
?>