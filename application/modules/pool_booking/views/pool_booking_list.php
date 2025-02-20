<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <?php if ($this->permission->method('pool_booking', 'create')->access()) : ?>
                <h4>
                    <?php echo display('pool_booking_list') ?>
                    <small class="float-right">
                        <a href="<?php echo base_url("pool_booking/add-booking") ?>" class="btn btn-primary btn-md">
                            <i class="ti-plus" aria-hidden="true"></i><?php echo display('add_pool_booking') ?>
                        </a>
                    </small>
                </h4>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" id="exdatatable" class="datatable table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('cust_name') ?></th>
                                <th><?php echo display('amount') ?></th>
                                <th><?php echo display('date') ?></th>
                                <th><?php echo display('action') ?></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($poolbook_list)) { ?>
                                <?php $sl = 1;
                                $poolcustcheckid = '';?>
                                <?php foreach ($poolbook_list as $row) { ?>
                                    <tr class="">
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo html_escape($row->cust_name); ?></td>
                                        
                                        <td><?php echo html_escape($row->total_amount); ?></td>
                                        <td><?php echo html_escape($row->entrydate); ?></td>
                                        <td class="center">
                                             <?php if ($this->permission->method('pool_booking', 'update')->access()) : 
                                                $cr_time =  date("Y-m-d H");
                                                $check_inhouse = $this->db->select('*')->from('booked_info')->where('cutomerid',$row->custid)->get()->num_rows();
                                                if ($check_inhouse > 0) {
                                                    $this->db->select('*');
                                                    $this->db->from('booked_info');
                                                    $this->db->join('customerinfo','customerinfo.customerid=booked_info.cutomerid','left');
                                                    $this->db->where('CAST(booked_info.checkindate AS datetime) <=',$cr_time);
                                                    $this->db->where('CAST(booked_info.checkoutdate AS datetime) >=',$cr_time);
                                                    $this->db->where('booked_info.bookingstatus',4);
                                                    $this->db->where('customerinfo.customerid',$row->custid);
                                                    $this->db->group_by('booked_info.cutomerid');
                                                    $query=$this->db->get();
                                                     $data=$query->num_rows();
                                                    if ($data >= 1) {

                                                      $poolcustcheckid = 1;
                                                    }
                                                    else {
                                                        $poolcustcheckid = 0;
                                                    }
                                                }else {
                                                
                                                }
                                                if ($poolcustcheckid == 1) {
                                                   
                                                ?>
                                                <a href="<?php echo html_escape(base_url("pool_booking/pool_setting/pool_booking_updatefrm/" . $row->pbookingid)) ?>" class="btn btn-info btn-sm" title="Update "><i class="ti-pencil" aria-hidden="true"></i>
                                                </a>

                                            <?php   } endif; ?>
                                             <?php if ($this->permission->method('pool_booking', 'read')->access()) : ?>
                                                <input name="url" type="hidden" id="url_<?php echo html_escape($row->pbookingid); ?>" value="<?php echo base_url("pool_booking/pool_setting/pool_package_datashow") ?>" />
                                                <a onclick="editinfo('<?php echo html_escape($row->pbookingid); ?>')" class="btn btn-primary btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="view"><i class="far fa-eye text-white" aria-hidden="true"></i></a> 

                                                <?php if ($row->status == 1) {?>
                                                <button class="btn btn-primary btn-sm margin_right_5px" onclick="podataprintflist(<?php echo html_escape($row->pbookingid)?>)"><span class="fa fa-print"></span></button>
                                                <?php } ?>
                                            <?php endif; ?>
                                            
                                        </td>
                                        
                                    </tr>
                                    <?php $sl++; ?>
                                <?php }; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                      </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>
    <div id="edit" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong><?php echo display('view');?></strong>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body editinfo">

            </div>

        </div>
        <div class="modal-footer">

        </div>

    </div>

</div>

<div id="printdatadivfromlist">

    
</div>