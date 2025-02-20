<link type="text/css" href="<?php echo MOD_URL.$module;?>/assets/css/laundry_list.css">
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display("manage_ingradient");?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="card">

                            <div class="card-body">

                                <?php echo form_open('house_keeping/house_keeping/save_laundry') ?>
                                <?php echo form_hidden('id', (!empty($intinfo->id)?$intinfo->id:null)) ?>
                                <div class="form-group row">
                                    <label for="emp_id"
                                        class="col-sm-3 col-form-label"><?php echo display('employee_name') ?> <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo form_dropdown('emp_id',$empdropdown,'','required id="emp_id" class="form-control"') ?>
                                    </div>
                                </div>
                                <div class="form-group row" id="product">
                                    <label for="product_id" class="col-sm-3 col-form-label"><?php echo display("litem_name"); ?>
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo form_dropdown('product_id[]',$productdropdown,'','id="product_id" class="form-control" multiple') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="type" class="col-sm-3 col-form-label"><?php echo display('type') ?>
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="" selected="selected"><?php echo display('select_type') ?>
                                            </option>
                                            <option value="add"><?php echo display('send') ?></option>
                                            <option value="recieve"><?php echo display("recieve"); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" id="invoice" hidden>
                                    <label for="invoice_no"
                                        class="col-sm-3 col-form-label"><?php echo display('invoice_no') ?>
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo form_dropdown('invoice_no',$invoicelist,'', 'class="selectpicker form-control" data-live-search="true" id="invoice_no"') ?>
                                    </div>
                                </div>

                                <div id="add_laundry"></div>

                                <div class="form-group text-right">
                                    <button type="submit" id="sbmtbtn" hidden
                                        class="btn btn-success w-md m-b-5"><?php echo display('Ad') ?></button>
                                </div>
                                <input type="hidden" name="finyear" value="<?php echo financial_year(); ?>">
                                <?php echo form_close() ?>

                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
        <div class="modal-footer">

        </div>

    </div>

</div>

<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('update_ingredient');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body editunit">

            </div>

        </div>
        <div class="modal-footer">

        </div>

    </div>

</div>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <h4><?php echo display("laundry")." ".display("item_list"); ?><small
                        class="float-right"><?php if($this->permission->method('units','create')->access()): ?>
                        <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"><i
                                class="ti-plus" aria-hidden="true"></i>
                            <?php echo display('manage_ingradient')?></button>
                        <?php endif; ?></small></h4>
            </div>
            <div class="card-body">
                <table width="100%" id="exdatatable" class="datatable2 table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('invoice_no') ?></th>
                            <th><?php echo display("litem_name"); ?></th>
                            <th><?php echo displaY("operate_by") ?></th>
                            <th><?php echo display("task_name"); ?></th>
                            <th><?php echo display("item_cost"); ?></th>
                            <th><?php echo display('quantity') ?></th>
                            <th><?php echo display("total_cost"); ?></th>
                            <th><?php echo display('type') ?></th>
                            <th><?php echo display('payment_status') ?></th>
                            <th><?php echo display('comments') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($laundry)) { ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($laundry as $ingredient) { ?>
                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                            <td><?php echo $sl; ?></td>
                            <td><?php echo html_escape($ingredient->invoice_no); ?></td>
                            <td><?php echo html_escape($ingredient->product_name); ?></td>
                            <td><?php echo html_escape($ingredient->first_name); ?></td>
                            <td><?php echo html_escape($ingredient->checklist); ?></td>
                            <td><?php echo html_escape($ingredient->item_cost); ?></td>
                            <td><?php echo html_escape($ingredient->quantity); ?></td>
                            <td><?php echo html_escape($ingredient->total_cost); ?></td>
                            <td><?php echo html_escape(ucfirst($ingredient->type)); ?></td>
                            <td><?php if($ingredient->status==1){echo display("paid");}else{echo display("unpaid");} ?></td>
                            <td><?php echo html_escape($ingredient->comment); ?></td>

                        </tr>
                        <?php $sl++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table> <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="product_list" value="">
<input type="hidden" id="all_checklist" value="">
<script src="<?php echo MOD_URL.$module;?>/assets/js/laundry_list.js"></script>