<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('job_queue_stats'); ?></h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <!-- Pending Jobs -->
                    <div class="col-sm-3">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3><?php echo $stats['pending']; ?></h3>
                                <p><?php echo display('pending_jobs'); ?></p>
                            </div>
                            <div class="icon"><i class="fa fa-clock-o"></i></div>
                            <a href="<?php echo base_url('jobs/pending'); ?>" class="small-box-footer">
                                <?php echo display('view_details'); ?> <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Processing Jobs -->
                    <div class="col-sm-3">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3><?php echo $stats['processing']; ?></h3>
                                <p><?php echo display('processing_jobs'); ?></p>
                            </div>
                            <div class="icon"><i class="fa fa-spinner"></i></div>
                            <a href="#" class="small-box-footer">
                                <?php echo display('currently_running'); ?>
                            </a>
                        </div>
                    </div>

                    <!-- Completed Jobs -->
                    <div class="col-sm-3">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3><?php echo $stats['completed']; ?></h3>
                                <p><?php echo display('completed_jobs'); ?></p>
                            </div>
                            <div class="icon"><i class="fa fa-check"></i></div>
                            <a href="#" class="small-box-footer">
                                <?php echo display('successful_jobs'); ?>
                            </a>
                        </div>
                    </div>

                    <!-- Failed Jobs -->
                    <div class="col-sm-3">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3><?php echo $stats['failed']; ?></h3>
                                <p><?php echo display('failed_jobs'); ?></p>
                            </div>
                            <div class="icon"><i class="fa fa-times"></i></div>
                            <a href="<?php echo base_url('jobs/failed'); ?>" class="small-box-footer">
                                <?php echo display('view_details'); ?> <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Jobs -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo display('recent_jobs'); ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo display('job_id'); ?></th>
                                                <th><?php echo display('queue'); ?></th>
                                                <th><?php echo display('status'); ?></th>
                                                <th><?php echo display('created_at'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($recent_jobs)): ?>
                                                <?php foreach($recent_jobs as $job): ?>
                                                    <tr>
                                                        <td><?php echo $job->id; ?></td>
                                                        <td><?php echo $job->queue; ?></td>
                                                        <td>
                                                            <?php
                                                                $status_class = [
                                                                    'pending' => 'label-warning',
                                                                    'processing' => 'label-info',
                                                                    'completed' => 'label-success',
                                                                    'failed' => 'label-danger'
                                                                ];
                                                            ?>
                                                            <span class="label <?php echo $status_class[$job->status]; ?>">
                                                                <?php echo ucfirst($job->status); ?>
                                                            </span>
                                                        </td>
                                                        <td><?php echo date('Y-m-d H:i:s', strtotime($job->created_at)); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="4" class="text-center"><?php echo display('no_jobs_found'); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Failed Jobs -->
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo display('recent_failed_jobs'); ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo display('job_id'); ?></th>
                                                <th><?php echo display('queue'); ?></th>
                                                <th><?php echo display('failed_at'); ?></th>
                                                <th><?php echo display('action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($recent_failed)): ?>
                                                <?php foreach($recent_failed as $job): ?>
                                                    <tr>
                                                        <td><?php echo $job->job_id; ?></td>
                                                        <td><?php echo $job->queue; ?></td>
                                                        <td><?php echo date('Y-m-d H:i:s', strtotime($job->failed_at)); ?></td>
                                                        <td>
                                                            <button class="btn btn-xs btn-info retry-job" data-id="<?php echo $job->id; ?>">
                                                                <i class="fa fa-refresh"></i> <?php echo display('retry'); ?>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="4" class="text-center"><?php echo display('no_failed_jobs'); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this at the bottom of the page -->
<script>
$(document).ready(function() {
    // Handle retry button click
    $('.retry-job').on('click', function() {
        var jobId = $(this).data('id');
        var $btn = $(this);
        
        $btn.prop('disabled', true)
            .html('<i class="fa fa-spinner fa-spin"></i> <?php echo display("retrying"); ?>');
        
        $.ajax({
            url: '<?php echo base_url("jobs/retry/"); ?>' + jobId,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    // Reload page after 1 second
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error(response.message);
                    $btn.prop('disabled', false)
                        .html('<i class="fa fa-refresh"></i> <?php echo display("retry"); ?>');
                }
            },
            error: function() {
                toastr.error('<?php echo display("request_failed"); ?>');
                $btn.prop('disabled', false)
                    .html('<i class="fa fa-refresh"></i> <?php echo display("retry"); ?>');
            }
        });
    });
});
</script>