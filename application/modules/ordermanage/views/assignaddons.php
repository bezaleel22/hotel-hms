<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <h4><?php echo display('assign_adons_list') ?>
                    <small class="float-right"> <?php if($this->permission->method('ordermanage','create')->access()): ?>
                        <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i><?php echo display('assign_adons') ?>
                        </button>
                    </small>
                </h4>
                <?php endif; ?>

            </div>


            <div class="card-body">
                <table width="100%" id="exdatatable" class="datatable2 table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('addons_name') ?></th>
                            <th><?php echo display('item_name') ?></th>
                            <th><?php echo display('action') ?></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php 
						if (!empty($addonsmenulist2)) { ?>
                        <?php $sl = $pagenum+1; ?>
                        <?php foreach ($addonsmenulist2 as $addonsmenu) { ?>
                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                            <td><?php echo $sl; ?></td>
                            <td><?php echo $addonsmenu->add_on_name; ?></td>
                            <td><?php echo $addonsmenu->ProductName; ?></td>
                            <td class="center">
                                <?php if($this->permission->method('ordermanage','update')->access()): ?>

                                <a onclick="adonseditinfo('<?php echo $addonsmenu->row_id; ?>')"
                                    class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left"
                                    title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a>
                                <?php endif; 
										 if($this->permission->method('ordermanage','delete')->access()): ?>
                                <a href="<?php echo base_url("ordermanage/menu_addons/assignaddonsdelete/$addonsmenu->row_id") ?>"
                                    onclick="return confirm('<?php echo display('are_you_sure') ?>')"
                                    class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right"
                                    title="Delete "><i class="ti-trash" aria-hidden="true"></i></a>
                                <?php endif; ?>
                            </td>

                        </tr>
                        <?php $sl++; ?>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table> <!-- /.table-responsive -->
                <div class="text-right"><?php echo @$links?></div>
            </div>
        </div>
    </div>
</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('assign_adons');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">

                            <div class="panel-body">

                                <?php echo  form_open('ordermanage/menu_addons/assignaddonscreate') ?>
                                <?php echo form_hidden('row_id', (!empty($addonsinfo->row_id)?$addonsinfo->row_id:null)) ?>
                                <div class="form-group row">
                                    <label for="addonsid"
                                        class="col-sm-4 col-form-label"><?php echo display('addons_name') ?><span class="text-danger">*</span></label>
                                    <div class="col-sm-8 customesl">
                                        <?php 
                                        if(empty($addonsmenulist)){$addonsmenulist = array('' => '--Select--');}
                                        echo form_dropdown('addonsid',$addonsdropdown,(!empty($addonsinfo->add_on_id)?$addonsinfo->add_on_id:null),'required class="form-control basic-single"') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="menuid"
                                        class="col-sm-4 col-form-label"><?php echo display('item_name') ?><span class="text-danger">*</span></label>
                                    <div class="col-sm-8 customesl">
                                        <?php 
                                        if(empty($addonsmenulist)){$addonsmenulist = array('' => '--Select--');}
                                        echo form_dropdown('menuid',$menudropdown,(!empty($addonsinfo->menu_id)?$addonsinfo->menu_id:null),'required class="form-control basic-single"') ?>
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
                <strong><?php echo display('update_adons');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body editinfo">

            </div>

        </div>
        <div class="modal-footer">

        </div>

    </div>

</div>