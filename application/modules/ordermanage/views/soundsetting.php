<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="card-body">

                <?php 
				
				
				echo form_open_multipart('ordermanage/order/addsound','class="form-inner"') ?>
                <?php echo form_hidden('id',(!empty($soundsetting->soundid)?$soundsetting->soundid:'')) ?>
                <!-- if setting favicon is already uploaded -->
                <?php if(!empty($soundsetting->nofitysound)) {  ?>
                <div class="form-group row">
                    <label for="faviconPreview" class="col-md-4 col-form-label"></label>
                    <div class="col-md-8">
                        <img src="<?php echo base_url($soundsetting->nofitysound) ?>" alt="Notify Sound"
                            class="img-thumbnail" />
                    </div>
                </div>
                <?php } ?>

                <div class="form-group row">
                    <label for="favicon" class="col-md-4 col-form-label font-weight-bolder"><?php echo display('upload_notify') ?> </label>
                    <div class="col-md-8">
                        <input type="file" name="notifysound" id="notifysound">
                        <input type="hidden" name="old_notifysound" value="<?php echo (!empty($soundsetting->nofitysound)?$soundsetting->nofitysound:'') ?>">
                    </div>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>