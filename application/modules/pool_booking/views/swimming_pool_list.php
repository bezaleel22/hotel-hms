
<div id="add0" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('swimming_pool_add');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <?php echo form_open('pool_booking/pool_setting/create_pool') ?>
                <div class="row">
                
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="pool_name" class="col-sm-5 col-form-label"><?php echo display('pool_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="text" required name="pool_name" class="form-control" placeholder="<?php echo display('pool_name') ?>">
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type_name"
                                class="col-sm-5 col-form-label"><?php echo display('type_name') ?><i class="text-danger">*</i> </label>
                            <div class="col-sm-7">
                            <?php echo form_dropdown('type_name', $pool_ty_list, null, 'class="form-control basic-single" id="type_name" required') ?>
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-5 col-form-label"><?php echo display('status') ?> </label>
                            <div class="col-sm-7">
                            <select class="form-control basic-single"   name="status" id="status" >
                                <option value="" selected="selected"><?php echo display('please_select_one') ?></option>
                                <option value="1"><?php echo display('active') ?></option>
                                <option value="2"><?php echo display('un_maintenence') ?></option>
                                <option value="3"><?php echo display('booked') ?></option>
                                <option value="0"><?php echo display('inactive') ?></option>
                                
                                </select>  
                            </div>
                        </div>
                        

                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group row">
                            <label for="capacity" class="col-sm-5 col-form-label"><?php echo display('capacity') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-7">
                            <input type="number" required name="capacity" class="form-control" placeholder="<?php echo display('capacity') ?>">
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="remarks" class="col-sm-5 col-form-label"><?php echo display('remarks') ?> </label>
                            <div class="col-sm-7">
                            <textarea  name="remarks" id="remarks" placeholder="<?php echo display('remarks') ?>" class="form-control"></textarea>
                            
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
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
                <strong><?php echo display('update_legal_documentation');?></strong>
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
             <h4><?php echo display('swimming_pool_list') ?><small class="float-right">
             <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal">
                         <i class="ti-plus" aria-hidden="true"></i>
                         <?php echo display('swimming_pool_add') ?></button></small></h4>
                         <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" id="exdatatable" class="datatable table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('name') ?></th>
                                <th><?php echo display('type_name') ?></th>
                                <th><?php echo display('capacity') ?></th>
                                <th><?php echo display('status') ?></th>
                                <th><?php echo display('action') ?></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pool_list)) { ?>
                                <?php $sl = 1;?>
                                <?php foreach ($pool_list as $row) { ?>
                                    <tr class="">
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo html_escape($row->poolname); ?></td>
                                        <td><?php echo html_escape($row->pooltype); ?></td>
                                        <td><?php echo html_escape($row->capacity); ?></td>
                                        <td><?php if($row->status == 1) echo display('active');
                                                  if($row->status == 2) echo display('un_maintenence');    
                                                  if($row->status == 0) echo display('inactive');
                                                  if($row->status == 3) echo display('booked');?></td>
                                       
                                       
                                        <td class="center">

                                            <?php if ($this->permission->method('pool_booking', 'update')->access()) : ?>
                                                <input name="url" type="hidden" id="url_<?php echo html_escape($row->poolid); ?>" value="<?php echo base_url("pool_booking/pool_setting/pool_update") ?>" />
                                                <a onclick="editinfo('<?php echo html_escape($row->poolid); ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a> 


                                            <?php endif; ?>

                                            <?php if ($this->permission->method('pool_booking', 'delete')->access()) : ?>
                                                <a href="<?php echo html_escape(base_url("pool_booking/pool_setting/pool_delete/" . $row->poolid)) ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo display('are_you_sure') ?>') "title="Delete"><i class="ti-trash" aria-hidden="true"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if($this->permission->method('pool_booking','update')->access()):?>
                                            <div class="text-right d-inline-block">
                                                        <div class="actions d-inline-block">
                                                            <div class="dropdown action-item" data-toggle="dropdown">
                                                                <a href="#" class="action-item"><i class="ti-more-alt"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a onclick="changestatus3(0,'tbl_swimming_pool', <?php echo html_escape($row->poolid)?>, 'poolid')"  class="dropdown-item"><?php echo display('inactive')?></a>
                                                                    <a onclick="changestatus3(1,'tbl_swimming_pool', <?php echo html_escape($row->poolid)?>, 'poolid')" class="dropdown-item"><?php echo display('active')?></a>
                                                                    <a onclick="changestatus3(2,'tbl_swimming_pool', <?php echo html_escape($row->poolid)?>, 'poolid')" class="dropdown-item"><?php echo display('un_maintenence')?></a>
                                                                    <a onclick="changestatus3(3,'tbl_swimming_pool', <?php echo html_escape($row->poolid)?>, 'poolid')" class="dropdown-item"><?php echo display('booked')?></a>
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

