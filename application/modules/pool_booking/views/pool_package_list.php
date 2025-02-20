<div id="add0" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('pool_package_add');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <?php echo form_open_multipart('pool_booking/pool_setting/create_pool_package') ?>
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="package_name" class="col-sm-5 col-form-label"><?php echo display('package_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                                <input type="text" required name="package_name" class="form-control" placeholder="<?php echo display('package_name') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pool_name"
                                class="col-sm-5 col-form-label"><?php echo display('pool_name') ?><i class="text-danger">*</i> </label>
                            <div class="col-sm-7">
                                <?php echo form_dropdown('pool_name', $pool_list, null, 'class="form-control selectpicker" id="pool_name" required') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_from" class="col-sm-5 col-form-label"><?php echo display('date_from') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="text" required name="date_from" class="form-control datetimepickers" placeholder="<?php echo display('date_from') ?>">
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_to" class="col-sm-5 col-form-label"><?php echo display('date_to') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="text" required name="date_to" class="form-control datetimepickers" placeholder="<?php echo display('date_to') ?>">
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="price" class="col-sm-5 col-form-label"><?php echo display('price') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="text" required name="price" class="form-control " placeholder="<?php echo display('price') ?>">
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-5 col-form-label"><?php echo display('status') ?> </label>
                            <div class="col-sm-7">
                            <select class="form-control selectpicker" name="status" id="status" >
                                <option value="" selected="selected"><?php echo display('please_select_one') ?></option>
                                <option value="1"><?php echo display('active') ?></option>
                                <option value="0"><?php echo display('inactive') ?></option>
                                
                                </select>  
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pool_details" class="col-sm-5 col-form-label"><?php echo display('pool_details') ?> </label>
                            <div class="col-sm-7">
                            <textarea  name="pool_details" id="pool_details" placeholder="<?php echo display('pool_details') ?>" class="form-control"></textarea>
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="firstname" class="col-sm-5 col-form-label"><?php echo display('image') ?> </label>
                            <div class="col-sm-7">
                                <input type="file" accept="image/*" name="packagepicture" onchange="loadFile(event)" >
                                <a class="cattooltipsimg" data-toggle="tooltip" data-placement="top" title="Use only .jpg,.jpeg,.gif and .png Images">
                                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                                </a>
                                <small id="fileHelp" class="text-muted"><img src="<?php echo html_escape(base_url(!empty($intinfo->room_imagename)?$intinfo->room_imagename:'assets/img/room-setting/room_images.png')); ?>" 
                                id="output" class="img-thumbnail height_150_width_200px jsclrimg" />
                                </small>
                                <input type="hidden" name="old_image" value="<?php echo html_escape((!empty($intinfo->room_imagename)?$intinfo->room_imagename:null)) ?>">                                
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5" onclick="pooldataclrjs()"><?php echo display('reset') ?></button>
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
                <strong><?php echo display('update');?></strong>
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
            <?php if ($this->permission->method('pool_booking', 'create')->access()) : ?>
             <h4><?php echo display('pool_package_list') ?><small class="float-right">
             <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal">
                         <i class="ti-plus" aria-hidden="true"></i>
                         <?php echo display('pool_package_add') ?></button></small></h4>
                         <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" id="exdatatable" class="datatable table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('package_name') ?></th>
                                <th><?php echo display('pool_name') ?></th>
                                <th><?php echo display('price') ?></th>
                                <th><?php echo display('date_from') ?></th>
                                <th><?php echo display('date_to') ?></th>
                                <th><?php echo display('image') ?></th>
                                <th><?php echo display('status') ?></th>
                                <th><?php echo display('action') ?></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($poolpack_list)) { ?>
                                <?php $sl = 1;?>
                                <?php foreach ($poolpack_list as $row) { ?>
                                    <tr class="">
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo html_escape($row->package_name); ?></td>
                                        <td><?php echo html_escape($row->poolname); ?></td>
                                        <td><?php echo html_escape($row->price); ?></td>
                                        <td><?php echo html_escape($row->datetime_from); ?></td>
                                        <td><?php echo html_escape($row->datetime_to); ?></td>
                                        <td><img src="<?php echo html_escape(base_url(!empty($row->packageimage)?$row->packageimage:'assets/img/room-setting/room_images.png')); ?>" alt="Image" width="80"></td>
                                        <td><?php if($row->status == 1) echo display('active');
                                                
                                            if($row->status == 0) echo display('inactive');?></td>
                                       
                                        <td class="center">

                                            <?php if ($this->permission->method('pool_booking', 'update')->access()) : ?>
                                                <input name="url" type="hidden" id="url_<?php echo html_escape($row->packageid); ?>" value="<?php echo base_url("pool_booking/pool_setting/pool_package_updatefrm") ?>" />
                                                <a onclick="editinfo('<?php echo html_escape($row->packageid); ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a> 
                                            <?php endif; ?>

                                            <?php if ($this->permission->method('pool_booking', 'delete')->access()) : ?>
                                                <a href="<?php echo html_escape(base_url("pool_booking/pool_setting/pool_package_delete/" . $row->packageid)) ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo display('are_you_sure') ?>') "title="Delete "><i class="ti-trash" aria-hidden="true"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if($this->permission->method('pool_booking','update')->access()):?>
                                            <div class="text-right d-inline-block">
                                                <div class="actions d-inline-block">
                                                    <div class="dropdown action-item" data-toggle="dropdown">
                                                        <a href="#" class="action-item"><i class="ti-more-alt"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a onclick="changestatus3(0,'tbl_pool_package', <?php echo html_escape($row->packageid)?>, 'packageid')"  class="dropdown-item">InActive</a>
                                                            <a onclick="changestatus3(1,'tbl_pool_package', <?php echo html_escape($row->packageid)?>, 'packageid')" class="dropdown-item">Active</a>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    <script src="<?php echo MOD_URL.$module;?>/assets/js/poolImage.js"></script>

