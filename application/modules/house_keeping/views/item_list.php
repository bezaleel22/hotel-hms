 <div class="card">

     <div id="add0" class="modal fade" role="dialog">
         <div class="modal-dialog modal-md">
             <div class="modal-content">
                 <div class="modal-header">
                     <strong><?php echo display("manage_item");?></strong>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                 </div>
                 <div class="modal-body">

                     <div class="row">
                         <div class="col-sm-12 col-md-12">
                             <div class="card">

                                 <div class="card-body">

                                     <?php echo form_open('house_keeping/house_keeping/create') ?>
                                     <?php echo form_hidden('item_id', (!empty($intinfo->item_id)?$intinfo->item_id:null)) ?>
                                     <div class="form-group row" id="product">
                                         <label for="product_id"
                                             class="col-sm-4 col-form-label"><?php echo display("litem_name"); ?> <span
                                                 class="text-danger">*</span></label>
                                         <div class="col-sm-8">
                                             <?php echo form_dropdown('product_id',$productdropdown,'','id="product_id" class="form-control" required') ?>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label for="task_name"
                                             class="col-sm-4 col-form-label"><?php echo display('task_name') ?> <span
                                                 class="text-danger">*</span></label>
                                         <div class="col-sm-8">
                                             <?php echo form_dropdown('task_name',$checklistdropdown,'','id="task_name" class="form-control" required') ?>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label for="price"
                                             class="col-sm-4 col-form-label"><?php echo display('price') ?> <span
                                                 class="text-danger">*</span></label>
                                         <div class="col-sm-8">
                                             <input name="price" class="form-control" type="text"
                                                 placeholder="<?php echo display('price') ?>" id="price" value=""
                                                 required>
                                         </div>
                                     </div>

                                     <div class="form-group text-right">
                                         <button type="reset"
                                             class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                         <button type="submit"
                                             class="btn btn-success w-md m-b-5"><?php echo display('ad') ?></button>
                                     </div>
                                     <?php echo form_close() ?>

                                 </div>
                             </div>
                         </div>
                     </div>



                 </div>

             </div>
             <div class="modal-footer">

             </div>

         </div>

     </div>

     <div id="edit" class="modal fade" role="dialog">
         <div class="modal-dialog modal-md">
             <div class="modal-content">
                 <div class="modal-header">
                     <strong><?php echo display('update');?></strong>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                 </div>
                 <div class="modal-body editinfo">

                 </div>

             </div>
             <div class="modal-footer">

             </div>

         </div>

     </div>
     <div class="row">
         <!--  table area -->
         <div class="col-sm-12">

             <div class="card-header">
                 <h4><?php echo display("item_list"); ?><small
                         class="float-right"><?php if($this->permission->method('house_keeping','create')->access()): ?>
                         <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"><i
                                 class="fa fa-plus-circle" aria-hidden="true"></i>
                             <?php echo display("manage_item"); ?></button><?php endif; ?></small></h4>
             </div>


             <div class="card-body">
                 <table width="100%" id="exdatatable" class="datatable table table-striped table-bordered table-hover">
                     <thead>
                         <tr>
                             <th><?php echo display('sl_no') ?></th>
                             <th><?php echo display("litem_name"); ?></th>
                             <th><?php echo display('task_name') ?></th>
                             <th><?php echo display('item_cost') ?></th>
                             <th><?php echo display('action') ?></th>

                         </tr>
                     </thead>
                     <tbody>
                         <?php if (!empty($item)) {
							 ?>
                         <?php $sl = 1; ?>
                         <?php foreach ($item as $type) { ?>
                         <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                             <td><?php echo $sl; ?></td>
                             <td><?php echo html_escape($type->product_name); ?></td>
                             <td><?php echo html_escape($type->checklist); ?></td>
                             <td><?php echo html_escape($type->price); ?></td>
                             <td class="center">
                                 <?php if($this->permission->method('house_keeping','update')->access()): ?>
                                 <input name="url" type="hidden" id="url_<?php echo html_escape($type->item_id); ?>"
                                     value="<?php echo base_url("house_keeping/house_keeping/updateitemfrm") ?>" />
                                 <a onclick="editinfo('<?php echo html_escape($type->item_id); ?>')"
                                     class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left"
                                     title="Update"><i class="ti-pencil-alt text-white" aria-hidden="true"></i></a>
                                 <?php endif; 
										 if($this->permission->method('house_keeping','delete')->access()): ?>
                                 <a href="<?php echo base_url("house_keeping/house_keeping/delete/".html_escape($type->item_id)) ?>"
                                     onclick="return confirm('<?php echo display("are_you_sure") ?>')"
                                     class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right"
                                     title="Delete "><i class="ti-trash"></i></a>
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