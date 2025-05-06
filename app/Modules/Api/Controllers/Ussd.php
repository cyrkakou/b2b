<?php
namespace App\Modules\Api\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Controllers\IbemsController;
use CodeIgniter\I18n\Time;

class Ussd extends ResourceController
{
    private $session;

    public function __construct()
    {
        $ci = new IbemsController();
        $this->session = $ci->session;
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
   public function index()
{
    helper('filesystem');

    // Ensure writable/inputs exists
    $dir = WRITEPATH . 'inputs/';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    
     // Extract inputs
   

    // Log incoming request
    $logData = [
        'get'     => $this->request->getGet(),
        'post'    => $this->request->getPost(),
        'headers' => $this->request->getHeaders(),
        'ici' => $this->request->getHeaderLine('user_entry'),
        'body'    => $this->request->getBody(),
        'method'  => $this->request->getMethod(),
        'ip'      => $this->request->getIPAddress(),
        'uri'     => current_url(),
        'payment_ref' => $ref,
        'test' => $this->request->getPost()['user-entry'],
        'payment_method' => $method,
        'date'           => Time::now()->toDateTimeString()
        
    ];
    write_file($dir . 'input.txt', json_encode($logData, JSON_UNESCAPED_SLASHES) . PHP_EOL, 'a');

   $body = $this->request->getBody();
$data = json_decode($body, true);

// Access the user-entry value
$userEntry = $data['user-entry'] ?? $this->request->getGet('payment_ref');
    $method = $this->request->getGet('payment_method');

    // USSD screen logic
    if ($userEntry === null) {
        
        $payload =
        [
            'page'    => ['menu' => true, 'history' => true],
            'title'   => 'Bienvenue',
            'message' => 'Saisissez votre référence :',
            'form'    => [
                'url'  => current_url(),
                'type' => 'alphanum',
                "method"=> "post",
                "input"=> 'payment_ref',
                'tag' => 'payment_ref1',
                'width'=> 7
            ]
        ];
    }elseif ($method === null) {
        $methods = [
            ['name' => 'Orange Money', 'code' => 'OM'],
            ['name' => 'Wave Money', 'code' => 'WAVE']
        ];
        $links = array_map(function($m) use ($userEntry) {
            return [
                'content'   => $m['name'],
                'url'       => current_url() . '?payment_ref=' . urlencode($userEntry) . '&payment_method=' . $m['code'],
                'tag'       => $m['code'],
                'all_pages' => false
            ];
        }, $methods);

        $payload = [
            'page'    => ['menu' => true, 'history' => true],
            'title'   => 'Mode de paiement',
            'message' => 'Choisissez :',
            'links'   => $links
        ];
    } else {
        $payload = [
            'page'    => ['menu' => false, 'session_end' => true],
            'title'   => 'Confirmation',
            'message' => "Référence : $userEntry\nPaiement via $method reçu.",
        ];
    }

    // Send JSON with Myriad headers
    return $this->response
        ->setStatusCode(200)
        ->setHeader('Content-Type', 'application/json')
        ->setHeader('Sid', '9a289d56-a3ef-34df-beef-3f6e56c7c5f1')
        ->setHeader('Auth', 'LU+Z8Tdm0S/xG4A0PSM/Rd45g3Wincfv5LvnaFZ6DzduQ54yYH40tR75IpX9ObmPZ4uvQsTWZDuGHs3JDEUvXM0IpjdEcg8vcD0yKaeaV9soI9VP8heSWMcDa+D26mXq2YakZ/rXzpHC3DRAwyfl87GiX4ue0o4jJ2LJkSMfWDCIlCE7xOLF+v3zJ0/yy5WoiBP8Vf28bs6D3DD4kAaeo8l+obqEFTTPYdk5q5i45aNbaZ5m9Qfq8LM21lA3K1iD9iXpJmFYN5eC0Ho7d1S1XRkwjh73/6c+3HMCqDuLjGGtO4DtXsT3U9irTQPkuwk28nEAJjolCjY19scgRRlxQQ==')
        ->setJSON($payload);
}


    private function getToken(string $sid, string $auth)
    {
        // Your token generation logic here
    }

    /**
     * Creates a new resource.
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function create()
{
    // Get JSON data from the request body
    $data = $this->request->getJSON();

    // Get query parameters (e.g., msisdn)
    $queryParams = $this->request->getGet();
    $msisdn = $this->request->getGet('msisdn');  // Getting 'msisdn' from query parameters

    // Get 'sid' and 'auth' headers
    $sidHeader = $this->request->getHeader('sid');
    $sid = $sidHeader ? $sidHeader->getValue() : null;  // Default to null if not found

    $authHeader = $this->request->getHeader('auth');
    $auth = $authHeader ? $authHeader->getValue() : null;  // Default to null if not found

    $input = $this->request->getGet('user_entry');
    $method = $this->request->getGet('method');
        
          $filePath = WRITEPATH . 'inputs/input.txt'; // WRITEPATH is CI4 constant to 'writable/' directory
    helper('filesystem'); // Load file helper (optional, but good practice)

    write_file($filePath, $input . PHP_EOL, 'a'); // Append input with newline

        // 1) If no input → ask for reference
        if ($input === NULL) {
            return $this->respond([
                'title'   => 'Paiement',
                'message' => 'Entrez votre référence :',
                'form'    => [
                    'url'  => current_url(),
                    'type' => 'alphanum',
                    'tag'  => 'payment_ref',
                    'width'=> 16
                ]
            ]);
        }

    // Prepare the response
    $response = [
        'status' => 201,
        'error' => null,
        'messages' => "USSD entry created successfully",
        'data' => [
            'msisdn' => $msisdn,
            'Authorization' => $auth,
            'sid' => $sid,
            'queryParams' => $queryParams,
            'jsonData' => $data
        ]
    ];

    // Return a created response with status 201
    return $this->respondCreated($response); // Sends a 201 HTTP status for created resource
}

}
?>