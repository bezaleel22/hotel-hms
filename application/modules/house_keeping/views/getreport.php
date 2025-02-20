<div class="card print-content">
    <div class="row">
        <!--  table area -->
        <div class="col-sm-12">

            <div class="card-header">
                <h4><?php echo display("searched_report"); ?><small class="float-right right-button">
                        <button type="button" class="btn btn-success btn-md print-btn mr-1">
                            <?php echo display("print") ?></button><button id="filter" type="button"
                            class="btn btn-primary btn-md">
                            <?php echo display("filter")?></button></small></h4>
            </div>


            <div class="card-body">
                <table width="100%" id="exdatatable" class="datatable table table-striped table-bordered table-hover">
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

<script src="<?php echo MOD_URL.$module;?>/assets/js/searchReport.js"></script>