<?php
$directory = $this->db->where('directory', 'razorpay')->where('status', 1)->get('module')->num_rows();
if ($paymentid == 9 & $directory == 1) {
    $settinginfo=$this->settinginfo;
    $paymentinfo = $this->hotel_model->read('*', 'paymentsetup', array('paymentid' => 9));
    echo '<input type="hidden" id="orderid" value="'.$orderid.'">
    <input type="hidden" id="paymentid" value="'.$paymentid.'">
    <input type="hidden" id="marchantid" value="'.$paymentinfo->marchantid.'">
    <input type="hidden" id="favicon" style="height:100%;" value="'.base_url($settinginfo->splash_logo).'">
    <input type="hidden" id="title" value="'.$settinginfo->title.'">
    <input type="hidden" id="storename" value="'.$settinginfo->storename.'">
    <input type="hidden" id="totalprice" value="'.round($data['orderinfo']->total_price * 100).'">
    <button type="button" id="razorpay" hidden></button> 
    <input type="hidden" id="base_url" value="'.base_url().'">
    <input type="hidden" id="csrf_token" value="'.$this->security->get_csrf_hash().'">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="'.base_url().'website_assets/plugins/jQuery/jquery-3.5.1.min.js"></script>
    <script src="'.base_url().'application/modules/razorpay/assets/js/razorpay.js"></script>';
}