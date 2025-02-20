<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo (!empty($title)?$title:null) ?></h4>
            </div>
            <div class="card-body">
                <?php echo  form_open('day_closing/cashregister/createcounter',array('id'=>'menuurl')) ?>
                <div class="form-group row">
                    <label for="counter" class="col-sm-2 col-form-label"><?php echo display('dccounter_no') ?> <span class="text-danger">*</span></label>
                    <div class="col-sm-3">
                        <input name="counter" id="counter" class="form-control" min="1" type="number"
                            placeholder="<?php echo display('dccounter_no') ?>">
                    </div>
                    <div class="col-sm-2" id="upbtn">
                        <button type="submit" class="btn btn-success w-md m-b-5 display-block"
                            id="btnchnage"><?php echo display('dcadd_counter') ?></button>
                    </div>
                </div>
                <?php echo form_close() ?>
                <table class="table table-bordered table-hover" id="RoleTbl">
                    <thead>
                        <tr>
                            <th><?php echo display('sl_no') ?></th>
                            <th><?php echo display('dccounter_no') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($counterlist)){ ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($counterlist as $counter) { 
							
							?>
                        <tr>
                            <td><?php echo $sl++; ?></td>
                            <td><?php echo $counter->counterno; ?></td>

                            <td>
                                <a onclick="editmenu('<?php echo $counter->counterno; ?>',<?php echo $counter->ccid; ?>)"
                                    data-toggle="tooltip" data-placement="left" title="Update"
                                    class="btn btn-success btn-sm"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a>

                            </td>
                        </tr>
                        <?php  } }  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo MOD_URL.$module;?>/assets/js/cashcounter.js" type="text/javascript"></script>