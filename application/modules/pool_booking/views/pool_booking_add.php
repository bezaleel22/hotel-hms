<div class="col-md-12 px-0">
    <div class="row">
        <!--  table area -->
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                    <h5> <?php echo display('add_pool_booking') ?></h5>
                </div>
                <div class="card-body ">
                    <div class="table-responsive-sm">
                        <table width="100%" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><?php echo display('sl') ?></th>
                                    <th><?php echo display('package_name') ?></th>
                                    <th><?php echo display('unit_price') ?></th>
                                    <th><?php echo display('quantity') ?></th>
                                    <th><?php echo display('amount') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($package_list)) { ?>
                                <?php $sl = 1;?>
                                <?php foreach ($package_list as $row) { ?>
                                <tr class="">
                                    <td><?php echo $sl; ?></td>
                                    <td><span
                                            id="packname_<?php echo $sl; ?>"><?php echo html_escape($row->package_name); ?>
                                            <input type="hidden" name="packid_<?php echo $sl; ?>"
                                                id="packid_<?php echo $sl; ?>"
                                                value="<?php echo html_escape($row->packageid); ?>">
                                        </span>
                                    </td>
                                    <td><span
                                            id="packprice_<?php echo $sl; ?>"><?php echo html_escape($row->price); ?></span>
                                    </td>
                                    <td>
                                        <a onclick="addtominus('<?php echo $sl; ?>')" class="btn btn-info btn-sm p-plus-minus"
                                            data-toggle="tooltip" data-placement="left" title="Remove">
                                            <i class="ti-minus text-white" aria-hidden="true"></i></a>
                                        <input type="number" name="itqty" disabled id="itqty_<?php echo $sl; ?>"
                                            class="itqtycls" value="0" min="0">
                                        <a onclick="addtoplus('<?php echo $sl; ?>','newitemrow')"
                                            class="btn btn-info btn-sm p-plus-minus" data-toggle="tooltip" data-placement="left"
                                            title="Add">
                                            <i class="ti-plus text-white" aria-hidden="true"></i></a>
                                    </td>
                                    <td><span class="subpriceclr" id="subtprice_<?php echo $sl; ?>" >0.00</span></td>
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
                    <h5><?php echo display('add_customer') ?>
                        <small class="float-right">
                            <a href="<?php echo base_url("pool_booking/booking-list") ?>"
                                class="btn btn-primary btn-md">
                                <i class="ti-align-justify" aria-hidden="true"></i> <?php echo display('p_booking_list') ?>
                            </a>
                        </small>
                    </h5>
                </div>
                <div class="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group d-flex align-items-center add_cust">
                                    <div class="d-flex align-items-center d-inblock w-100 mr-2">
                                        <label for="customer" class="p-0 w-115"><?php echo display('select_customer') ?><span
                                                class="text-danger custar"></span>
                                        </label>
                                        <div class="ml-2 ml-in0 w-calc115">
                                            <?php echo form_dropdown('cust_id', $cust_list, null, 'class="form-control basic-single" id="cust_name"') ?>
                                        </div>
                                    </div>
                                    <button type="button" id="addcustbtn" class="btn btn-success"><i class="ti-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="newcust">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="doc_type" class="col-form-label"> </label>
                                    <div class="col-md-9">
                                    <select class="form-control basic-single" data-live-search="true" data-width="100%" onchange="newcustdata()" name="newcustomer_type" id="newcustomer_type">
                                        <option value="" selected="selected"><?php echo display('select_cust_type').' *' ?></option>
                                        <option value="newcust"><?php echo display('new_cust') ?></option>
                                        <option value="oldcust"><?php echo display('old_cust') ?></option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class=" form-group row">
                                    <label for="phone" class="col-form-label">
                                    </label>
                                    <div class="col-md-9">
                                        <input name="phone" class="form-control" type="number"
                                            placeholder="<?php echo display('phone') ?>" id="phonepool" autocomplete="off" readonly>
                                            <small id="mobile_msg" class=""><?php echo display('phone_must_unique') ?></small>
                                            <input type="hidden" type="number" id="unique_mobile_count">
                                    </div>
                                </div>
                            </div>
                            
                            <div hidden id="new_cust_data1" class="col-md-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="firstname" class="col-form-label"></label>
                                    <div class="col-sm-9">
                                        <input name="firstname" class="form-control" type="text"
                                            placeholder="<?php echo display('firstname').' *' ?>" id="firstname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="doc_type" class="col-form-label"> </label>
                                    <div class="col-sm-9">
                                        <select name="doc_type" id="doc_type" class="form-control basic-single">
                                            <option value="" selected="selected"> <?php echo display('doc_type').' *' ?>
                                            </option>
                                            <option value="1"><?php echo display('nid') ?></option>
                                            <option value="2"><?php echo display('passport') ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-form-label">
                                    </label>
                                    <div class="col-sm-9">
                                        <input name="email" class="form-control" type="text"
                                            placeholder="<?php echo display('email') ?>" id="email">
                                    </div>
                                </div>
                            </div>
                            <div hidden id="new_cust_data2" class="col-md-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="lastname" class="col-form-label">
                                    </label>
                                    <div class="col-sm-9">
                                        <input name="lastname" class="form-control" type="text"
                                            placeholder="<?php echo display('lastname') ?>" id="lastname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="doc_num" class="col-form-label"></label>
                                    <div class="col-sm-9">
                                        <input name="doc_num" id="doc_num" class="form-control" type="text"
                                            placeholder="<?php echo display('doc_num').' *' ?>" id="doc_num">
                                    </div>
                                </div>
                            </div>
                            <div hidden id="old_cust_data1" class="col-md-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="firstname" class="col-form-label"></label>
                                    <div class="col-sm-9">
                                    <?php echo form_dropdown('cust_idold',$oldcustlist,'','class="form-control basic-single" onchange="oldcustdatalist()" id="cust_idold"') ?>
                                    </div>
                                </div>
                            </div>
                            <div hidden id="old_cust_data2" class="col-md-6 col-lg-6">
                                <div class="form-group row">
                                    <label for="lastname" class="col-form-label">
                                    </label>
                                    <div class="col-sm-9">
                                    <input readonly name="oldfirstname" class="form-control" type="text"
                                            placeholder="<?php echo display('firstname').' *' ?>" id="oldfirstname">
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
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td id="tamountstr"><?php echo display('total_amount')?></td>
                                    <td id="tamount" class="text-center">00</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="row">                            
                            <div class="col-sm-12">
                                <input type="hidden" name="total_amount" id="total_amount">
                                <input type="hidden" id="finyear" value="<?php echo financial_year(); ?>">
                                <input type="hidden" id="findate" value="<?php echo maxfindate(); ?>">
                            </div>
                            <div class="col-sm-12">
                                <div class="align-content-center d-flex justify-content-between mt-2">
                                    <button id="bksvbtn2" onclick="pbooking_createinhouse()" class=" btn btn-success w-md m-b-5"><?php echo display('add_to_invoice') ?></button>
                                    <button id="bksvbtn" onclick="pbooking_create()" class="btn btn-success w-md m-b-5"><?php echo display('book_now') ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="poollastins" onchange="loadpdataview()" value="">
<div id="printdatadiv">
</div>
<script>
    
$(document).ready(function() {
    $("#dayClose").trigger("click");
    $("#previous").on("click", function() {
            window.location.href=baseurl+"dashboard/home";
  });
});
</script>

