<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card mb-4" id="filter-form" hidden>
            <div class="card-header">
                <h4><?php echo display('search_report'); ?></h4>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <?php echo form_open('report/index',array('class' => 'form-inline'))?>
                        <div class="form-group">
                            <label class="padding_right_5px col-form-label"
                                for="from_date"><?php echo display('emp_id') ?>
                            </label>
                            <select name="employee_id" class="selectpicker form-control w-138 col-form-label"
                                data-live-search="true" id="employee_id" required="">
                                <option value="" selected="selected"><?php echo display('emp_id') ?>
                                </option>
                                <?php foreach($employee as $em){ ?>
                                <option value="<?php echo html_escape($em->employee_id); ?>">
                                    <?php echo html_escape($em->first_name); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="padding_right_5px col-form-label"
                                for="from_date"><?php echo display('start_date') ?>
                            </label>
                            <input type="text" name="start_date" value="<?php echo date('Y-m-d')?>"
                                class="form-control datepickers" id="start_date"
                                placeholder="<?php echo display('start_date') ?>">
                        </div>

                        <div class="form-group">
                            <label class="padding_0_5px col-form-label" for="to_date"> <?php echo display('end_date') ?>
                            </label>
                            <input type="text" name="to_date" value="<?php echo date('Y-m-d')?>"
                                class="form-control datepickers" id="to_date" placeholder="<?php echo display("to"); ?>">
                        </div>
                        <input name="recordurl" type="hidden"
                            value="<?php echo base_url("house_keeping/report/getrecord") ?>" id="recordurl" />
                        &nbsp;<a class="btn btn-success" onclick="searchrecords()"><span class="text-white">
                                <?php echo display('search') ?></span></a>&nbsp;
                        <?php echo form_close()?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" id="recordlist">
            <div class="row">
                <!--  table area -->
                <div class="col-sm-12">

                    <div class="card-header">
                        <h4><?php echo display("all_records"); ?><small class="float-right">
                                <button id="filter" type="button" class="btn btn-primary btn-md">
                                    <?php echo display('filter')?></button></small></h4>
                    </div>


                    <div class="card-body">
                        <table width="100%" id="exdatatable"
                            class="datatable table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo display('sl_no') ?></th>
                                    <th><?php echo display('emp_id') ?></th>
                                    <th><?php echo display('room_no') ?></th>
                                    <th><?php echo display('roomtype') ?></th>
                                    <th><?php echo display('s_time') ?></th>
                                    <th><?php echo display('e_time') ?></th>
                                    <th><?php echo display('checklist') ?></th>
                                    <th><?php echo display('product_list') ?></th>
                                    <th><?php echo display('quantity') ?></th>
                                    <th><?php echo display("assign_by"); ?></th>
                                    <th><?php echo display('status') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($totalcount)) {
                        ?>
                                <?php $sl = 1; ?>
                                <?php foreach ($totalcount as $type) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo html_escape($type->first_name); ?></td>
                                    <td><?php echo html_escape($type->roomno); ?></td>
                                    <td><?php echo html_escape($type->roomtype); ?></td>
                                    <td><?php echo html_escape($type->date_start); ?></td>
                                    <td><?php echo html_escape($type->date_end); ?></td>
                                    <?php if((!empty($type->checklist)?$type->checklist:0)){ ?>
                                    <td><?php echo html_escape($type->checklist); ?></td>
                                    <?php }else{ ?>
                                    <td><?php echo display("no"); ?></td>
                                    <?php } ?>
                                    <?php if((!empty($type->productlist)?$type->productlist:0)){ ?>
                                    <td><?php echo html_escape($type->productlist); ?></td>
                                    <?php }else{ ?>
                                    <td><?php echo display("no"); ?></td>
                                    <?php } ?>
                                    <td><?php echo html_escape($type->allproductqty); ?></td>
                                    <td><?php echo html_escape($type->firstname); ?></td>
                                    <td><?php if($type->status==1){echo display("completed");}if($type->status==0){echo display("pending");}if($type->status==2){echo display("underprocess");} ?>
                                    </td>
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
    </div>
</div>
<script src="<?php echo MOD_URL.$module;?>/assets/js/searchReport.js"></script>