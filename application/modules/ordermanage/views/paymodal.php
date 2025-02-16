    <?php echo form_open('','method="get" class="navbar-search" name="sdf" id="paymodal-multiple-form"')?>
    <input name="<?php echo $this->security->get_csrf_token_name(); ?>" type="hidden"
        value="<?php echo $this->security->get_csrf_hash(); ?>" />
    <div class="modal-content">
        <div class="modal-header">
            <strong><?php echo display('sl_payment');?></strong>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <?php 
	                    if($ismerge==1){?>
                        <table class="table table-fixed table-bordered table-hover bg-white wpr_100">
                            <thead>
                                <tr>
                                    <?php if($duemerge==0){?><th class="text-center"><?php echo display('sl');?>. </th>
                                    <?php } ?>
                                    <th class="text-center"><?php echo display('ord_num');?> </th>
                                    <th class="text-center"><?php echo display('total_amount');?></th>
                                    <th class="text-center"><?php echo display('paid_amount');?></th>
                                    <th class="text-center">Due</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                        $totaldue =0;
										$totalamount=0;
                                            foreach ($order_info as $order) {
												$totalamount=$order->totalamount+$totalamount;
                                                ?>
                                <tr>
                                    <?php if($duemerge==0){?><td> <input class="marg-check" type="checkbox"
                                            value="<?php echo $order->order_id; ?>" onclick="margeorder()"
                                            name="order[]" checked></td> <?php } ?>
                                    <td><?php if($duemerge==1){?><input class="marg-check display-none" type="checkbox"
                                            value="<?php echo $order->order_id; ?>" onclick="margeorder()"
                                            name="order[]" checked> <?php } ?><?php echo $order->order_id; ?></td>
                                    <td class="text-right"><?php echo $order->totalamount; ?></td>
                                    <td class="text-right"><?php echo $order->customerpaid; ?></td>
                                    <td class="text-right" id="due-<?php echo $order->order_id; ?>">
                                        <?php echo $order->totalamount-$order->customerpaid; 
                                                  $totaldue = $totaldue+($order->totalamount-$order->customerpaid)
                                                  ?></td>
                                </tr>
                                <?php
                                            }
                                        ?>

                            </tbody>

                        </table>
                        <?php }
                                else{
                                        $totaldue = ($order_info->totalamount - $order_info->customerpaid);
                                        $totalamount=$order_info->totalamount;

                                    }
                                    $scan = scandir('application/modules/');
                                    $pointsys="";
                                    foreach($scan as $file) {
                                    if($file=="loyalty"){
                                        if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
                                        $pointsys=1;
                                        }
                                        }
                                    }
                                
                            ?>



                        <div class="row">
                            <div class="col-md-8">
                                <div class="row no-gutters">
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label for="discounttt"
                                                class="col-form-label pb-2"><?php echo display('discount_type');?></label>
                                            <select name="discountttch" class="form-control basic-single" id="discountttch"
                                                onchange="changetype()">
                                                <option value="1">Percent(%)</option>
                                                <option value="0">Amount</option>
                                            </select>
                                        </div>


                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                         if($settinginfo->discount_type==1){ 
                                        
							 $disamount=$totalamount*$settinginfo->discountrate/100;
							}else{
								$disamount=$settinginfo->discountrate;
								}
						
							?>
                                            <label for="discount"
                                                class="col-form-label pb-2"><?php echo display('discount');?>(<span
                                                    id="chty"><?php if($settinginfo->discount_type==0){echo $currency->curr_icon;}else{ echo "%";}?></span>)</label>
                                            <input type="hidden" id="discounttype"
                                                value="<?php echo $settinginfo->discount_type;?>" />
                                            <input type="hidden" id="ordertotal" value="<?php echo $totalamount;?>" />
                                            <input type="hidden" id="orderdue" value="<?php echo $totaldue;?>" />
                                            <input type="number" class="form-control" id="discount" name="discount"
                                                value="<?php echo $settinginfo->discountrate;?>" placeholder="0" />
                                            <input type="hidden" id="grandtotal" name="grandtotal"
                                                value="<?php echo $totalamount-$disamount;?>" />
                                            <input type="hidden" id="granddiscount" name="granddiscount"
                                                value="<?php echo $disamount;?>" />
                                            <input type="hidden" id="isredeempoint" name="isredeempoint" value="" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <?php if($pointsys==1 && $membership>1){
								$customerpoints=$this->db->select("*")->from('tbl_customerpoint')->where('customerid',$customerid)->get()->row();
								?>
                                        <div class="form-group">
                                            <label for="redempoint" class="col-form-label pb-2 plw-align">Points:
                                                <?php echo $customerpoints->points;?></label>
                                            <div class="kitchen-tab"><input id="chkbox-red" type="checkbox"
                                                    class="individual" name="redeemit"
                                                    value="<?php echo $customerid;?>">
                                                <label for="chkbox-red" class="mb-0"> Redeem It? &nbsp;&nbsp;
                                                    <span class="radio-shape mr-0"> <i class="fa fa-check"></i>
                                                    </span></label>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="form-group"
                                            style="padding-top:<?php if($pointsys==1 && $membership>1){echo "35px";}else{ echo "39px";}?>">
                                            <button type="button" id="paymentnow"
                                                class="btn btn-success w-md m-b-5"><?php echo display('payment');?></button>
                                        </div>
                                    </div>
                                </div>
                                <div id="adddiscount" class="display-none">
                                    <div class="row no-gutters">
                                        <div class="form-group col-md-6">
                                            <label for="payments"
                                                class="col-form-label pb-2"><?php echo display('paymd');?></label>

                                            <?php $card_type=4;
                                  echo form_dropdown('paytype[]',$paymentmethod,(!empty($card_type)?$card_type:null),'class="card_typesl postform resizeselect form-control " id="paytype" onchange="showhidecard(this)"') ?>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="4digit"
                                                class="col-form-label pb-2"><?php echo display('cuspayment');?></label>

                                            <input type="number" id="paidamount_marge"
                                                class="form-control number pay firstpay" name="paidamount[]"
                                                value="<?php echo $totaldue-$disamount; ?>" onkeyup="changedueamount()"
                                                placeholder="0" onclick="givefocus(this)" />

                                        </div>
                                    </div>

                                    <div class="row no-gutters">
                                        <div class="cardarea w-100 no-gutters row display-none ml-0">
                                            
                                            <div class="form-group col-md-6">
                                                <label for="4digit"
                                                    class="col-form-label"><?php echo "Account Number";?></label>

                                                <input type="text" class="form-control" placeholder="Account Number" id="account_number" name="account_number[]" value="" />

                                            </div>
                                        </div>

                                        <div class="cardarea2 w-100 no-gutters row display-none ml-0">
                                            
                                            <div class="form-group col-md-6">
                                                <label for="4digit"
                                                    class="col-form-label"><?php echo "Bank Name";?></label>

                                                <?php echo form_dropdown('bank_name[]',$banklist,null,'class="postform resizeselect form-control"  id="bank_name" ') ?>

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="4digit"
                                                    class="col-form-label"><?php echo "Account Number";?></label>

                                                <input type="text" class="form-control" placeholder="Account Number" id="account_number" name="account_number[]" value="" />

                                            </div>
                                            
                                        </div>
                                        <div class="cardarea3 w-100 no-gutters row display-none" style="margin-left: 0px">
                                            
                                            <div class="form-group col-md-6">
                                                <label for="card_terminal"
                                                    class="col-form-label"><?php echo display('crd_terminal');?></label>

                                                <?php echo form_dropdown('card_terminal[]',$terminalist,'','class="postform resizeselect form-control" ') ?>

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="bank"
                                                    class="col-form-label"><?php echo display('sl_bank');?></label>

                                                <?php echo form_dropdown('bank[]',$banklist,'','class="postform resizeselect form-control" ') ?>

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="4digit"
                                                    class="col-form-label"><?php echo display('lstdigit');?></label>

                                                <input type="text" class="form-control" name="last4digit[]" value="" />

                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class=" " id="add_new_payment">


                                    </div>

                                    <div class="form-group text-right">
                                        <div class="col-sm-12 pr-0">
                                            <button type="button" id="add_new_payment_type"
                                                class="btn btn-success w-md m-b-5"><?php echo display('add_new_payment_type');?></button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <table class="table table-fixed table-bordered table-hover bg-white wpr_100">
                                    <tr>
                                        <td>
                                        <?php echo display('total_amount');?>
                                        </td>
                                        <td id="totalamount_marge">
                                            <?php echo $totalamount-$disamount; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <?php echo display('total_due');?>
                                        </td>
                                        <td id="due-amount">
                                            <?php echo $totaldue-$disamount; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <?php echo display('payable_amnt');?>
                                        </td>
                                        <td id="pay-amount">
                                            0
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <?php echo display('change_amnt');?> 
                                        </td>
                                        <td id="change-amount">

                                        </td>
                                    </tr>

                                </table>

                                <div class="grid-container">
                                    <input type="button" class="grid-item" name="n1" value="1"
                                        onClick="inputNumbersfocus(n1.value)">
                                    <input type="button" class="grid-item" name="n2" value="2"
                                        onClick="inputNumbersfocus(n2.value)">
                                    <input type="button" class="grid-item" name="n3" value="3"
                                        onClick="inputNumbersfocus(n3.value)">
                                    <input type="button" class="grid-item" name="n4" value="4"
                                        onClick="inputNumbersfocus(n4.value)">
                                    <input type="button" class="grid-item" name="n5" value="5"
                                        onClick="inputNumbersfocus(n5.value)">
                                    <input type="button" class="grid-item" name="n6" value="6"
                                        onClick="inputNumbersfocus(n6.value)">
                                    <input type="button" class="grid-item" name="n7" value="7"
                                        onClick="inputNumbersfocus(n7.value)">
                                    <input type="button" class="grid-item" name="n8" value="8"
                                        onClick="inputNumbersfocus(n8.value)">
                                    <input type="button" class="grid-item" name="n9" value="9"
                                        onClick="inputNumbersfocus(n9.value)">
                                    <input type="button" class="grid-item" name="n0" value="0"
                                        onClick="inputNumbersfocus(n0.value)">
                                    <input type="button" class="grid-item" name="n00" value="00"
                                        onClick="inputNumbersfocus(n00.value)">
                                    <input type="button" class="grid-item" name="c0" value="C" placeholder="0"
                                        onClick="inputNumbersfocus(c0.value)">

                                </div>

                                <div class="form-group text-right mt-3">
                                    <div class="col-sm-12 mt-15 pr-0 text-center">
                                        <input type="hidden" id="finyear" value="<?php echo financial_year(); ?>">
                                        <input type="hidden" id="findate" value="<?php echo maxfindate(); ?>">
                                        <?php  if($ismerge==1){
                                            if($duemerge==0){
                                            ?>
                                        <button type="button" id="duembill"
                                            class="btn btn-success w-md m-b-5 m-r-5 col-sm-5"
                                            onclick="duemargebill()"><?php echo display('due_marge');?></button>
                                        <?php } ?>
                                        <button type="button" id="paidbill"
                                            class="btn btn-success w-md m-b-5 <?php if($duemerge==1){echo "col-sm-12";}else{ echo "col-sm-6";}?>"
                                            onclick="margeorderconfirmorcancel()"><?php echo display('pay_print');?></button>
                                        <?php }
							                else{

                                                $cr_time =  date("Y-m-d H");
                                                $this->db->select('cutomerid');
                                                $this->db->from('booked_info');
                                                
                                                 $this->db->where('CAST(booked_info.checkindate AS datetime) <=',$cr_time);
                                                $this->db->where('CAST(booked_info.checkoutdate AS datetime) >=',$cr_time);
                                                $this->db->where('booked_info.bookingstatus',4);
                                                $this->db->where('booked_info.cutomerid',$order_info->customer_id);
                                                $this->db->group_by('booked_info.cutomerid');
                                                $query=$this->db->get();
                                                $data=$query->result();
                                               
                                                if (!empty($data) && $order_info->cutomertype == 6) {
                                                    
                                                ?>
                                            

                                        <button type="button" class="btn btn-info w-md m-b-5" id="add_to_invoice"
                                            onclick="addtomaininvoice()"><?php echo display('add_to_invoice') ?></button>
                                            <input type="hidden" id="hc_order_id" name="hc_order_id"
                                            value="<?php echo $order_info->order_id; ?>">
                                            <?php }?>
                                            
                                        <button type="button"
                                            class="btn btn-success w-md m-b-5 mt-2 mb-n3" id="pay_bill"
                                            onfocus="submitmultiplepay()"><?php echo display('pay_print');?></button>
                                        <input type="hidden" id="get-order-id" name="orderid"
                                            value="<?php echo $order_info->order_id; ?>">
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </form>
    <input type="hidden" id="get-order-flag" value="1">
    <script src="<?php echo base_url('application/modules/ordermanage/assets/js/paymodal.js'); ?>"
        type="text/javascript"></script>