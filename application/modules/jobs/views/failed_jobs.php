<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        <?php echo display('failed_jobs'); ?>
                        <?php if(!empty($jobs)): ?>
                            <button class="btn btn-danger pull-right clear-failed">
                                <i class="fa fa-trash"></i> <?php echo display('clear_failed_jobs'); ?>
                            </button>
                        <?php endif; ?>
                    </h4>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('job_id'); ?></th>
                                <th><?php echo display('queue'); ?></th>
                                <th><?php echo display('failed_at'); ?></th>
                                <th><?php echo display('exception'); ?></th>
                                <th width="150"><?php echo display('action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($jobs)): ?>
                                <?php foreach($jobs as $job): ?>
                                    <tr>
                                        <td><?php echo $job->job_id; ?></td>
                                        <td><?php echo $job->queue; ?></td>
                                        <td><?php echo date('Y-m-d H:i:s', strtotime($job->failed_at)); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-default view-exception" 
                                                    data-toggle="modal" data-target="#exceptionModal"
                                                    data-exception="<?php echo htmlspecialchars($job->exception); ?>">
                                                <i class="fa fa-eye"></i> <?php echo display('view_details'); ?>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-xs btn-info retry-job" data-id="<?php echo $job->id; ?>">
                                                <i class="fa fa-refresh"></i> <?php echo display('retry'); ?>
                                            </button>
                                            <button class="btn btn-xs btn-default view-payload" 
                                                    data-toggle="modal" data-target="#payloadModal"
                                                    data-payload="<?php echo htmlspecialchars($job->payload); ?>">
                                                <i class="fa fa-code"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <?php echo display('no_failed_jobs'); ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <?php echo $pagination; ?>
            </div>
        </div>
    </div>
</div>

<!-- Exception Modal -->
<div class="modal fade" id="exceptionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo display('exception_details'); ?></h4>
            </div>
            <div class="modal-body">
                <pre class="exception-content"></pre>
            </div>
        </div>
    </div>
</div>

<!-- Payload Modal -->
<div class="modal fade" id="payloadModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo display('job_payload'); ?></h4>
            </div>
            <div class="modal-body">
                <pre class="payload-content"></pre>
            </div>
        </div>
    </div>
</div>

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

    // Handle clear failed jobs button
    $('.clear-failed').on('click', function() {
        if(!confirm('<?php echo display("confirm_clear_failed"); ?>')) {
            return;
        }
        
        var $btn = $(this);
        $btn.prop('disabled', true)
            .html('<i class="fa fa-spinner fa-spin"></i> <?php echo display("clearing"); ?>');
        
        $.ajax({
            url: '<?php echo base_url("jobs/clear_failed"); ?>',
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error(response.message);
                    $btn.prop('disabled', false)
                        .html('<i class="fa fa-trash"></i> <?php echo display("clear_failed_jobs"); ?>');
                }
            },
            error: function() {
                toastr.error('<?php echo display("request_failed"); ?>');
                $btn.prop('disabled', false)
                    .html('<i class="fa fa-trash"></i> <?php echo display("clear_failed_jobs"); ?>');
            }
        });
    });

    // Handle view exception button
    $('.view-exception').on('click', function() {
        var exception = $(this).data('exception');
        $('#exceptionModal .exception-content').text(exception);
    });

    // Handle view payload button
    $('.view-payload').on('click', function() {
        var payload = $(this).data('payload');
        try {
            // Pretty print JSON
            var prettyPayload = JSON.stringify(JSON.parse(payload), null, 2);
            $('#payloadModal .payload-content').text(prettyPayload);
        } catch(e) {
            $('#payloadModal .payload-content').text(payload);
        }
    });
});
</script>