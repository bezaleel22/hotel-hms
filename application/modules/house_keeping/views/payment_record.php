<div class="card">
    <div id="payment" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><?php echo display("laundry_payment");?></strong>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body paymentinfo">

                </div>

            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>
    <div class="row">
        <!--  table area -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo display("laundry_payment"); ?></h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" id="exdatatable"
                        class="datatable table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('Sl') ?></th>
                                <th><?php echo display('name') ?></th>
                                <th><?php echo display('amount') ?></th>
                                <th><?php echo display('due_amount') ?></th>
                                <th><?php echo display('paid_amount') ?></th>
                                <th><?php echo display('action') ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($item)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($item as $list) { ?>
                            <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                <td><?php echo $sl; ?></td>
                                <td><?php echo html_escape($list->name); ?></td>
                                <td><?php echo html_escape($list->total_amount); ?></td>
                                <td><?php echo html_escape($list->due_amount); ?></td>
                                <td><?php echo html_escape($list->paid_amount); ?></td>
                                <td class="center">
                                    <?php if($this->permission->method('house_keeping','update')->access()): ?>
                                    <input name="url" type="hidden"
                                        id="url_<?php echo html_escape($list->landry_id); ?>"
                                        value="<?php echo base_url("house_keeping/house_keeping/updatepayfrm") ?>" />
                                    <a onclick="laundrypayment('<?php echo html_escape($list->landry_id); ?>')"
                                        class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left"
                                        title="Update"><i class="ti-money text-white" aria-hidden="true"></i></a>
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
</div>