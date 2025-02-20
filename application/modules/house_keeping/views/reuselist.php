<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="card">
            <div class="card-header">
                <h4><?php echo display('laundry')." ".display('ingradient_list'); ?></h4>
            </div>
            <div class="card-body">
                <table width="100%" id="exdatatable" class="datatable2 table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('ingredient_name') ?></th>
                            <th><?php echo display('category_name') ?></th>
                            <th><?php echo display('in_use') ?></th>
                            <th><?php echo display('in_laundry') ?></th>
                            <th><?php echo display('ready') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($reuselist)) { ?>
                        <?php $sl = 1; ?>
                        <?php foreach ($reuselist as $ingredient) { ?>
                        <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                            <td><?php echo $sl; ?></td>
                            <td><?php echo html_escape($ingredient->product_name); ?></td>
                            <td><?php echo html_escape($ingredient->categoryname); ?></td>
                            <td><?php echo html_escape($ingredient->in_use); ?></td>
                            <td><?php echo html_escape($ingredient->in_laundry); ?></td>
                            <td><?php echo html_escape($ingredient->ready); ?></td>
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