<div class="card">
    <?php if($this->permission->method('house_keeping','create')->access()): ?>
    <div class="card-header">
        <h4><?php echo display('room_cleaning')?></h4>
    </div>
    <?php endif; ?>
    <div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><?php echo display('room_cleaning_details');?></strong>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body editinfo">
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
    <?php if($this->permission->method('house_keeping','read')->access()): ?>
    <div class="row">
        <!--  table area -->
        <div class="col-sm-12">
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="datatable table table-striped table-bordered table-hover"
                        id="bookingdetails">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('employee_id') ?></th>
                                <th><?php echo display('name') ?></th>
                                <th><?php echo display('room_no') ?></th>
                                <th><?php echo display('date') ?></th>
                                <th><?php echo display('status') ?></th>
                                <th><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                    </table> <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script src="<?php echo MOD_URL.$module;?>/assets/js/room_cleaning.js"></script>