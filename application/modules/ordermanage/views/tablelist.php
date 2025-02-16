<div class="form-group text-right">
    

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('add_new_table');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">

                            <div class="panel-body">

                                <?php echo  form_open_multipart('ordermanage/restauranttable/create') ?>
                                <?php echo form_hidden('tableid', (!empty($intinfo->tableid)?$intinfo->tableid:null)) ?>
                                <div class="form-group row">
                                    <label for="tablename"
                                        class="col-sm-4 col-form-label"><?php echo display('table_name') ?> *</label>
                                    <div class="col-sm-8">
                                        <input name="tablename" class="form-control" type="text"
                                            placeholder="Add <?php echo display('table_name') ?>" id="tablename"
                                            value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="capacity" class="col-sm-4 col-form-label"><?php echo "Capacity"; ?>
                                    </label>
                                    <div class="col-sm-8">
                                        <input name="capacity" class="form-control" type="text"
                                            placeholder="Add <?php echo  display('capacity'); ?>" id="capacity"
                                            value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="floor"
                                        class="col-sm-4 col-form-label"><?php echo display('floor_select') ?></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="floor" id="floor">
                                            <option value=""><?php echo display('sl_option') ?></option>
                                            <?php 
                                           foreach($floorlist as $floor){
                                            echo '<option value="'.$floor->tbfloorid.'">'.$floor->floorName.'</option>';
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="firstname" class="col-sm-4 col-form-label"><?php echo display('table_icon') ?></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="picture" id="pictureurl"
                                            onchange="loadFile(event)" readonly="readonly" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-primary btn-md" data-target="#filemanager"
                                            data-toggle="modal"><?php echo display('show') ?></button>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="reset"
                                        class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                    <button type="submit"
                                        class="btn btn-success w-md m-b-5"><?php echo display('Ad') ?></button>
                                </div>
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
                <strong><?php echo display('table_edit');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body editinfo">

            </div>

        </div>
        <div class="modal-footer">

        </div>

    </div>

</div>
<div id="filemanager" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="card panel-bd card-box">
                            <div class="card-header">
                            <h4>My tables
                                <div class="btn-group float-right">
                                    <?php echo form_open_multipart('#', array('class' => 'upload-image-form'));?>
                                    <input name="url" type="hidden" id="uploadurl"
                                        value="<?php echo base_url("ordermanage/restauranttable/uploadfile") ?>" />
                                    <input type="hidden" id="myFileInput" />
                                    <div class="table-updt-files">
                                        <a class='btn btn-primary' href='javascript:;'>
                                            <i class="fa fa-upload"></i> Upload Files
                                            <input type="file" accept="image/*" class="input-file" id="filename"
                                                name="file_source[]" multiple size="40">
                                        </a>

                                    </div>

                                    <?php echo form_close() ?>
                                </div></h4>
                                
                               
                            </div>
                            <div class="card-body newtable" id="newtable">
                                <div class="row">
                                    <?php 
                                    $path = 'assets/img/icons/resttable/';
                                    $imagedata = directory_map($path);
                                    foreach($imagedata as $tableimage){
                                    ?>
                                    <div class="col-lg-2 col-xl-2">
                                        <div class="file-man-box">
                                            <div class="file-img-box">
                                                <img src="<?php echo base_url() .$path.$tableimage; ?>"
                                                    data-scr="<?php echo $path.$tableimage;?>" alt="icon" height="60"
                                                    width="60">
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>
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
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="card panel-default thumbnail">
            <div class="card-header">
                <?php if($this->permission->method('ordermanage','create')->access()): ?>
                <h4>
                    <?php echo display('table_list') ?>
                    <small class="float-right">
                        <a href="<?php echo base_url()?>ordermanage/restauranttable/floorlist" class="btn btn-primary btn-md">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            <?php echo display('add_floor')?>
                        </a>
                        <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            <?php echo display('add_new_table')?>
                        </button>
                    </small>
                </h4>
                
                <?php endif; ?>
            </div>

            <div class="card-body">
                <table width="100%" id="exdatatable" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('table_name') ?></th>
                            <th><?php echo display('capacity') ?></th>
                            <th><?php echo display('icon') ?></th>
                            <th><?php echo display('action') ?></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tablelist)) { ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($tablelist as $table) { ?>
                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                            <td><?php echo $sl; ?></td>
                            <td><?php echo $table->tablename; ?></td>
                            <td><?php echo $table->person_capicity; ?></td>
                            <td><img src="<?php echo base_url(!empty($table->table_icon)?$table->table_icon:'assets/img/icons/table/default.jpg'); ?>"
                                    class="img-thumbnail tablelist-img" /></td>
                            <td class="center">
                                <?php if($this->permission->method('ordermanage','update')->access()): ?>
                                <input name="url" type="hidden" id="url_<?php echo $table->tableid; ?>"
                                    value="<?php echo base_url("ordermanage/restauranttable/updateintfrm") ?>" />

                                <a onclick="editinfo('<?php echo $table->tableid; ?>')" class="btn btn-info btn-sm"
                                    data-toggle="tooltip" data-placement="left" title="Update">
                                    <i class="ti-pencil" aria-hidden="true"></i>
                                </a>
                                <?php endif; 

								if($this->permission->method('ordermanage','delete')->access()): ?>
                                <a href="<?php echo base_url("ordermanage/restauranttable/delete/$table->tableid") ?>"
                                    onclick="return confirm('<?php echo display('are_you_sure') ?>')" class="btn btn-danger btn-sm" 
                                    data-toggle="tooltip" data-placement="right" title="Delete ">
                                    <i class="ti-trash" aria-hidden="true"></i>
                                </a>
                                <?php endif; ?>
                            </td>

                        </tr>
                            <?php $sl++; ?>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table> <!-- /.table-responsive -->
                <div class="text-right"></div>

            </div>
        </div>

    </div>
</div>
<script src="<?php echo base_url('application/modules/ordermanage/assets/js/tablelist_script.js'); ?>"
    type="text/javascript"></script>