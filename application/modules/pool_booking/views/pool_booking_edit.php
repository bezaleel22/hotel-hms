<?php echo form_open_multipart('pool_booking/pool_setting/booking_update'); ?>
<?php echo form_hidden('pbookingid', (!empty($bookdata->pbookingid)?$bookdata->pbookingid:null)) ?>
<div class="col-md-12 px-0">

    <div class="row">
        <!--  table area -->
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                    <h5> <?php echo display('update_pool_booking') ?></h5>
                </div>
                <div class="card-body ">
                    <div class="table-responsive-sm">
                        <table width="100%" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><?php echo display('sl') ?></th>
                                    <th><?php echo display('package_name') ?></th>
                                    <th><?php echo display('unit_price') ?></th>
                                    <th stylr="padding-left: 32px;"><?php echo display('quantity') ?></th>
                                    <th><?php echo display('amount') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($package_list)) { ?>
                                <?php $sl = 1;?>
                                <?php foreach ($package_list as $row) { ?>
                                <tr class="">
                                    <td><?php $itemid = $row->packageid; echo $sl; ?></td>
                                    <td><span
                                            id="packname_<?php echo html_escape($itemid); ?>"><?php echo html_escape($row->package_name); ?>
                                            <input type="hidden" name="packid_<?php echo html_escape($itemid); ?>"
                                                id="packid_<?php echo html_escape($itemid); ?>"
                                                value="<?php echo html_escape($row->packageid); ?>"></span>
                                    </td>
                                    <td><span
                                            id="packprice_<?php echo html_escape($itemid); ?>"><?php echo html_escape($row->price); ?></span>
                                    </td>
                                    <td>
                                        <a onclick="addtominus('<?php echo html_escape($itemid); ?>')" class="btn btn-info btn-sm p-plus-minus"
                                            data-toggle="tooltip" data-placement="left" title="Add">
                                            <i class="ti-minus text-white" aria-hidden="true"></i></a>

                                        <?php $bookeditem = $this->db->select('*')->from('tbl_pool_bookingitem')->where('pbokingid',$bookdata->pbookingid)->where('packageid',$row->packageid)->get()->row();?>

                                        <input type="number" name="itqty" disabled id="itqty_<?php echo html_escape($itemid); ?>"
                                            class="itqtycls"
                                            value="<?php if($bookeditem){ echo html_escape($bookeditem->itemqty);}else{echo 0;}; ?>"
                                            min="0">

                                        <a onclick="addtoplus('<?php echo html_escape($itemid); ?>','newitemrow')"
                                            class="btn btn-info btn-sm p-plus-minus" data-toggle="tooltip" data-placement="left"
                                            title="Add">
                                            <i class="ti-plus text-white" aria-hidden="true"></i></a>
                                    </td>
                                    <?php $bookeditem = $this->db->select('*')->from('tbl_pool_bookingitem')->where('pbokingid',$bookdata->pbookingid)->where('packageid',$row->packageid)->get()->row();?>
                                    <td><span
                                            id="subtprice_<?php echo html_escape($itemid); ?>"><?php if($bookeditem){ echo html_escape($bookeditem->total_price);}else{echo '0.00';}; ?></span>
                                    </td>
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
        <div class="col-xl-5">
            <div class="card mb-4 mt-4 mt-xl-0">
                <div class="card-header">
                    <h5><?php  echo display('customer_edit'); ?>
                    <small class="float-right">
                            <a href="<?php echo base_url("pool_booking/booking-list") ?>"
                                class="btn btn-primary btn-md">
                                <i class="ti-align-justify" aria-hidden="true"></i> <?php echo display('p_booking_list') ?>
                            </a>
                        </small></h5>
                </div>
                <div class="">
                    <div class="card-body">
                        <div class="row">
                            <p id="pid"></p>
                            <div class="col-md-12 ">
                                <div class="form-group d-flex align-items-center add_cust ml-5 mr-5">
                                    <div class="d-flex align-items-center d-inblock w-100 mr-2">
                                        <label for="customer" class="p-0 w-115"><?php echo display('customer') ?><span
                                                class="text-danger custar"></span>
                                        </label>
                                        <div class="ml-2 ml-in0 w-calc115">
                                            <?php $cust_name = $this->db->select('firstname')->from('customerinfo')->where('customerid',$bookdata->custid)->get()->row();?> 
                                            <input name="cust_nameshow" disabled class="form-control" type="text"
                                                value="<?php echo html_escape($cust_name->firstname)?>" id="cust_nameshow">

                                            <input name="cust_id" class="form-control" type="hidden"
                                                value="<?php echo html_escape($bookdata->custid)?>" id="cust_id">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" id="addcustbtn" hidden class="btn btn-success"><i
                                        class="ti-plus"></i></button>
                            </div>
                        </div>
                        <div class="row" id="newcust">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="doc_type" class="col-form-label"> </label>
                                    <div class="col-sm-9">
                                        <select name="doc_type" id="doc_type" class="form-control basic-single">
                                            <option value="" selected="selected"> <?php echo display('doc_type').' *' ?></option>
                                            <option value="1"><?php echo display('nid') ?></option>
                                            <option value="2"><?php echo display('passport') ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="firstname"
                                        class=" col-form-label"> </label>
                                    <div class="col-sm-9">
                                        <input name="firstname" class="form-control" type="text"
                                            placeholder="<?php echo display('firstname').' *' ?>" id="firstname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lastname"
                                        class=" col-form-label"> </label>
                                    <div class="col-sm-9">
                                        <input name="lastname" class="form-control" type="text"
                                            placeholder="<?php echo display('lastname') ?>" id="lastname">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="doc_num" class="col-form-label"></label>
                                    <div class="col-sm-9">
                                        <input name="doc_num" id="doc_num" class="form-control" type="text"
                                            placeholder="<?php echo display('doc_num').' *' ?>" id="doc_num">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email"
                                        class=" col-form-label"> </label>
                                    <div class="col-sm-9">
                                        <input name="email" class="form-control" type="text"
                                            placeholder="<?php echo display('email') ?>" id="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone"
                                        class=" col-form-label"> </label>
                                    <div class="col-sm-9">
                                        <input name="phone" class="form-control" type="text"
                                            placeholder="<?php echo display('phone') ?>" id="phone">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5><?php echo display('pool_booking_list') ?></h5>
                </div>
                <div class="row">
                    <div class="card-body itemcartcont">
                        <table width="100%" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><?php echo display('sl') ?></th>
                                    <th><?php echo display('package_name') ?></th>
                                    <th><?php echo display('unit_price') ?></th>
                                    <th><?php echo display('amount') ?></th>
                                    <th class="text-center"><?php echo display('action') ?></th>
                                </tr>
                            </thead>
                            <tbody id="newitemrow">

                                <?php if (!empty($bookitem_data)) { ?>
                                <?php  $sl = 1;?>
                                <?php foreach ($bookitem_data as $row) { ?>

                                <?php $itemid = $row->packageid;?>
                                <tr id="itemrow_<?php echo html_escape($itemid); ?>">
                                    <td><i class="ti-control-record"></i></td>
                                    <td><?php echo html_escape($row->package_name)?></td>
                                    <td><span
                                            id="listitmqty_<?php echo html_escape($itemid); ?>"><?php echo html_escape($row->itemqty)?></span><?php echo 'X'. $row->perprice?>
                                    </td>
                                    <td class="text-center" class=" listitmtotal"
                                        id="listitmtotal_<?php echo html_escape($itemid); ?>">
                                        <?php echo html_escape($row->total_price)?></td>
                                    <td class="text-center"><button class="btn btn-xs btn-danger" type="button"
                                            value="Delete" onclick="removerow2(this,<?php echo html_escape($itemid); ?>)">
                                            <i class="ti-trash" aria-hidden="true"></i> </button></td>
                                    <input type="hidden" name="package_idinp[]" value="<?php echo html_escape($row->packageid)?>"
                                        id="package_nameinp_<?php echo html_escape($itemid); ?>">
                                    <input type="hidden" name="per_priceinp[]" id="per_priceinp_<?php echo html_escape($itemid); ?>"
                                        value="<?php echo html_escape($row->perprice)?>">
                                    <input type="hidden" name="itemqtyinp[]" value="<?php echo html_escape($row->itemqty)?>"
                                        id="itemqtyinp_<?php echo html_escape($itemid); ?>">
                                    <input type="hidden" class="mysubtotal" name="sub_totalinp[]"
                                        value="<?php echo html_escape($row->total_price)?>" id="sub_totalinp_<?php echo html_escape($itemid); ?>">
                                </tr>
                                <?php $sl++; ?>
                                <?php }; ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td id="tamountstr"><?php echo display('total_amount')?></td>
                                    <td id="tamount" class="text-center"><?php echo html_escape($bookdata->total_amount)?></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="row">
                            <input type="hidden" name="total_amount" id="total_amount"
                                value="<?php echo html_escape($bookdata->total_amount)?>">
                            <div class="col-sm-12 text-right">

                                <button type="submit" id="bksvbtn" 
                                    class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<?php echo form_close() ?>
