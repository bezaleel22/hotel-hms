
<div id="add0" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('vehicle_details_add');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <?php echo form_open_multipart('transport_facility/transport_setting/create_vehicle_details') ?>
            
                <div class="row">
                
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="vehicle_number" class="col-sm-5 col-form-label"><?php echo display('vehicle_number') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="text" required name="vehicle_number" class="form-control" placeholder="<?php echo display('vehicle_number') ?>">
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vehicle_type" class="col-sm-5 col-form-label"><?php echo display('vehicle_type') ?><i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="text" required name="vehicle_type" class="form-control " placeholder="<?php echo display('vehicle_type') ?>">
                            
                            </div>
                        </div>
                        

                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label"><?php echo display('fuel_type') ?> </label>
                            <div class="col-sm-7">
                            <input type="text" name="fuel_type" class="form-control" placeholder="<?php echo display('fuel_type') ?>">
                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="seat_capacity" class="col-sm-5 col-form-label"><?php echo display('seat_capacity') ?> </label>
                            <div class="col-sm-7">
                            <input type="text" name="seat_capacity" class="form-control" placeholder="<?php echo display('seat_capacity') ?>">
                            
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
                <strong><?php echo display('vehicle_details_edit');?></strong>
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
             <h4><?php echo display('vehicle_details_list') ?><small class="float-right">
             <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal">
                         <i class="ti-plus" aria-hidden="true"></i>
                         <?php echo display('vehicle_details_add') ?></button></small></h4>
                         <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" id="exdatatable" class="datatable table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('vehicle_number') ?></th>
                                <th><?php echo display('vehicle_type') ?></th>
                                <th><?php echo display('fuel_type') ?></th>
                                <th><?php echo display('seat_capacity') ?></th>
                                <th><?php echo display('action') ?></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($vedtls_list)) { ?>
                                <?php $sl = 1;?>
                                <?php foreach ($vedtls_list as $row) { ?>
                                    <tr class="">
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo html_escape($row->vehicle_number); ?></td>
                                        <td><?php echo html_escape($row->vehicle_type); ?></td>
                                        <td><?php echo html_escape($row->fuel_type); ?></td>
                                        <td><?php echo html_escape($row->seat_capacity); ?></td>
                                        
                                        <td class="center">

                                            <?php if ($this->permission->method('transport_facility', 'update')->access()) : ?>
                                                <input name="url" type="hidden" id="url_<?php echo html_escape($row->vdsid); ?>" value="<?php echo base_url("transport_facility/transport_setting/vehicle_details_updatefrm") ?>" />
                                                <a onclick="editinfo('<?php echo html_escape($row->vdsid); ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a> 
                                            <?php endif; ?>

                                            <?php if ($this->permission->method('transport_facility', 'delete')->access()) : ?>
                                                <a href="<?php echo html_escape(base_url("transport_facility/transport_setting/delete_vehicle_details/".$row->vdsid)) ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo display('are_you_sure') ?>')"  data-toggle="tooltip" data-placement="left" title="Delete"><i class="ti-trash" aria-hidden="true"></i>
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
    

