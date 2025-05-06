<?php
namespace App\Modules\Ressources\Controllers;
use App\Controllers\IbemsController;
use App\Modules\Api\Models\ParticipantModel;
use App\Modules\Api\Models\SectorModel;
use App\Modules\Api\Models\GoalModel;
use App\Modules\Api\Models\ProfileModel;
use App\Modules\Api\Models\ActivityModel;
use App\Libraries\PayWithCinetpay;
use App\Modules\Api\Models\AppointmentModel;
use App\Modules\Api\Models\AvailabilityModel;

class Participants extends IbemsController {
    protected $participantModel;
    protected $sectorModel;
    protected $activityModel;
    protected $goalModel;
    protected $profileModel;
    protected $payWithCinetpay;
    protected $appointmentModel;
    protected $availabilityModel;

    public function __construct() {
        parent::__construct();
        $this->participantModel = new ParticipantModel();
        $this->sectorModel = new SectorModel();
        $this->activityModel = new ActivityModel();
        $this->goalModel = new GoalModel();
        $this->profileModel = new ProfileModel();
        $this->payWithCinetpay = new PayWithCinetpay();
        $this->appointmentModel = new AppointmentModel();
        $this->availabilityModel = new AvailabilityModel();
    }
    
    public function index(){ 
        
        self::add_crumb(['text'=>'Liste']);
        self::set_data('dataset',$this->participantModel::listEnabledParticipants());
        self::add_data('content', view('App\Modules\Ressources\Views\participants\list', self::get_data()));
        return view('backend/layout',self::get_data());
    }

    public function create() {
       
        $data = [
            'sectors' => $this->sectorModel->lister(),
            'business_lines' => $this->activityModel->lister(),
            'objectives' => $this->goalModel->lister(),
            'profiles' => $this->profileModel->lister()
        ];
    
        self::add_data('content',view('App\Modules\Ressources\Views\participants\create',$data));

        return view('backend/layout.home.php',self::get_data());

    }
    
