<?php
if ($paymentid == 7 & $this->db->table_exists('tbl_paystack')) {
    $paymentinfo = $this->hotel_model->read('*', 'paymentsetup', array('paymentid' => 7));
    echo '<form>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <button type="button" onclick="payWithPaystack()" id="paytrack" style="display:none;"> Pay </button> 
    </form>
    <script>
    document.getElementById("paytrack").click();
    function payWithPaystack(){
        var handler = PaystackPop.setup({
        key: "' . $paymentinfo->password . '",
        email: "' . $paymentinfo->email . '",
        amount: "' . round($data['orderinfo']->total_price * 100) . '",
        currency: "' . $paymentinfo->currency . '",
        ref: ""+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        metadata: {
            custom_fields: [
                {
                    display_name: "Mobile Number",
                    variable_name: "mobile_number",
                    value: "+2348012345678"
                }
            ]
        },
        callback: function(response){
            window.location.href="' . base_url() . 'hotel/successful/'.$orderid.'/'.$paymentid.'";
        },
        onClose: function(){
            window.location.href="' . base_url() . 'hotel/fail/'.$orderid.'";
        }
        });
        handler.openIframe();
    }
    </script>';
}