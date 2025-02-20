<div class="row justify-content-center">
    <div class="col-sm-12" id="printin">
        <div class="col-auto">
        <?php if($this->permission->method('pool_booking','update')->access()): ?>
            <a href="<?php echo html_escape(base_url("pool_booking/pool_setting/pool_booking_updatefrm/" . $poolpadata->pbookingid)) ?>"
                class="btn btn-success ml-2"><i class="typcn typcn-edit mr-1"></i><?php echo display('update')?> </a>
                <?php endif; ?>
                

        </div>
        <!--/.End of header-->
        <div class="card card-body p-5">
            <div class="row">
                <div class="col-12 col-md-6">
                    <p class="text-muted mb-4">
                        <strong><?php echo display('cust_name').' : '?></strong><?php echo html_escape($poolpadata->firstname.' '.$poolpadata->lastname);?><br>
                        <strong><?php echo display('total_amount').' : ' ?></strong><?php echo html_escape($poolpadata->total_amount);?><br>
                        
                        <strong><?php echo display('status')?></strong>:<?php if($poolpadata->status == 1){echo ' Paid';}else if($poolpadata->status == 2){echo ' Unpaid';}else if($poolpadata->status == 3){echo ' Cancle';} ?><br>
                    </p>
                </div>
                <div class="col-12 col-md-6 text-md-right">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table my-4">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>

                                <th><?php echo display('package_name') ?></th>
                                <th><?php echo display('unit_price') ?></th>
                                <th><?php echo display('subtotal') ?></th>
                                

                            </tr>
                        </thead>
                        <tbody id="newitemrow">

                        <?php if (!empty($bookitem_data_show)) { ?>
                            <?php  $sl = 1;?>
                                <?php foreach ($bookitem_data_show as $row) { ?>
                                
                                    <?php $itemid = $row->packageid;?>
                                    <tr id="itemrow_<?php echo html_escape($itemid); ?>">
                                        <td><i class="ti-control-record" ></i></td>
                                        <td><?php echo html_escape($row->package_name)?></td>
                                        <td><span id="listitmqty_<?php echo html_escape($itemid); ?>"><?php echo html_escape($row->itemqty)?></span><?php echo 'X'. $row->perprice?></td>
                                        <td class="listitmtotal" id="listitmtotal_<?php echo html_escape($itemid); ?>"><?php echo html_escape($row->total_price)?></td>
                                        
                                            
                                    </tr>

                                    <?php $sl++; ?>
                                <?php }; ?>
                            <?php } ?>
                           

                        
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>