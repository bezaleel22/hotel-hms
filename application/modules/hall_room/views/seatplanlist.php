<div class="card">
    <div id="add0" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><?php echo display('add_new'); ?></strong>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="card">

                                <div class="card-body">
                                    <?php echo form_open_multipart('hall_room/hallroom/seatplan_create'); ?>
                                    <div class="form-group row">
                                        <label for="plan_name"
                                            class="col-sm-4 col-form-label"><?php echo display('plan_name') ?> <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input name="plan_name" autocomplete="off" class="form-control" type="text"
                                                placeholder="<?php echo display('plan_name') ?>" id="plan_name"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description"
                                            class="col-sm-4 col-form-label"><?php echo display('description') ?> <span
                                                class="text-danger"></span></label>
                                        <div class="col-sm-8">
                                            <textarea name="description" cols="35" rows="3"
                                                placeholder="<?php echo display('description') ?>"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="picture"
                                            class="col-sm-4 col-form-label"><?php echo display('image') ?></label>
                                        <div class="col-sm-8">
                                            <input type="file" accept="image/*" name="picture"
                                                onchange="loadFile(event)"><a class="cattooltipsimg"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Use only .jpg,.jpeg,.gif and .png Images"><i
                                                    class="fa fa-question-circle" aria-hidden="true"></i></a>
                                            <small id="fileHelp" class="text-muted"><img
                                                    src="<?php echo html_escape(base_url('assets/img/room-setting/room_images.png')); ?>"
                                                    id="output" class="img-thumbnail height_150_width_200px jsclrimg" />
                                            </small>
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="reset" id="reset"
                                            class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                        <button type="submit"
                                            class="btn btn-success w-md m-b-5"><?php echo display('ad') ?></button>
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
                    <strong><?php echo display('update'); ?></strong>
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
        <div class="col-md-12 mb-3">
            <div class="card">
                <?php if($this->permission->method('hall_room','create')->access()): ?>
                <div class="card-header">
                    <h4><?php echo display('seatplan')." ".display("list")?><small class="float-right">
                            <button type="button" class="btn btn-primary btn-md mb-2" data-target="#add0"
                                data-toggle="modal"><i class="ti-plus" aria-hidden="true"></i>
                                <?php echo display('add_new') ?></button></small></h4>
                </div>
                <div class="row">
                    <!--  table area -->
                    <div class="col-sm-12">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%" class="datatable table table-striped table-bordered table-hover"
                                    id="exdatatable">
                                    <thead>
                                        <tr>
                                            <th><?php echo display('sl_no') ?></th>
                                            <th><?php echo display('plan_name') ?></th>
                                            <th><?php echo display('description') ?></th>
                                            <th><?php echo display('image') ?></th>
                                            <th><?php echo display('action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($seatplan)) {
                            ?>
                                        <?php $sl = 1; ?>
                                        <?php foreach ($seatplan as $list) { ?>
                                        <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
                                            <td><?php echo $sl; ?></td>
                                            <td><?php echo html_escape($list->plan_name); ?></td>
                                            <td><?php echo html_escape($list->description); ?></td>
                                            <td><img src="<?php echo html_escape(base_url(!empty($list->image)?$list->image:'assets/img/room-setting/room_images.png')); ?>" alt="Image" width="80"></td>
                                            <td class="center">
                                                    <?php if ($this->permission->method('hall_room', 'update')->access()) : ?>
                                                    <input name="url" type="hidden"
                                                        id="url_<?php echo html_escape($list->hsid); ?>"
                                                        value="<?php echo base_url("hall_room/hallroom/updateseatfrm") ?>" />
                                                    <a onclick="editinforoom('<?php echo html_escape($list->hsid); ?>')"
                                                        class="btn btn-info btn-sm" data-toggle="tooltip"
                                                        data-placement="left" title="Update"><i
                                                            class="ti-pencil-alt text-white" aria-hidden="true"></i></a>
                                                    <?php endif;
                                            if ($this->permission->method('hall_room', 'delete')->access()) : ?>
                                                    <a href="<?php echo base_url("hall_room/hallroom/seatdelete/" . html_escape($list->hsid)) ?>"
                                                        onclick="return confirm('<?php echo display("are_you_sure") ?>')"
                                                        class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                        data-placement="right" title="Delete "><i
                                                            class="ti-trash"></i></a>
                                                    <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php $sl++; ?>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table> <!-- /.table-responsive -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>