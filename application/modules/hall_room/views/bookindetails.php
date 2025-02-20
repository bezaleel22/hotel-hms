<link type="text/css" href="<?php echo MOD_URL.$module;?>/assets/css/table.css">
<div class="card">
    <div class="card-body" id="printArea">
        <div class="row">
            <div class="col-sm-6">
                <img src="<?php echo base_url();?><?php echo html_escape(!empty($commominfo->invoice_logo)?$commominfo->invoice_logo: 'assets/img/header-logo.png')?>"
                    class="img-fluid mb-3" alt="">
                <br>
                <address>
                    <strong><?php echo html_escape($storeinfo->storename);?></strong><br>
                    <?php echo html_escape($storeinfo->address);?><br>
                    <abbr title="Phone"><?php echo display('mobile') ?>:</abbr>
                    <?php echo html_escape($storeinfo->phone);?>
                </address>
                <address>
                    <strong><?php echo display('email') ?></strong><br>
                    <a href="mailto:#"><?php echo html_escape($storeinfo->email);?></a>
                </address>
            </div>
            <?php
            $firstdate = $bookinfo->start_date;
            $lastdate = $bookinfo->end_date;
            $datediff = strtotime($lastdate) - strtotime($firstdate);
            $datediff = ceil($datediff/(60*60));
        ?>
            <div class="col-sm-6 text-right">
                <h1 class="h3"><?php echo display('booking_number') ?>
                    #<?php echo html_escape($bookinfo->invoice_no);?></h1>
                <div><?php echo display('booking_date') ?>: <?php echo html_escape($bookinfo->date_time);?></div>
                <div class="text-danger m-b-15"><?php echo display('payment_status') ?>:
                    <?php if($bookinfo->payment_status==1){ echo display("paid");} else if($bookinfo->payment_status==2){ echo "Partialy ".display('paid');} else if($bookinfo->payment_status==0){ echo display("unpaid");}else if($bookinfo->payment_status==3){ echo display("refunded");} ?>
                </div>
                <address>
                    <strong><?php echo display('guest_info') ?></strong><br>
                    <?php echo html_escape((!empty($customerinfo->firstname)?$customerinfo->firstname.' '.$customerinfo->lastname:'User Deleted'));?><br>
                    <?php echo display('address') ?>:
                    <?php echo html_escape(!empty($customerinfo->address)?$customerinfo->address:null);?><br>
                    <abbr title="Phone"><?php echo display('mobile') ?>:</abbr>
                    <?php echo html_escape(!empty($customerinfo->cust_phone)?$customerinfo->cust_phone:null);?>
                </address>
                <address>
                    <strong><?php echo display('email') ?></strong><br>
                    <a
                        href="mailto:#"><?php echo html_escape(!empty($customerinfo->email)?$customerinfo->email:null);?></a>
                </address>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                    <tr>
                        <td>
                            <div><strong><?php echo display('hall')." ".display('roomtype') ?></strong></div>
                        </td>
                        <?php
                    $allroomtype="";
                    $roomid = explode(",",$bookinfo->hall_type);
                    for($i=0;$i<count($roomid); $i++){
                        $roomtype = $this->db->select("hall_type")->from("tbl_hallroom_info")->where("hid",$roomid[$i])->get()->row();
                        $allroomtype .= $roomtype->hall_type.",";
                    }
                 ?>
                        <td><?php echo trim($allroomtype,",");?></td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong><?php echo display('hall')." ".display('room_no') ?></strong></div>
                        </td>
                        <td><?php echo html_escape(!empty($bookinfo->hall_no)?$bookinfo->hall_no:null);?></td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong><?php echo display('s_date') ?></strong></div>
                        </td>
                        <td><?php echo html_escape($bookinfo->start_date);?></td>
                    <tr>
                        <td>
                            <div><strong><?php echo display('e_date') ?></strong></div>
                        </td>
                        <td><?php echo html_escape($bookinfo->end_date);?></td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong><?php echo display('booking_status') ?></strong></div>
                        </td>
                        <td><?php if($bookinfo->status==2){ echo display("complete");} else if($bookinfo->status==1){ echo display('booked');} else if($bookinfo->status==3){ echo display("cancel");}?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong><?php echo display('adults') ?></strong></div>
                        </td>
                        <td><?php echo html_escape($bookinfo->people);?></td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong><?php echo display('number_of_rooms') ?></strong></div>
                        </td>
                        <td><?php echo html_escape($bookinfo->total_room);?></td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong><?php echo display('hours') ?></strong></div>
                        </td>
                        <td><?php
                            echo html_escape($datediff);
                        ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped table-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo display('date') ?></th>
                        <th><?php echo display('rent') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                                    $totaldiscount=0;
                                    $roomrate=0;
                                    $x=0;
                                    $total=0;
                                    $roomId = explode(",", $bookinfo->hall_type);
                                    $roomRate = explode(",", $bookinfo->rent);
                                    for($li = 0; $li < count($roomId); $li++){
                                        for($i = 0; $i < $datediff; $i++){
                                        $alldays= date("Y-m-d H:i", strtotime($firstdate . ' + ' . $i . 'hour'));
                                        $x++;
                                        $roomrate=$roomRate[$li]/$datediff;
                                        $total=$total+$roomrate;
                    ?>
                    <tr>
                        <td>
                            <div><strong><?php echo $x;?></strong></div>
                        </td>
                        <td><?php echo html_escape($alldays);?></td>
                        <td><?php echo html_escape($roomrate);?></td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-8">
            </div>
            <div class="col-sm-4">
                <ul class="list-unstyled text-right">
                    <li>
                        <strong><?php echo display('subtotal'); ?>:</strong> <?php $grprice=$total;
                    echo (($grprice!=0)?$grprice:$grprice=$total); ?>
                    </li>
                    <?php $totaltax = 0; $scharge=0; ?>
                    <?php if(empty($btaxinfo->bookedid)){ ?>
                    <?php foreach($taxinfo as $tax){ ?>
                    <li>
                        <strong><?php echo html_escape($tax->taxname); ?>
                            <?php echo html_escape($tax->rate);?>%:</strong> <?php $singletax=0; $singletax=$tax->rate*$grprice/100;
                        echo $singletax; $totaltax+=$singletax; ?>
                    </li>
                    <?php } ?>
                    <?php }else{ ?>
                    <?php $taskname = explode(",", $btaxinfo->taskname);
                    $rate = explode(",", $btaxinfo->rate); ?>
                    <?php for($bt=0; $bt<count($taskname); $bt++){ ?>
                    <li>
                        <strong><?php echo html_escape($taskname[$bt]); ?>
                            <?php echo html_escape($rate[$bt]);?>%:</strong> <?php $singletax=0; $singletax=$rate[$bt]*$grprice/100;
                        echo $singletax; $totaltax+=$singletax; ?>
                    </li>
                    <?php } ?>
                    <?php } ?>
                    <li>
                        <strong><?php echo display('tax') ?> :</strong> <?php echo html_escape($totaltax);?>
                    </li>
                    <?php if($bookinfo->status==2){ ?>
                    <?php if(!empty($btaxinfo->scharge)){ ?>
                    <li>
                        <strong><?php echo display("service_charge") ?> :</strong> <?php echo $scharge = $btaxinfo->scharge;?>
                    </li>
                    <?php } ?>
                    <?php 
                }else{
                    $postedbill = 0;
                    $reducetax = 0; 
                    $scharge = ($setting->servicecharge*$grprice)/100;
                    ?>
                    <li>
                        <strong><?php echo display("service_charge"); ?> :</strong> <?php echo html_escape($scharge);?>
                    </li>
                    <?php } ?>
                    <li>
                        <?php $grprice += $scharge;?>
                        <strong><?php echo display('grand_total') ?>:</strong>
                        <?php if($currency->position==1){echo html_escape($currency->curr_icon);}?><?php echo $grand_total = number_format($totaltax+$grprice,2);?><?php if($currency->position==2){echo html_escape($currency->curr_icon);}?>
                        <br /><strong><?php echo display('paid_amount') ?>:</strong>
                        <?php if($currency->position==1){echo html_escape($currency->curr_icon);}?><?php if (!empty($bookinfo->paid_amount)){$total_paid = $bookinfo->paid_amount;echo number_format($total_paid,2);}?><?php if($currency->position==2){echo html_escape($currency->curr_icon);}?>
                        <br /><strong><?php echo display('due_amount') ?>:</strong>
                        <?php if($currency->position==1){echo html_escape($currency->curr_icon);}?><?php $remain_amount=0; if (!empty($bookinfo->paid_amount)){echo $remain_amount = $bookinfo->totalamount - $bookinfo->paid_amount;}?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-info mr-2" onclick="printContent('printArea')"><span
                class="fa fa-print"></span></button>
    </div>
</div>