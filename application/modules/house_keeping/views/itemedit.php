<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel">

            <div class="panel-body">
                <?php echo form_open('house_keeping/house_keeping/create') ?>
                <?php echo form_hidden('item_id', (!empty($intinfo->item_id)?$intinfo->item_id:null)) ?>
                <div class="form-group row" id="product">
                    <label for="product_id" class="col-sm-4 col-form-label"><?php echo display("litem_name"); ?> <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <?php echo form_dropdown('product_id',$productdropdown,$productdropdown=$intinfo->product_id,'id="product_id" class="form-control"') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="task_name" class="col-sm-4 col-form-label"><?php echo display('task_name') ?> <span
                            class="text-danger">*</span></label>
                            <div class="col-sm-8">
                        <?php echo form_dropdown('task_name',$checklistdropdown,$productdropdown=$intinfo->checklist,'id="task_name" class="form-control" required') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-4 col-form-label"><?php echo display('price') ?> <span
                            class="text-danger">*</span></label>
                            <div class="col-sm-8">
                        <input name="price" class="form-control" type="text"
                            placeholder="<?php echo display('price') ?>" id="tablename"
                            value="<?php echo html_escape((!empty($intinfo->price)?$intinfo->price:null)) ?>"
                            required>
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