    public function do_create(){

        if ($this->request->getMethod() === 'post') {
            $data = [];
        
            $rules = [
                'email' => 'required|valid_email',
                'confirm_email' => 'required|matches[email]',
                'firstname' => 'required|min_length[2]',
                'lastname' => 'required|min_length[2]',
                'function' => 'required',
                'mobile' => 'required',
                'company_name' => 'required',
                'company_address' => 'required',
                'city' => 'required',
                'country' => 'required',
                'company_phone' => 'required',
                'website' => 'permit_empty|valid_url',
                'business_line' => 'required',
                'activity_sectors' => 'required',
                'objectives' => 'required',
                'target_profiles' => 'required'
            ];


            $data['validation'] = $this->validator;
        
            //if ($this->validate($rules)) {
                $participantData = [
                    'badge_number' => $this->request->getPost('bagdes') ?? 1,
                    'participants' => $this->request->getPost('participants'),
                    'name' => $this->request->getPost('company_name'),
                    'address' => $this->request->getPost('company_address'),
                    'city' => $this->request->getPost('city'),
                    'country' => $this->request->getPost('country'),
                    'phone' => $this->request->getPost('company_phone'),
                    'website' => $this->request->getPost('website') ?? '',
                    'sector_id' => $this->request->getPost('sector'),
                    'activities' => $this->request->getPost('activities'),
                    'goals' => $this->request->getPost('goals'),
                    'profiles' => $this->request->getPost('profiles'),
                    'created_at' => date('Y-m-d H:i:s')
                ];

                if (!empty ($users = $this->participantModel->ajouter($participantData))) {
                    try {
                        // Generate unique transaction ID
                        $id_transaction = 'SARA' . date("YmdHis");
                        
                        $this->participantModel->updateCompanyTransactionId($users[0]['company_id'], $id_transaction);

                        // Payment amount and details
                        $base_price = 100;
                        $amount = $base_price * $participantData['badge_number'];
                        $currency = 'XOF';
                        
                        $notify_url = base_url('ressources/participants/callback');
                        $return_url = base_url('ressources/participants/return');
                        
                        
                        $formData = array(
                            "transaction_id" => $id_transaction,
                            "amount" => $amount,
                            "currency" => $currency,
                            "customer_surname" => $users[0]['lastname'],
                            "customer_name" => $users[0]['firstname'],
                            "description" => "SARA Participant Registration",
                            "notify_url" => $notify_url,
                            "return_url" => $return_url,
                            "channels" => "ALL"
                        );

                        // Initialize CinetPay and generate payment link
                        $result = $this->payWithCinetpay->generatePaymentLink($formData);
                        
                        if ($result["code"] == '201') {
                            // Redirect to CinetPay payment page
                            return redirect()->to($result["data"]["payment_url"]);
                        } else {
                            // If payment link generation fails, delete the registration
                            $this->participantModel->deleteRegistration($users);
                            session()->remove(['participants', 'payment_transaction_id']);
                            return redirect()->back()->with('error', 'Payment initialization failed. Please try again.');
                        }
                    } catch (\Exception $e) {
                        log_message('error', 'CinetPay Error: ' . $e->getMessage());
                        return redirect()->back()->with('error', 'Payment processing error. Please try again later.');
                    }
                    
                    //return redirect()->to('/participants')->with('success', 'Participant registered successfully. Pending payment confirmation.');
                }
                return redirect()->back()->with('error', 'Failed to register participant. Please try again.');
           // }
        }
    }

    
    public function callback() {
        $log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
                "TransId:".$_POST['cpm_trans_id'].PHP_EOL.
                "SiteId: ".$_POST['cpm_site_id'].PHP_EOL;
        
        // Verify the payment
        $result = $this->payWithCinetpay->verifyPayment($_POST['cpm_trans_id']);
         // Get company by transaction ID and its participants
        $data = $this->participantModel->getCompanyAndParticipantsByTransaction($_POST['cpm_trans_id']);
                
                if (!$data || empty($data['participants'])) {
                    log_message('error', "No data found for transaction: " . $_POST['cpm_trans_id']);
                    return;
                }

        if ($result['code'] == '00') {
            // Payment successful
             try {
               
                // Update payment status in database
                $this->participantModel->updatePaymentStatus($data['participants'], $data['company']->id);

                // Send emails to all participants
                foreach ($data['participants'] as $participant) {
                    $password = $this->participantModel->getPassword($participant['email']);
                    $email = \Config\Services::email();
                    
                    $email->setFrom('noreply@sara.ci', 'SARA 2025');
                    $email->setTo($participant['email']);
                    $email->setSubject('Inscription SARA 2025');
                    
                    $message = "Cher {$participant['firstname']} {$participant['lastname']}<br><br>Nous vous remercions de votre inscription à l'édition 2025 du Salon international de l’Agriculture et des Ressources Animales.<br><br>Voici vos identifiants de connexion:<br>Lien: https://aita.ibemscreative.in/login<br>Nom d'utilisateur: {$participant['email']}<br>Mot de passe: {$password}<br><br>Veuillez modifier votre mot de passe après votre première connexion.<br>Cordialement,<br>L'équipe SARA<br><br>---<br><br><br><br>Dear {$participant['firstname']} {$participant['lastname']}<br><br>Thank you for registering for the 2025 edition of the International Agriculture and Animal Resources Show.<br><br>Here are your login details:<br>Link: https://aita.ibemscreative.in/login<br>Username: {$participant['email']}<br>Password: {$password}<br><br>Please change your password after your first login.<br>Best regards,<br>The SARA Team</p>";
                    
                    $email->setMessage($message);
                    $email->send();
                }
                
                log_message('info', "Payment processed successfully for transaction: " . $_POST['cpm_trans_id']);
                
            } catch (\Exception $e) {
                log_message('error', "Error processing successful payment: " . $e->getMessage());
            }
        } else {
            // Payment failed
            log_message('error', "Payment failed for transaction {$_POST['cpm_trans_id']}: {$result['message']}");
        }
    }

    public function return() {
        $transaction_id = $_POST['transaction_id'];
        $result = $this->payWithCinetpay->verifyPayment($transaction_id);
        
        if ($result['code'] == '00') {
           return redirect()->to('ressources/participants/paymentSuccess?transaction_id=' . $transaction_id);
        } else {
            return redirect()->to('ressources/participants/paymentFailed?transaction_id=' . $transaction_id);
        }
    }

