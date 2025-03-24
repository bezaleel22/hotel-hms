<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paystack
{
    /**
     * CodeIgniter instance
     * @var object
     */
    protected $CI;

    /**
     * Paystack secret key
     * @var string
     */
    protected $secret_key;

    /**
     * API base URL
     * @var string
     */
    protected $api_url = 'https://api.paystack.co';

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->secret_key = getenv('PAYSTACK_SECRET_KEY') ?: 'your-paystack-secret-key-here';

        if (empty($this->secret_key)) {
            throw new Exception('Paystack secret key is not configured');
        }
    }

    public function get_secret_key()
    {
        $this->CI->load->database();
        $paymentinfo = $this->CI->db->select('*')->from('paymentsetup')->where('paymentid', 7)->get()->row();
        return $paymentinfo->password;
    }

    /**
     * Initialize a transaction
     * @param array $data Array containing:
     *      - email: Customer's email address
     *      - amount: Amount in kobo/cents
     *      - currency: Transaction currency (NGN, GHS, ZAR or USD)
     *      - reference: Unique transaction reference
     *      - callback_url: URL to redirect to after payment
     *      - metadata: Additional data to include with the transaction
     * @return array Transaction initialization response
     * @throws Exception
     */
    public function initialize_transaction($data)
    {
        if (empty($data['email']) || empty($data['amount']) || empty($data['callback_url'])) {
            throw new Exception('Paystack: Missing required parameters');
        }

        // Convert amount to kobo (multiply by 100 since Paystack expects amount in kobo)
        $data['amount'] = $data['amount'] * 100;

        return $this->make_request('POST', '/transaction/initialize', $data);
    }

    /**
     * Verify a transaction
     * @param string $reference Transaction reference
     * @return array Transaction verification response
     * @throws Exception
     */
    public function verify_transaction($reference)
    {
        return $this->make_request('GET', "/transaction/verify/{$reference}");
    }

    /**
     * Make HTTP request to Paystack API
     * @param string $method HTTP method
     * @param string $endpoint API endpoint
     * @param array $data Request data
     * @return array Response data
     * @throws Exception
     */
    protected function make_request($method, $endpoint, $data = [])
    {
        $url = $this->api_url . $endpoint;
        $headers = [
            'Authorization: Bearer ' . $this->get_secret_key(),
            'Content-Type: application/json',
            'Cache-Control: no-cache'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($method === 'POST' && !empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $errno = curl_errno($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($errno) {
            throw new Exception('cURL error: ' . $error, $errno);
        }

        $result = json_decode($response, true);

        if ($http_code >= 400 || !$result['status']) {
            throw new Exception(
                isset($result['message']) ? $result['message'] : 'An error occurred while processing the request',
                $http_code
            );
        }

        return $result['data'];
    }
}
