<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get customer by email
     */
    public function get_customer_by_email($email)
    {
        $query = $this->db->select('customerid, firstname, lastname, email, cust_phone, address, balance')
            ->from('customerinfo')
            ->where('email', $email)
            ->get();

        return $query->num_rows() > 0 ? $query->row_array() : null;
    }

    /**
     * Get customer details
     */
    public function get_customer($id)
    {
        $this->db->select('customerid, firstname, lastname, email, cust_phone, address, balance');
        $this->db->where('customerid', $id);
        $query = $this->db->get('customerinfo');

        if ($query->num_rows() === 0) {
            return null;
        }

        $customer = $query->row_array();

        // Get booking history
        $this->db->select('bi.*, rd.roomtype');
        $this->db->from('booked_info bi');
        $this->db->join('roomdetails rd', 'rd.roomid = bi.roomid', 'left');
        $this->db->where('bi.cutomerid', $id);
        $this->db->order_by('bi.checkindate', 'DESC');

        $bookings_query = $this->db->get();
        $customer['bookings'] = $bookings_query->result_array();

        return $customer;
    }

    /**
     * Create new customer with validation
     */
    public function create_customer($data)
    {
        // Validate data
        $validation_errors = $this->validate_customer_data($data);
        if (!empty($validation_errors)) {
            throw new Exception(implode(', ', $validation_errors));
        }

        // Validate password
        if (!isset($data['password']) || strlen($data['password']) < 6) {
            throw new Exception('Password must be at least 6 characters long');
        }

        // Check if email exists
        if ($this->email_exists($data['email'])) {
            throw new Exception('Email address already registered');
        }

        // Generate customer number
        $lastid = $this->db->select("*")->from('customerinfo')
            ->order_by('customernumber', 'desc')
            ->get()->row();

        $sino = $this->generate_customer_number($lastid);

        // Hash password
        $data['pass'] = password_hash($data['password'], PASSWORD_DEFAULT);
        unset($data['password']);

        // Prepare customer data
        $customer_data = [
            'firstname' => trim($data['firstname']),
            'lastname' => trim($data['lastname']),
            'customernumber' => $sino,
            'email' => strtolower(trim($data['email'])),
            'pass' => $data['pass'],
            'cust_phone' => isset($data['phone']) ? trim($data['phone']) : null,
            'address' => isset($data['address']) ? trim($data['address']) : null,
            'balance' => 0,
            'signupdate' => date('Y-m-d')
        ];

        $this->db->trans_start();

        try {
            // Insert customer record
            $this->db->insert('customerinfo', $customer_data);
            $customer_id = $this->db->insert_id();

            if (!$customer_id) {
                throw new Exception('Failed to create customer record');
            }

            // Create customer account in acc_coa
            $this->create_customer_account($customer_id, $customer_data);

            $this->db->trans_complete();

            return $this->get_customer($customer_id);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            throw $e;
        }
    }

    /**
     * Update customer data
     */
    public function update_customer($id, $data)
    {
        // Validate data
        $validation_errors = $this->validate_customer_data($data, true);
        if (!empty($validation_errors)) {
            throw new Exception(implode(', ', $validation_errors));
        }

        // Check email uniqueness if being updated
        if (isset($data['email'])) {
            $existing = $this->db->where('email', $data['email'])
                ->where('customerid !=', $id)
                ->get('customerinfo')
                ->row();

            if ($existing) {
                throw new Exception('Email address already registered');
            }
        }

        // Map phone to cust_phone if it exists
        if (isset($data['phone'])) {
            $data['cust_phone'] = $data['phone'];
            unset($data['phone']);
        }

        // Prepare update data with exact column names
        $update_data = array_intersect_key($data, array_flip([
            'firstname',
            'lastname',
            'email',
            'cust_phone',
            'address'
        ]));

        $this->db->trans_start();

        try {
            if (!empty($update_data)) {
                $this->db->set($update_data);
                $this->db->where('customerid', $id);
                $this->db->update('customerinfo');
            }

            // Update acc_coa if name changed
            if (isset($data['firstname']) || isset($data['lastname'])) {
                $this->update_customer_account_name($id);
            }

            $this->db->trans_complete();

            return $this->get_customer($id);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            throw $e;
        }
    }

    /**
     * Validate login credentials and return customer data
     */
    public function validate_login($email, $password)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format');
        }

        $email = strtolower(trim($email));

        $exclude = ['password_reset_token'];
        $fields = $this->db->list_fields('customerinfo');

        $columns = array_diff($fields, $exclude);
        $select_columns = implode(', ', $columns);

        $customer = $this->db->where('email', $email)
            ->select($select_columns)
            ->get('customerinfo')
            ->row_array();

        if (!$customer) {
            throw new Exception('Invalid login credentials');
        }

        if (!password_verify($password, $customer['pass'])) {
            throw new Exception('Invalid login credentials');
        }

        unset($customer['pass']);
        return $customer;
    }

    /**
     * Get customer's booking history
     */
    public function get_customer_bookings($customer_id)
    {
        $this->db->select('
            bi.*,
            rd.roomtype,
            rd.rate,
            ri.room_imagename,
            pm.payment_method as payment_method_name
        ');
        $this->db->from('booked_info bi');
        $this->db->join('roomdetails rd', 'rd.roomid = bi.roomid', 'left');
        $this->db->join('room_image ri', 'ri.room_id = rd.roomid', 'left');
        $this->db->join('booked_details bd', 'bd.bookedid = bi.bookedid', 'left');
        $this->db->join('payment_method pm', 'pm.payment_method_id = bd.payment_method', 'left');
        $this->db->where('bi.cutomerid', $customer_id);
        $this->db->order_by('bi.checkindate', 'DESC');

        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Validate and sanitize customer data
     */
    private function validate_customer_data($data, $is_update = false)
    {
        $errors = [];

        // Required fields for new customers
        if (!$is_update) {
            $required = ['firstname', 'lastname', 'email'];
            foreach ($required as $field) {
                if (!isset($data[$field]) || empty(trim($data[$field]))) {
                    $errors[] = ucfirst($field) . ' is required';
                }
            }
        }

        // Validate email if present
        if (isset($data['email'])) {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Invalid email format';
            }
        }

        // Validate phone if present
        if (isset($data['phone']) && !empty($data['phone'])) {
            if (!preg_match('/^[0-9+\-\s()]{8,20}$/', $data['phone'])) {
                $errors[] = 'Invalid phone number format';
            }
        }

        return $errors;
    }

    /**
     * Check if email exists
     */
    public function email_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('customerinfo');
        return $query->num_rows() > 0;
    }

    /**
     * Update customer password
     */
    public function update_password($id, $new_password)
    {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $this->db->where('customerid', $id);
        $this->db->set('pass', $hashed_password);
        return $this->db->update('customerinfo');
    }

    /**
     * Verify password
     */
    public function verify_password($id, $password)
    {
        $this->db->select('pass');
        $this->db->where('customerid', $id);
        $query = $this->db->get('customerinfo');

        if ($query->num_rows() === 0) {
            return false;
        }

        $hash = $query->row()->pass;
        return password_verify($password, $hash);
    }

    /**
     * Generate unique head code for acc_coa
     */
    private function generate_head_code()
    {
        $prefix = 5020304; // Customer accounts prefix

        $this->db->select_max('HeadCode');
        $this->db->like('HeadCode', $prefix, 'after');
        $query = $this->db->get('acc_coa');
        $result = $query->row();

        $max_code = $result->HeadCode;
        if (!$max_code) {
            return $prefix;
        }

        return $max_code + 1;
    }

    /**
     * Get customer's head code from acc_coa
     */
    private function get_customer_head_code($customer_id)
    {
        $customer = $this->get_customer($customer_id);
        if (!$customer) {
            return null;
        }

        $full_name = $customer['firstname'] . ' ' . $customer['lastname'];

        $this->db->select('HeadCode');
        $this->db->where('HeadName', $full_name);
        $query = $this->db->get('acc_coa');

        return $query->num_rows() > 0 ? $query->row()->HeadCode : null;
    }


    /**
     * Store a customer token in the password_reset_token field
     */
    public function store_token($customer_id, $token)
    {
        $this->db->where('customerid', $customer_id);
        $this->db->set('password_reset_token', $token);
        $this->db->update('customerinfo');
    }

    /**
     * Invalidate the customer token by clearing the password_reset_token field
     */
    public function invalidate_token($customer_id)
    {
        $this->db->where('customerid', $customer_id);
        $this->db->set('password_reset_token', NULL);
        $this->db->update('customerinfo');

        error_log("[DEBUG] JWT_handler: Token invalidated for customer ID $customer_id");
    }

    private function generate_customer_number($lastid)
    {
        if (!$lastid) {
            return "CUS0001";
        }

        $sl = intval(substr($lastid->customernumber, 3));
        $nextno = $sl + 1;
        $si_length = strlen((int)$nextno);

        $str = '0000';
        $cutstr = substr($str, $si_length);
        return "CUS" . $cutstr . $nextno;
    }

    private function create_customer_account($customer_id, $customer_data)
    {
        $coa = $this->db->select('HeadCode')
            ->from('acc_coa')
            ->order_by('HeadCode', 'desc')
            ->limit(1)
            ->get()
            ->row();

        $headcode = $coa ? ($coa->HeadCode + 1) : "102030101";

        $c_acc = $customer_data['customernumber'] . ' - ' .
            $customer_data['firstname'] . ' ' .
            $customer_data['lastname'];

        $createby = $this->session->userdata('id');
        $createdate = date('Y-m-d H:i:s');

        $coa_data = [
            'HeadCode'       => $headcode,
            'HeadName'       => $c_acc,
            'PHeadName'      => 'Customer Receivable',
            'HeadLevel'      => 4,
            'IsActive'       => 1,
            'IsTransaction'  => 1,
            'IsGL'          => 0,
            'HeadType'       => 'A',
            'IsBudget'       => 0,
            'IsDepreciation' => 0,
            'customer_id'    => $customer_id,
            'DepreciationRate' => 0,
            'CreateBy'       => $createby,
            'CreateDate'     => $createdate
        ];

        return $this->db->insert('acc_coa', $coa_data);
    }

    private function update_customer_account_name($customer_id)
    {
        $customer = $this->get_customer($customer_id);
        if ($customer) {
            $full_name = $customer['firstname'] . ' ' . $customer['lastname'];
            $this->db->where('customer_id', $customer_id)
                ->update('acc_coa', ['HeadName' => $full_name]);
        }
    }

    /**
     * Get customer permissions
     */
    public function get_permissions($customer_id)
    {
        // For now, return default customer permissions
        return ['customer:read', 'customer:write', 'booking:read', 'booking:write'];
    }
}
