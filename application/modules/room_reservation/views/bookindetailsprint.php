<link type="text/css" href="<?php echo MOD_URL;?>room_reservation/assets/css/table.css">
<div class="card">
    <div class="card-body" id="printArea">
        <div class="row">
            <div class="col-sm-6">
                <img src="<?php echo base_url();?><?php echo html_escape(!empty($commominfo->invoice_logo)?$commominfo->invoice_logo: 'assets/img/header-logo.png')?>" class="img-fluid mb-3" alt="">
                <br>
                <address>
                    <strong><?php echo html_escape($storeinfo->storename);?></strong><br>
                    <?php echo html_escape($storeinfo->address);?><br>
                <abbr title="Phone"><?php echo display('mobile') ?>:</abbr> <?php echo html_escape($storeinfo->phone);?>
            </address>
            <address>
                <strong><?php echo display('email') ?></strong><br>
                <a href="mailto:#"><?php echo html_escape($storeinfo->email);?></a>
            </address>
        </div>
        <?php
            $firstdate = $bookinfo->checkindate;
            $lastdate = $bookinfo->checkoutdate;
            $datediff = strtotime($lastdate) - strtotime($firstdate);
            $datediff = ceil($datediff/(60*60*24));
        ?>
        <div class="col-sm-6 text-right">
            <h1 class="h3"><?php echo display('booking_number') ?> #<?php echo html_escape($bookinfo->booking_number);?></h1>
            <div><?php echo display('booking_date') ?>: <?php echo html_escape($bookinfo->date_time);?></div>
            <div class="text-danger m-b-15"><?php echo display('payment_status') ?>:
                <?php if(isset($bookinfo->paid_amount)){?>
                <?php if($bookinfo->paid_amount < $bookinfo->total_price*$datediff){ echo display("unpaid");}else{ echo display("paid");}?>
                <?php } else{echo display("unpaid");}?>
            </div>
            <address>
                <strong><?php echo display('guest_info') ?></strong><br>
                <?php echo html_escape((!empty($customerinfo->firstname)?$customerinfo->firstname.' '.$customerinfo->lastname:'User Deleted'));?><br>
                <?php echo display('address') ?>: <?php echo html_escape(!empty($customerinfo->address)?$customerinfo->address:null);?><br>
            <abbr title="Phone"><?php echo display('mobile') ?>:</abbr> <?php echo html_escape(!empty($customerinfo->cust_phone)?$customerinfo->cust_phone:null);?>
        </address>
        <address>
            <strong><?php echo display('email') ?></strong><br>
            <a href="mailto:#"><?php echo html_escape(!empty($customerinfo->email)?$customerinfo->email:null);?></a>
        </address>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <tbody>
            <tr>
                <td>
                    <div><strong><?php echo display('roomtype') ?></strong></div>
                </td>
                <?php
                    $allroomtype="";
                    $roomid = explode(",",$bookinfo->roomid);
                    for($i=0;$i<count($roomid); $i++){
                        $roomtype = $this->db->select("roomtype")->from("roomdetails")->where("roomid",$roomid[$i])->get()->row();
                        $allroomtype .= $roomtype->roomtype.",";
                    }
                 ?>
                <td><?php echo trim($allroomtype,",");?></td>
            </tr>
            <tr>
                <td>
                    <div><strong><?php echo display('room_no') ?></strong></div>
                </td>
                <td><?php echo html_escape(!empty($bookinfo->room_no)?$bookinfo->room_no:null);?></td>
            </tr>
            <tr>
                <td>
                    <div><strong><?php echo display('checkin') ?></strong></div>
                </td>
                <td><?php echo html_escape($bookinfo->checkindate);?></td>
                <tr>
                    <td>
                        <div><strong><?php echo display('checkout') ?></strong></div>
                    </td>
                    <td><?php echo html_escape($bookinfo->checkoutdate);?></td>
                </tr>
                <tr>
                    <td>
                        <div><strong><?php echo display('booking_status') ?></strong></div>
                    </td>
                    <td><?php if($bookinfo->bookingstatus==0){ echo display('pending');}if($bookinfo->bookingstatus==2){ echo display('complete');}if($bookinfo->bookingstatus==1){ echo display("cancel");}if($bookinfo->bookingstatus==4){ echo display("checkin");}if($bookinfo->bookingstatus==5){ echo display("checkout");}?></td>
                </tr>
                <tr>
                    <td>
                        <div><strong><?php echo display('adults') ?></strong></div>
                    </td>
                    <td><?php echo html_escape($bookinfo->nuofpeople);?></td>
                </tr>
                <tr>
                    <td>
                        <div><strong><?php echo display('number_of_rooms') ?></strong></div>
                    </td>
                    <td><?php echo html_escape($bookinfo->total_room);?></td>
                    <?php if($bookinfo->coments=="Booking from admin"){
                        $totalroom=1;
                    }else{
                        $totalroom = $bookinfo->total_room;
                    } ?>
                </tr>
                <tr>
                    <td>
                        <div><strong><?php echo display('nights') ?></strong></div>
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
                    <th><?php echo display('price') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                                    $totaldiscount=0;
                                    $roomrate=0;
                                    $x=0;
                                    $total=0;
                                    $roomId = explode(",", $bookinfo->roomid);
                                    $roomRate = explode(",", $bookinfo->roomrate);
                                    $disamount = $this->db->select("discountamount")->from("booked_details")->where("bookedid", $bookinfo->bookedid)->get()->row();
                                    for($li = 0; $li < count($roomId); $li++){
                                        for($i = 0; $i < $datediff; $i++){
                                        $alldays= date("Y-m-d", strtotime($firstdate . ' + ' . $i . 'day'));
                                        $x++;
                                        $getroom=$this->db->select("*")->from('tbl_room_offer')->where('roomid',$roomId[$li])->where('offer_date',$alldays)->get()->row();
                                        if(!empty($getroom)){
                                            $singleDiscount=$getroom->offer*$totalroom;
                                            $totaldiscount=$totaldiscount+$singleDiscount;
                                            $roomrate=$roomRate[$li];
                                            }
                                        else{
                                            $roomrate=$roomRate[$li];
                                            }
                                        $price=($totalroom*$roomrate);
                                        $total=$total+$price;
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
                    <strong><?php echo display('subtotal'); ?>:</strong> <?php $grprice=$totalroom*$total;
                    $grprice=$grprice;
                    echo (($grprice!=0)?$grprice:$grprice=$total); $grprice -= $disamount->discountamount*$datediff;?>
                </li>
                <?php $totaltax = 0; ?>
                <?php if(empty($btaxinfo->bookedid)){ ?>
                    <?php foreach($taxinfo as $tax){ ?>
                    <li>
                        <strong><?php echo html_escape($tax->taxname); ?> <?php echo html_escape($tax->rate);?>%:</strong> <?php $singletax=0; $singletax=$tax->rate*$grprice/100;
                        echo html_escape($singletax); $totaltax+=$singletax; ?>
                    </li>
                    <?php } ?>
                <?php }else{ ?>
                    <?php $taskname = explode(",", $btaxinfo->taskname);
                    $rate = explode(",", $btaxinfo->rate); ?>
                    <?php for($bt=0; $bt<count($taskname); $bt++){ ?>
                    <li>
                        <strong><?php echo html_escape($taskname[$bt]); ?> <?php echo html_escape($rate[$bt]);?>%:</strong> <?php $singletax=0; $singletax=$rate[$bt]*$grprice/100;
                        echo html_escape($singletax); $totaltax+=$singletax; ?>
                    </li>
                    <?php } ?>
                <?php } ?>
                <li>
                    <strong><?php echo display('tax') ?> :</strong> <?php echo html_escape($totaltax);?>
                </li>
                <?php if($bookinfo->bookingstatus==5){ ?>
                    <?php if(isset($btaxinfo->complementary)){ ?>
                        <li>
                            <strong><?php echo display('complementary') ?> :</strong> <?php echo html_escape($btaxinfo->complementary);?>
                        </li>
                    <?php } ?>
                    <?php if(isset($btaxinfo->extrabpc)){ ?>
                        <li>
                            <strong><?php echo display("extra_bpc"); ?> :</strong> <?php echo html_escape($btaxinfo->extrabpc);?>
                        </li>
                    <?php } ?>
                    <?php if(isset($btaxinfo->ex_discount)){ ?>
                        <li>
                            <strong><?php echo display('discount') ?> :</strong> <?php echo html_escape($btaxinfo->ex_discount);?>
                        </li>
                        <?php $percent = ($btaxinfo->ex_discount*100)/$grprice;
                            $reducetax = ($totaltax*$percent)/100;
                            $totaltax-=$reducetax;
                         ?>
                    <?php } ?>
                    <?php if(isset($btaxinfo->additional_charges)){ ?>
                        <li>
                            <strong><?php echo display("additional_charges"); ?> :</strong> <?php echo html_escape($btaxinfo->additional_charges);?>
                        </li>
                    <?php } ?>
                    <?php if(isset($btaxinfo->special_discount)){ ?>
                        <li>
                            <strong><?php echo display("special_discount"); ?> :</strong> <?php echo html_escape($btaxinfo->special_discount);?>
                        </li>
                    <?php } ?>
                    <?php if(isset($btaxinfo->swimming_pool)){ ?>
                        <li>
                            <strong><?php echo display("swimming_pool"); ?> :</strong> <?php echo html_escape($btaxinfo->swimming_pool);?>
                        </li>
                    <?php } ?>
                    <?php if(isset($btaxinfo->restaurant)){ ?>
                        <li>
                            <strong><?php echo display("restaurant"); ?> :</strong> <?php echo html_escape($btaxinfo->restaurant);?>
                        </li>
                    <?php } ?>
                    <?php if(isset($btaxinfo->hallroom)){ ?>
                        <li>
                            <strong><?php echo display("hall_room"); ?> :</strong> <?php echo html_escape($btaxinfo->hallroom);?>
                        </li>
                    <?php } ?>
                    <?php 
                    $postedbill =  $btaxinfo->complementary+$btaxinfo->extrabpc-$btaxinfo->ex_discount+$btaxinfo->additional_charges-$btaxinfo->special_discount+$btaxinfo->swimming_pool+$btaxinfo->restaurant+$btaxinfo->hallroom; 
                }else{
                    $postedbill = 0;
                    $reducetax = 0;
                }
                ?>
                <li>
                    <strong><?php echo display('grand_total') ?>:</strong> <?php if($currency->position==1){echo html_escape($currency->curr_icon);}?><?php echo number_format($totaltax+$postedbill+$grprice,2);?><?php if($currency->position==2){echo html_escape($currency->curr_icon);}?>
                    <br /><strong><?php echo display('paid_amount') ?>:</strong> <?php if($currency->position==1){echo html_escape($currency->curr_icon);}?><?php if (!empty($bookinfo->paid_amount)){echo $bookinfo->paid_amount+$postedbill-$reducetax;} else echo "0";?><?php if($currency->position==2){echo html_escape($currency->curr_icon);}?>
                    <br /><strong><?php echo display('due_amount') ?>:</strong> <?php if($currency->position==1){echo html_escape($currency->curr_icon);}?><?php if (!empty($bookinfo->paid_amount)){echo ($grprice+$totaltax+$postedbill+$reducetax)-($bookinfo->paid_amount+$postedbill);} else echo html_escape($grprice+$totaltax+$postedbill);?><?php if($currency->position==2){echo html_escape($currency->curr_icon);}?>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="button" class="btn btn-info mr-2 print-list"onclick="printContent('printArea')"><span
    class="fa fa-print"></span></button>
</div>
</div>
<script src="<?php echo MOD_URL;?>room_reservation/assets/js/print.js"></script>
