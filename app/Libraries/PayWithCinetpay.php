<?php
namespace App\Libraries;

class PayWithCinetpay {
    private $apiKey;
    private $siteId;
    private $baseUrl = 'https://api-checkout.cinetpay.com/v2/payment';

    public function __construct() {
        $this->apiKey = '1234176883681074e4424323.52421594';
        $this->siteId = '105893543';
    }

    public function generatePaymentLink($data) {
        try {
            $data['apikey'] = $this->apiKey;
            $data['site_id'] = $this->siteId;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->baseUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                throw new \Exception("cURL Error #:" . $err);
            }

            return json_decode($response, true);
        } catch (\Exception $e) {
            log_message('error', 'CinetPay Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function verifyPayment($transactionId) {
        try {
            $data = array(
                'apikey' => $this->apiKey,
                'site_id' => $this->siteId,
                'transaction_id' => $transactionId
            );

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->baseUrl . '/check',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                throw new \Exception("cURL Error #:" . $err);
            }

            return json_decode($response, true);
        } catch (\Exception $e) {
            log_message('error', 'CinetPay Error: ' . $e->getMessage());
            throw $e;
        }
    }
}
