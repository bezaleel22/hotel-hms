
<div id="add0" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('vehicle_booking_add');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <?php echo form_open_multipart('transport_facility/transport_setting/create_vehicle_booking') ?>
            
                <div class="row">
                
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="customer_name" class="col-sm-5 col-form-label"><?php echo display('customer_name') ?><i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <?php echo form_dropdown('cust_id', $cust_list, null, 'class="form-control basic-single" id="cust_id" required') ?>                            
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vehicle_number" class="col-sm-5 col-form-label"><?php echo display('vehicle_number') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <?php echo form_dropdown('vehicle_id', $vehicle_list, null, 'class="form-control basic-single" id="vehicle_id" required') ?>                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label"><?php echo display('flight_num') ?> <i class="text-danger">*</i> </label>
                            <div class="col-sm-7">
                            <?php echo form_dropdown('flight_id', $flight_list, null, 'class="form-control basic-single" onchange="flight_info()" id="flight_id" required') ?>                            
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="driver" class="col-sm-5 col-form-label"><?php echo display('driver') ?><i class="text-danger">*</i> </label>
                            <div class="col-sm-7">
                            <?php echo form_dropdown('driver_id', $driver_list, null, 'class="form-control basic-single" id="driver_id" required') ?>
                            
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label"><?php echo display('departure') ?> </label>
                            <div class="col-sm-7">
                            <input type="text" name="departure" id="departure" disabled class="form-control" placeholder="<?php echo display('departure') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="arrival" class="col-sm-5 col-form-label"><?php echo display('arrival') ?></label>
                            <div class="col-sm-7">
                            <input type="text" name="arrival" id="arrival" disabled class="form-control" placeholder="<?php echo display('arrival') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="transportation_type" class="col-sm-5 col-form-label"><?php echo display('transportation_type') ?><i class="text-danger">*</i>  </label>
                            <div class="col-sm-7">
                            <select name="transportation_type" id="transportation_type" required class="form-control basic-single">
                                <option value="" selected="selected"><?php echo display('please_select_one') ?></option>
                                <option value="Pick Up"><?php echo display('pick_up') ?></option>
                                <option value="Drop Off"><?php echo display('drop_off') ?></option>
                                
                                </select>                             
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="" class="col-sm-5 col-form-label"><?php echo display('transportation_time') ?><i class="text-danger">*</i> </label>
                            <div class="col-sm-7">
                            <input type="text" required name="transportation_time" class="form-control datetimepickers" placeholder="<?php echo display('transportation_time') ?>">

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
    <div class="card mb-4">
            <div class="card-header">
                <h4><?php echo display('search_report'); ?>
                    <small class="float-right">
                        <?php if ($this->permission->method('transport_facility', 'create')->access()) : ?>
                        <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal">
                            <i class="ti-plus" aria-hidden="true"></i>
                            <?php echo display('vehicle_booking_add') ?>
                        </button>
                    </small>
                    <?php endif; ?>
                </h4>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <?php echo form_open('',array('class' => 'form-inline'))?>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="padding_right_5px col-form-label"
                                    for="from_date"><?php echo display('start_date') ?>
                                </label>
                                <input type="text" name="start_date" value=""
                                    class="form-control datepickers" id="start_date"
                                    placeholder="<?php echo display('start_date') ?>">
                            </div>
                        </div>
                        <div class="col-sm-4 row">
                            <div class="form-group">
                                <label class="padding_0_5px col-form-label" for="to_date"> <?php echo display('end_date') ?>
                                </label>
                                <input type="text" name="to_date" value=""
                                    class="form-control datepickers" id="to_date" placeholder="<?php echo "To"; ?>">
                            </div>
                            <input name="vbookurl" type="hidden" value="<?php echo base_url("transport_facility/Transport_setting/getvbook") ?>" id="vbookurl" />&nbsp;
                            <a class="btn btn-success ml-5" onclick="showvbooksearch()">
                                <span class="text-white"><?php echo display('search') ?></span>
                            </a>&nbsp;
                        </div>
                        
                        <?php echo form_close()?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4 d_none p-2" id="report_show">
            <div class="row" id="printArea">
                <div class="col-sm-12 col-md-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-header">
                                <h4>
                                    <?php echo display('vehicle_booking_report') ?>
                                    <small class="float-right">
                                        <input type="button" class="btn btn-info button-print text-white"
                                            name="btnPrint" id="btnPrint" value="Print"
                                            onclick="printContentvbook('printArea')" />
                                    </small>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div id="itemlist" class="text-center">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" id="hide_report">
            <div class="card-header">
                <h4><?php echo display('vehicle_booking_list') ?></h4>
                         
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" id="exdatatable" class="datatable table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('vehicle_number') ?></th>
                                <th><?php echo display('vehicle_type') ?></th>
                                <th><?php echo display('driver') ?></th>
                                <th><?php echo display('customer_name') ?></th>
                                <th><?php echo display('flight_num') ?></th>
                                <th><?php echo display('transportation_type') ?></th>
                                <th><?php echo display('transportation_time') ?></th>
                                <th><?php echo display('action') ?></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($vebook_list)) { ?>
                                <?php $sl = 1;?>
                                <?php foreach ($vebook_list as $row) { ?>
                                    <tr class="">
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo html_escape($row->vehicle_number); ?></td>
                                        <td><?php echo html_escape($row->vehicle_type); ?></td>
                                        <td><?php echo html_escape($row->driver); ?></td>
                                        <td><?php echo html_escape($row->firstname); ?></td>
                                        <td><?php echo html_escape($row->flight_num); ?></td>
                                        <td><?php echo html_escape($row->transportation_type); ?></td>
                                        <td><?php echo html_escape($row->transportation_time); ?></td>
                                        
                                        <td class="center">

                                            <?php if ($this->permission->method('transport_facility', 'update')->access()) : ?>
                                                <input name="url" type="hidden" id="url_<?php echo html_escape($row->vbkid); ?>" value="<?php echo base_url("transport_facility/transport_setting/vehicle_booking_updatefrm") ?>" />
                                                <a onclick="editinfo('<?php echo html_escape($row->vbkid); ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a> 
                                            <?php endif; ?>

                                            <?php if ($this->permission->method('transport_facility', 'delete')->access()) : ?>
                                                <a href="<?php echo html_escape(base_url("transport_facility/transport_setting/delete_vehicle_booking/".$row->vbkid)) ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo display('are_you_sure') ?>')"  data-toggle="tooltip" data-placement="left" title="Delete"><i class="ti-trash" aria-hidden="true"></i>
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
    

