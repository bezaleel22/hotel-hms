<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo display('food_availablelist') ?>
                    <small class="float-right"> <?php if($this->permission->method('ordermanage','create')->access()): ?>
                        <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i><?php echo display('add_availablity') ?>
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
                            <th><?php echo display('item_name') ?></th>
                            <th><?php echo display('available_day') ?></th>
                            <th><?php echo display('available_time') ?></th>
                            <th><?php echo display('action') ?></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($foodavailist)) { ?>
                        <?php $sl = $pagenum+1; ?>
                        <?php foreach ($foodavailist as $avail) { ?>
                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                            <td><?php echo $sl; ?></td>
                            <td><?php echo $avail->ProductName; ?></td>
                            <td><?php echo $avail->availday; ?></td>
                            <td><?php echo $avail->availtime; ?></td>
                            <td class="center">
                                <?php if($this->permission->method('ordermanage','update')->access()): ?>

                                <a onclick="editavailable('<?php echo $avail->availableID; ?>')"
                                    class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left"
                                    title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a>
                                <?php endif; 
										 if($this->permission->method('ordermanage','delete')->access()): ?>
                                <a href="<?php echo base_url("ordermanage/item_food/deleteavailable/$avail->availableID") ?>"
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
                <strong><?php echo display('add_availablity');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">

                            <div class="panel-body">

                                <?php echo  form_open('ordermanage/item_food/availablecreate') ?>
                                <?php echo form_hidden('availableID', (!empty($intinfo->availableID)?$intinfo->availableID:null)) ?>
                                <div class="form-group row">
                                    <label for="itemname"
                                        class="col-sm-3 col-form-label"><?php echo display('item_name') ?><span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8 customesl">
                                        <?php 
						if(empty($itemdropdown)){$itemdropdown = array('' => '--Select--');}
						echo form_dropdown('foodid',$itemdropdown,(!empty($intinfo->foodid)?$intinfo->foodid:null),'class="form-control basic-single"') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="availday"
                                        class="col-sm-3 col-form-label"><?php echo display('available_day') ?> <span
                                            class="text-danger">*</span><a class="cattooltips" data-toggle="tooltip"
                                            data-placement="top" title="Use Day Name Like:Saturday,Sunday....."><i
                                                class="fa fa-question-circle" aria-hidden="true"></i></a> </label>
                                    <div class="col-sm-8 customesl">
                                        <select name="availday" class="form-control basic-single" id="availday">
                                            <option value="" selected="selected"><?php echo display('select_option') ?></option>
                                            <option value="Saturday"><?php echo display('saturday') ?></option>
                                            <option value="Sunday"><?php echo display('sunday') ?></option>
                                            <option value="Monday"><?php echo display('monday') ?></option>
                                            <option value="Tuesday"><?php echo display('tuesday') ?></option>
                                            <option value="Wednesday"><?php echo display('wednesday') ?></option>
                                            <option value="Thursday"><?php echo display('thursday') ?></option>
                                            <option value="Friday"><?php echo display('friday') ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fromtime" class="col-sm-3 col-form-label"><?php echo "From Time:" ?>
                                        <span class="text-danger">*</span><a class="cattooltips" data-toggle="tooltip"
                                            data-placement="top" title="Use Time Like:2:00,10:00"><i
                                                class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                                    <div class="col-sm-3 availabledit_padding_right">
                                        <input name="fromtime" class="form-control timepicker3 " type="text"
                                            placeholder="<?php echo display('from_time') ?>" id="formtime" value=""
                                            readonly="readonly">
                                    </div>
                                    <label for="totime" class="col-sm-2 col-form-label"><?php echo "To Time:" ?>
                                    </label>
                                    <div class="col-sm-3">
                                        <input name="totime" class="form-control timepicker3 " type="text"
                                            placeholder="<?php echo display('to_time') ?>" id="totime" value=""
                                            readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status"
                                        class="col-sm-3 col-form-label"><?php echo display('status') ?></label>
                                    <div class="col-sm-8 customesl">
                                        <select name="status" class="form-control basic-single">
                                            <option value="" selected="selected"><?php echo display('select_option') ?></option>
                                            <option value="1"><?php echo display('active');?></option>
                                            <option value="0"><?php echo display('inactive');?></option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group text-right">
                                    <div class="col-sm-11 availabledit_padding_right">
                                        <button type="reset"
                                            class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                        <button type="submit"
                                            class="btn btn-success w-md m-b-5"><?php echo display('Ad') ?></button>
                                    </div>
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
                <strong><?php echo display('edit_availablity');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body editinfo">

            </div>

        </div>
        <div class="modal-footer">

        </div>

    </div>

</div>