<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo display('variant_list') ?>
                    <small class="float-right"> <?php if($this->permission->method('ordermanage','create')->access()): ?>
                        <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i><?php echo display('add_varient') ?>
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
                            <th><?php echo display('varient_name') ?></th>
                            <th><?php echo display('item_name') ?></th>
                            <th><?php echo display('action') ?></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($fooditemslist)) { ?>
                        <?php $sl = $pagenum+1; ?>
                        <?php foreach ($fooditemslist as $varient) { ?>
                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                            <td><?php echo $sl; ?></td>
                            <td><?php echo $varient->variantName; ?></td>
                            <td><?php echo $varient->ProductName; ?></td>
                            <td class="center">
                                <?php if($this->permission->method('ordermanage','update')->access()): ?>

                                <a onclick="editvarient('<?php echo $varient->variantid; ?>')"
                                    class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left"
                                    title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a>
                                <?php endif; 
										 if($this->permission->method('ordermanage','delete')->access()): ?>
                                <a href="<?php echo base_url("ordermanage/item_food/deletevarient/$varient->variantid") ?>"
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
                <div class="text-right"></div>
            </div>

        </div>
    </div>
</div>

<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('add_varient');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">

                            <div class="panel-body">

                                <?php echo  form_open('ordermanage/item_food/varientcreate') ?>
                                <?php echo form_hidden('variantid', (!empty($intinfo->variantid)?$intinfo->variantid:null)) ?>
                                <div class="form-group row">
                                    <label for="itemname"
                                        class="col-sm-4 col-form-label"><?php echo display('item_name')?><span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8 customesl">
                                        <?php 
                                            if(empty($itemdropdown)){$itemdropdown = array('' => '--Select--');}
                                            echo form_dropdown('foodid',$itemdropdown,(!empty($intinfo->menuid)?$intinfo->menuid:null),'class="form-control basic-single" required') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="varientname"
                                        class="col-sm-4 col-form-label"><?php echo display('varient_name') ?> <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input name="varientname" class="form-control" required type="text"
                                            placeholder="<?php echo display('add_varient') ?>" id="unitname" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="price" class="col-sm-4 col-form-label"><?php echo display('price') ?>
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-8 ">
                                        <input name="price" class="form-control" required type="text" placeholder="<?php echo display('price') ?>" id="price" value="">
                                        
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
                <strong><?php echo display('variant_edit');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body editinfo">

            </div>

        </div>
        <div class="modal-footer">

        </div>

    </div>

</div>