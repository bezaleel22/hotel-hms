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
                            value="<?php echo base_url("house_keeping/report/getreport") ?>" id="recordurl" />
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
                        <h4><?php echo display("cleaning_report"); ?><small class="float-right"><button id="filter" type="button"
                                    class="btn btn-primary btn-md">
                                    <?php echo display('filter')?></button></small></h4>
                    </div>


                    <div class="card-body">
                        <table width="100%" id="exdatatable"
                            class="datatable table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo display('sl_no') ?></th>
                                    <th><?php echo display('emp_id') ?></th>
                                    <th><?php echo display('employee_id') ?></th>
                                    <th><?php echo display('complete') ?></th>
                                    <th><?php echo display('pending') ?></th>
                                    <th><?php echo display("underprocess"); ?></th>
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
                                    <td><?php echo html_escape($type->employee_id); ?></td>
                                    <td><?php echo html_escape($type->completed); ?></td>
                                    <td><?php echo html_escape($type->pending); ?></td>
                                    <td><?php echo html_escape($type->underprocess); ?></td>

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