    public function paymentSuccess() {
        $transaction_id = $this->request->getGet('transaction_id');
    
        if ($transaction_id) {
            $data = $this->participantModel->getCompanyAndParticipantsByTransaction($transaction_id);
            if ($data) {
                $data['title'] = 'Paiement réussi';
                $data['message'] = 'Votre inscription a été effectuée avec succès. Veuillez consulter votre boîte mail pour obtenir vos identifiants de connexion.';
                $data['transaction_id'] = $transaction_id;
                
                self::add_data('content', view('App\Modules\Ressources\Views\participants\payment_success', $data));
                return view('backend/layout.home.php', self::get_data());
            }
        }
        return redirect()->to('ressources/participants/create')->with('error', 'Invalid transaction data');
    }

    public function paymentFailed() {
        $transaction_id = $this->request->getGet('transaction_id');
    
        if ($transaction_id) {
            $data = $this->participantModel->getCompanyAndParticipantsByTransaction($transaction_id);
            if ($data) {
                $data['title'] = 'Echec de paiement';
                $data['message'] = 'Votre paiement a échoué. Vous pouvez réessayer le paiement ou annuler votre inscription.';
                $data['transaction_id'] = $transaction_id;
                

                self::add_data('content', view('App\Modules\Ressources\Views\participants\payment_failed', $data));
                return view('backend/layout.home.php', self::get_data());
            }
        }
    
        return redirect()->to('ressources/participants/create')->with('error', 'Invalid transaction data');
}

    public function cancelRegistration() {
        $transaction_id = $this->request->getPost('transaction_id') ?? $this->request->getGet('transaction_id');
        
        if ($transaction_id) {
            $data = $this->participantModel->getCompanyAndParticipantsByTransaction($transaction_id);
            if ($data) {
                $this->participantModel->deleteRegistration($data['participants']);
            }
        }
        
        return redirect()->to('ressources/participants/create')->with('info', 'Registration cancelled successfully');
    }

    public function retryPayment() {
        $transaction_id = $this->request->getPost('transaction_id') ?? $this->request->getGet('transaction_id');
        
        if (!$transaction_id) {
            return redirect()->to('ressources/participants/create')->with('error', 'No registration data found');
        }

        $data = $this->participantModel->getCompanyAndParticipantsByTransaction($transaction_id);
        if (!$data) {
            return redirect()->to('ressources/participants/create')->with('error', 'Registration data not found');
        }
        $participants = $data['participants'];
        try {
            // Generate new transaction ID
            $id_transaction = 'SARA' . date("YmdHis");
            $this->participantModel->updateCompanyTransactionId($data['company']->id, $id_transaction);

            // Calculate payment amount
            $base_price = 100000;
            $amount = $base_price * count($participants);
            $currency = 'XOF';
            
            $notify_url = base_url('participants/callback');
            $return_url = base_url('participants/return');
            
            $formData = array(
                "transaction_id" => $id_transaction,
                "amount" => $amount,
                "currency" => $currency,
                "customer_surname" => $participants[0]['lastname'],
                "customer_name" => $participants[0]['firstname'],
                "description" => "SARA Participant Registration",
                "notify_url" => $notify_url,
                "return_url" => $return_url,
                "channels" => "ALL"
            );

            // Initialize CinetPay and generate payment link
            $result = $this->payWithCinetpay->generatePaymentLink($formData);
            
            if ($result["code"] == '201') {
                // Update transaction ID in session

                // Redirect to CinetPay payment page
                return redirect()->to($result["data"]["payment_url"]);
            } else {
                return redirect()->back()->with('error', 'Payment initialization failed. Please try again.');
            }
        } catch (\Exception $e) {
            log_message('error', 'CinetPay Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Payment processing error. Please try again later.');
        }
    }
    
