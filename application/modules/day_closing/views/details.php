<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Printable area start -->

<!-- Printable area end -->
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div id="printableArea">
                <div class="card-body">
                    <div class="table-responsive m-b-20">
                        <table class="table table-fixed table-bordered table-hover bg-white" id="billorder">
                            <thead>
                                <tr>
                                    <th width="20%" class="text-center"><?php echo display('invoice')?> </th>
                                    <th width="20%" class="text-center"><?php echo display('recieved')?></th>
                                    <th width="20%" class="text-center"><?php echo display('expense')?></th>
                                    <th class="text-center"><?php echo display('amount')?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total=0;
								if(!empty($billeport)){
									foreach($billeport as $bill){?>
                                <tr>
                                    <td><?php echo $bill->VNo;?></td>
                                    <td><?php echo $bill->Debit;?></td>
                                    <td><?php echo $bill->Credit;?></td>
                                    <td align="right"><?php echo $bill->Debit-$bill->Credit;?></td>
                                </tr>
                                <?php $total=$total+$bill->Debit-$bill->Credit;
								} } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td align="right" style="text-align:right;font-size:14px !Important">&nbsp;
                                        <b><?php echo display('total') ?> </b></td>
                                    <td style="text-align: right;"><b> <?php echo number_format($total,3);?></b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>