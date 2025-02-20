<?php
	public function stripe($orderid, $page)
	{
		echo "asdfasdf";
		exit;
		$data['title'] = "Stripe Payment information";
		$data['seoterm'] = "stripe_payment_information";
		$data['orderinfo']  	       = $this->hotel_model->read('*', 'booked_info', array('booking_number' => $orderid));
		$bookedInfo = $this->db->select('*')->from('booked_info')->where('booking_number',$orderid)->get()->row();
		$data['paymentinfo']  	   = $this->hotel_model->read('*', 'paymentsetup', array('paymentid' => $paymentid));
		$data['customerinfo']  	   = $this->hotel_model->read('*', 'customerinfo', array('customerid' => $bookedInfo->cutomerid));
		$customer                    = $this->hotel_model->read('*', 'customerinfo', array('customerid' => $bookedInfo->cutomerid));
	    $commonsetting=$this->hotel_model->read('*', 'common_setting', array('id' => 1));
		$data['content'] = $this->load->view('application/modules/stripe/stripe_view', $data, TRUE);
		$this->load->view('index', $data);
	}
    public function stripePost()
	{
		require_once('application/modules/stripe/libraries/stripe-php/init.php');
		$orderid = $this->input->post('orderid', true);
		$amount = $this->input->post('amount', true);
		$currency = $this->input->post('currency', true);

		$data['title']="Payment information";
		$paymentinfo   	          = $this->hotel_model->read('*', 'paymentsetup', array('paymentid' => 8));

		\Stripe\Stripe::setApiKey($paymentinfo->marchantid);

		\Stripe\Charge::create([
			"amount" => $amount,
			"currency" => $currency,
			"source" => $this->input->post('stripeToken'),
			"description" => "Test payment from Bdtask"
		]);

		redirect('hotel/successful/' . $orderid . '/' . 8);
	}