    public function viewAgenda($participantId = null)
    {
        if (!$participantId) {
            return redirect()->back()->with('error', 'Participant not found');
        }

        $participant = $this->participantModel->trouver($participantId);
        if (!$participant) {
            return redirect()->back()->with('error', 'Participant not found');
        }

        $availability = $this->availabilityModel->getParticipantAvailability($participantId);
        $appointments = $this->appointmentModel->getParticipantAppointments($participantId);

        $data = [
            'participant' => $participant,
            'availability' => $availability,
            'appointments' => $appointments
        ];

        self::add_crumb(['text' => 'View Agenda']);
        self::add_data('content', view('App\Modules\Ressources\Views\participants\agenda', $data));
        return view('backend/layout', self::get_data());
    }

    public function requestAppointment($participantId = null)
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->back()->with('error', 'Invalid request method');
        }

        $rules = [
            'start_time' => 'required|valid_date[Y-m-d H:i:s]',
            'end_time' => 'required|valid_date[Y-m-d H:i:s]',
            'notes' => 'permit_empty|string'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', $this->validator->getErrors());
        }

        $startTime = $this->request->getPost('start_time');
        $endTime = $this->request->getPost('end_time');
        $notes = $this->request->getPost('notes');
        $currentUser = session()->get('user');

        // Check if timeslot is within participant's availability
        if (!$this->availabilityModel->isWithinAvailability($participantId, $startTime)) {
            return redirect()->back()->with('error', 'Selected time is not within participant\'s availability');
        }

        // Check if timeslot is not already booked
        if (!$this->appointmentModel->isTimeSlotAvailable($participantId, $startTime, $endTime)) {
            return redirect()->back()->with('error', 'Selected time slot is not available');
        }

        $appointmentData = [
            'requester_id' => $currentUser['id'],
            'participant_id' => $participantId,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'notes' => $notes,
            'status' => 'pending'
        ];

        if ($this->appointmentModel->insert($appointmentData)) {
            return redirect()->back()->with('success', 'Appointment request sent successfully');
        }

        return redirect()->back()->with('error', 'Failed to send appointment request');
    }

    public function manageAppointments()
    {
        $currentUser = session()->get('user');
        $pendingRequests = $this->appointmentModel->getPendingRequests($currentUser['id']);
        $myAppointments = $this->appointmentModel->getParticipantAppointments($currentUser['id']);

        $data = [
            'pending_requests' => $pendingRequests,
            'appointments' => $myAppointments
        ];

        self::add_crumb(['text' => 'Manage Appointments']);
        self::add_data('content', view('App\Modules\Ressources\Views\participants\manage_appointments', $data));
        return view('backend/layout', self::get_data());
    }

    public function updateAppointment($appointmentId = null)
    {
        if (!$appointmentId || $this->request->getMethod() !== 'post') {
            return redirect()->back()->with('error', 'Invalid request');
        }

        $status = $this->request->getPost('status');
        if (!in_array($status, ['approved', 'rejected'])) {
            return redirect()->back()->with('error', 'Invalid status');
        }

        $currentUser = session()->get('user');
        $appointment = $this->appointmentModel->find($appointmentId);

        if (!$appointment || $appointment['participant_id'] !== $currentUser['id']) {
            return redirect()->back()->with('error', 'Appointment not found or unauthorized');
        }

        if ($this->appointmentModel->updateStatus($appointmentId, $status)) {
            return redirect()->back()->with('success', 'Appointment ' . $status . ' successfully');
        }

        return redirect()->back()->with('error', 'Failed to update appointment');
    }

    public function manageAvailability()
    {
        if ($this->request->getMethod() === 'post') {
            $slots = json_decode($this->request->getPost('availability'), true);
            $currentUser = session()->get('user');

            if ($slots && $this->availabilityModel->updateAvailability($currentUser['id'], $slots)) {
                return redirect()->back()->with('success', 'Availability updated successfully');
            }
            return redirect()->back()->with('error', 'Failed to update availability');
        }

        $currentUser = session()->get('user');
        $availability = $this->availabilityModel->getParticipantAvailability($currentUser['id']);

        $data = [
            'availability' => $availability
        ];

        self::add_crumb(['text' => 'Manage Availability']);
        self::add_data('content', view('App\Modules\Ressources\Views\participants\manage_availability', $data));
        return view('backend/layout', self::get_data());
    }
}
