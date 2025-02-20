<div id="add0" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('fl_details_add');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <?php echo form_open_multipart('transport_facility/transport_setting/create_flight_details') ?>
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="flight_num" class="col-sm-5 col-form-label"><?php echo display('flight_num') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="text" required name="flight_num" class="form-control" placeholder="<?php echo display('flight_num') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="airlience_name" class="col-sm-5 col-form-label"><?php echo display('airlience_name') ?></label>
                            <div class="col-sm-7">
                                <input type="text" name="airlience_name" class="form-control " placeholder="<?php echo display('airlience_name') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label"><?php echo display('departure') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="text" required name="departure" class="form-control datetimepickers" placeholder="<?php echo display('departure') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="arrival" class="col-sm-5 col-form-label"><?php echo display('arrival') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="text" required name="arrival" class="form-control datetimepickers" placeholder="<?php echo display('arrival') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fly_from" class="col-sm-5 col-form-label"><?php echo display('fly_from') ?> </label>
                            <div class="col-sm-7">
                                <input type="text" name="fly_from" class="form-control" placeholder="<?php echo display('fly_from') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fly_to" class="col-sm-5 col-form-label"><?php echo display('fly_to') ?> </label>
                            <div class="col-sm-7">
                            <input type="text" name="fly_to" class="form-control" placeholder="<?php echo display('fly_to') ?>">
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5" ><?php echo display('reset') ?></button>
                            <button id="disabledmode" type="submit" class="btn btn-success w-md m-b-5"><?php echo display('Ad') ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<div id="edit" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('fl_details_update');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body editinfo">

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
                <?php if ($this->permission->method('transport_facility', 'create')->access()) : ?>
                <h4><?php echo display('flight_details_list') ?>
                    <small class="float-right">
                        <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal">
                            <i class="ti-plus" aria-hidden="true"></i><?php echo display('fl_details_add') ?>
                        </button>
                    </small>
                </h4>       
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" id="exdatatable" class="datatable table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('flight_num') ?></th>
                                <th><?php echo display('airlience_name') ?></th>
                                <th><?php echo display('departure') ?></th>
                                <th><?php echo display('arrival') ?></th>
                                <th><?php echo display('fly_from') ?></th>
                                <th><?php echo display('fly_to') ?></th>
                                <th><?php echo display('action') ?></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($fdetails_list)) { ?>
                                <?php $sl = 1;?>
                                <?php foreach ($fdetails_list as $row) { ?>
                                    <tr class="">
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo html_escape($row->flight_num); ?></td>
                                        <td><?php echo html_escape($row->airlience_name); ?></td>
                                        <td><?php echo html_escape($row->departure); ?></td>
                                        <td><?php echo html_escape($row->arrival); ?></td>
                                        <td><?php echo html_escape($row->fly_from); ?></td>
                                        <td><?php echo html_escape($row->fly_to); ?></td>
                                        <td class="center">

                                            <?php if ($this->permission->method('transport_facility', 'update')->access()) : ?>
                                                <input name="url" type="hidden" id="url_<?php echo html_escape($row->flyid); ?>" value="<?php echo base_url("transport_facility/transport_setting/flight_details_updatefrm") ?>" />
                                                <a onclick="editinfo('<?php echo html_escape($row->flyid); ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a> 
                                            <?php endif; ?>

                                            <?php if ($this->permission->method('transport_facility', 'delete')->access()) : ?>
                                                <a href="<?php echo html_escape(base_url("transport_facility/transport_setting/delete_flight_details/".$row->flyid)) ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo display('are_you_sure') ?>')"  data-toggle="tooltip" data-placement="left" title="Delete"><i class="ti-trash" aria-hidden="true"></i>
                                                </a>
                                            <?php endif; ?>
                                            
                                        </td>
                                        
                                    </tr>
                                    <?php $sl++; ?>
                                <?php }; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                      </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>
    

