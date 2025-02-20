<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel">

            <div class="panel-body">
                <?php echo form_open('house_keeping/house_keeping/updatepayment') ?>
                <?php echo form_hidden('landry_id', (!empty($intinfo->landry_id)?$intinfo->landry_id:null)) ?>
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label"><?php echo display('name') ?> <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input name="name" class="form-control" type="text" placeholder=" <?php echo display('name') ?>"
                            id="name" value="<?php echo html_escape((!empty($intinfo->name)?$intinfo->name:null)) ?>"
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="invoice" class="col-sm-4 col-form-label"><?php echo display('invoice') ?> <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <?php echo form_dropdown('invoice',$invoicelist,'', 'class="selectpicker form-control" data-live-search="true" id="invoice"') ?>
                    </div>
                    <span id="msg" class="text-danger mx-auto" hidden></span>
                </div>
                <div class="form-group row" id="amountdiv" hidden>
                    <label for="amount" class="col-sm-4 col-form-label"><?php echo display('amount') ?> <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input name="amount" class="form-control" type="number" readonly
                            placeholder="<?php echo display('amount') ?>" id="amount" value="" required>
                    </div>
                </div>
                <span id="id" hidden><?php echo html_escape($intinfo->landry_id); ?></span>
                <div class="form-group text-right" id="update" hidden>
                    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>
<script src="<?php echo MOD_URL.$module;?>/assets/js/laundry_pay.js"></script>