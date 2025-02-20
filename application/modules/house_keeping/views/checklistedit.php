<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel">

            <div class="panel-body">
                <?php echo form_open('house_keeping/checklist/create') ?>
                <?php echo form_hidden('checklist_id', (!empty($intinfo->checklist_id)?$intinfo->checklist_id:null)) ?>
                <div class="form-group row">
                    <label for="task_name" class="col-sm-4 col-form-label"><?php echo display('task_name') ?> <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input name="task_name" class="form-control" type="text"
                            placeholder="<?php echo display('task_name') ?>" id="tablename"
                            value="<?php echo html_escape((!empty($intinfo->taskname)?$intinfo->taskname:null)) ?>"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type" class="col-sm-4 col-form-label"><?php echo display('type') ?>
                        <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <select name="type" id="type" class="form-control" required>
                            <option value="" selected="selected">
                                <?php echo display('select_type') ?>
                            </option>
                            <option value="1"<?php if($intinfo->type==1){echo display("selected");} ?>><?php echo display("house_keeper") ?></option>
                            <option value="2" <?php if($intinfo->type==2){echo display("selected");} ?>><?php echo display("laundry"); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>