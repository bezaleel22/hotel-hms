<div class="card">
    <div class="card-header">
        <h4><?php echo display('room_cleaning_details');?></h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">

                    <div class="card-body">
                        <?php echo form_open('house_keeping/house_keeping/roomcleaningupdate');?>
                        <?php echo form_hidden('hkeeper_id', (!empty($intinfo->hkeeper_id)?$intinfo->hkeeper_id:null)) ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="room_no"
                                        class="col-sm-3 col-form-label"><?php echo display('room_no') ?>
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input name="room_no" readonly type="text" class="form-control"
                                            value="<?php echo html_escape($intinfo->roomno) ?>" id="room_no">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="assignto"
                                        class="col-sm-3 col-form-label"><?php echo display('assignto') ?>
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input name="assignto" readonly type="text" class="form-control"
                                            value="<?php echo html_escape($intinfo->first_name) ?>" id="assignto">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_start"
                                        class="col-sm-3 col-form-label"><?php echo display('date_start') ?>
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input name="date_start" autocomplete="off" class="datetimepickers form-control"
                                            type="text" placeholder="<?php echo display('date_start') ?>"
                                            value="<?php echo date("Y-m-d H:i:s") ?>" id="date_start">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_end"
                                        class="col-sm-3 col-form-label"><?php echo display('date_end') ?>
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input name="date_end" autocomplete="off" class="datetimepickers form-control"
                                            type="text" placeholder="<?php echo display('date_end') ?>"
                                            value="<?php echo date("Y-m-d H:i:s",strtotime('+15 minutes')) ?>"
                                            id="date_end">
                                    </div>
                                </div>
                                <?php if($intinfo->status!='1'){ ?>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label"><?php echo display('status') ?>
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="status" class="selectpicker form-control readonly"
                                            data-live-search="true" id="status">
                                            <option value=""><?php echo display('select') ?>
                                                <?php echo display('status') ?></option>
                                            <option value="0" <?php if($intinfo->status=='0'){ echo "selected";}?>>
                                                <?php echo display('pending') ?></option>
                                            <option value="2" <?php if($intinfo->status=='2'){ echo "selected";}?>>
                                                <?php echo display('underprocess') ?></option>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <?php $roomst =$this->db->select("status")->from('tbl_roomnofloorassign')->where('roomno',$intinfo->roomno)->get()->row(); ?>
                            <?php if($roomst->status==4) { ?>
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="fs-17 font-weight-600 mb-0">
                                                    <?php echo display('product_list') ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <?php foreach($hkproducts as $list){ ?>
                                            <?php $tooltrips = html_escape($list->product_name);?>
                                            <div class="col-md-12 pb-2">
                                                <div class="form-check form-check-inline w-100">
                                                    <input type="checkbox" class="form-check-input test"
                                                        name="products_id[]"
                                                        id="hkproduct<?php echo html_escape($list->id);?>"
                                                        value="<?php echo html_escape($list->id);?>">
                                                    <label class="form-check-label width_66 col-sm-10"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="<?php echo html_escape($tooltrips);?>"
                                                        for="materialInline<?php echo html_escape($list->id);?>"><?php echo html_escape($list->product_name);?></label>

                                                    <input type="number" min="1" class="col-sm-2"
                                                        name="products_qty<?php echo html_escape($list->id);?>"
                                                        id="hkproduct_qty<?php echo html_escape($list->id);?>" value="0"
                                                        disabled>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="fs-17 font-weight-600 mb-0">
                                                    <?php echo display('checklist') ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <?php foreach($checklist as $list){ ?>
                                            <?php $tooltrips = html_escape($list->taskname);?>
                                            <div class="col-md-12 pb-2">
                                                <div class="form-check form-check-inline w-100">
                                                    <input type="checkbox" class="form-check-input test"
                                                        name="checklist_id[]"
                                                        id="hkchecklist<?php echo html_escape($list->checklist_id);?>"
                                                        value="v_<?php echo html_escape($list->checklist_id);?>">
                                                    <label class="form-check-label width_66 col-sm-10"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="<?php echo html_escape($tooltrips);?>"><?php echo html_escape($list->taskname);?></label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit"
                                class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo MOD_URL.$module;?>/assets/js/qrroom_cleaning.js"></script>