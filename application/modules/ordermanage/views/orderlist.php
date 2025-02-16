<div id="cancelord" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('orderid');?><?php echo display('can_ord');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="form-group row">
                                    <label for="payments" class="col-sm-4 col-form-label"><?php echo display('orderid');?> </label>
                                    <div class="col-sm-7 customesl mt-2">
                                        <span id="canordid"></span>
                                        <input name="mycanorder" id="mycanorder" type="hidden" value="" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="canreason" class="col-sm-4 col-form-label"><?php echo display('cancel_reason');?></label>
                                    <div class="col-sm-7 customesl">
                                        <textarea name="canreason" id="canreason" cols="35" rows="3"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <div class="col-sm-11 pr-0">
                                        <button type="button" class="btn btn-success w-md m-b-5"
                                            id="cancelreason"><?php echo display('submit');?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<div id="payprint_marge" class="modal fade  bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg" id="modal-ajaxview">

    </div>

</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">

            <div class="card-body">
                <fieldset class=" p-2">
                    <legend class="w-auto"><?php echo $title; ?></legend>
                </fieldset>
                <div class="row">
                    <div class="col-sm-12" id="findfood">
                        <table class="table table-fixed table-bordered table-hover bg-white" id="tallorder">
                            <thead>
                                <tr>
                                    <th class="text-center"><?php echo display('sl')?> </th>
                                    <th class="text-center"><?php echo display('invoice_no');?></th>
                                    <th class="text-center"><?php echo display('customer_name');?></th>
                                    <th class="text-center"><?php echo display('waiter');?></th>
                                    <th class="text-center"><?php echo display('table');?></th>
                                    <th class="text-center"><?php echo display('state');?></th>
                                    <th class="text-center"><?php echo display('ordate');?></th>
                                    <th class="text-right"><?php echo display('amount');?></th>
                                    <th class="text-center"><?php echo display('action');?></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                        <div class="text-right"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="payprint_split" class="modal fade  bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg" id="modal-ajaxview-split"> </div>
</div>
<script src="<?php echo base_url('application/modules/ordermanage/assets/js/orderlist.js'); ?>" type="text/javascript">
</script>