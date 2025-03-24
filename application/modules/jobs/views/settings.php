<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('job_settings'); ?></h4>
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open('jobs/settings', 'class="form-inner"') ?>
                    <?php if($this->session->flashdata('message')): ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?php echo $this->session->flashdata('message'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if($this->session->flashdata('exception')): ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?php echo $this->session->flashdata('exception'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Queue Settings -->
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                            <?php echo display('default_queue'); ?>
                            <i class="text-danger">*</i>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="default_queue" class="form-control" 
                                value="<?php echo get_config_value($configs, 'default_queue', 'default'); ?>" 
                                required>
                            <small class="text-muted">
                                <?php echo display('default_queue_help'); ?>
                            </small>
                        </div>
                    </div>

                    <!-- Job Attempts -->
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                            <?php echo display('max_attempts'); ?>
                            <i class="text-danger">*</i>
                        </label>
                        <div class="col-sm-9">
                            <input type="number" name="max_attempts" class="form-control" 
                                value="<?php echo get_config_value($configs, 'max_attempts', 3); ?>" 
                                min="1" max="10" required>
                            <small class="text-muted">
                                <?php echo display('max_attempts_help'); ?>
                            </small>
                        </div>
                    </div>

                    <!-- Retry Delay -->
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                            <?php echo display('retry_after'); ?>
                            <i class="text-danger">*</i>
                        </label>
                        <div class="col-sm-9">
                            <input type="number" name="retry_after" class="form-control" 
                                value="<?php echo get_config_value($configs, 'retry_after', 60); ?>" 
                                min="10" required>
                            <small class="text-muted">
                                <?php echo display('retry_after_help'); ?>
                            </small>
                        </div>
                    </div>

                    <!-- Queue Worker Sleep -->
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                            <?php echo display('queue_worker_sleep'); ?>
                            <i class="text-danger">*</i>
                        </label>
                        <div class="col-sm-9">
                            <input type="number" name="queue_worker_sleep" class="form-control" 
                                value="<?php echo get_config_value($configs, 'queue_worker_sleep', 3); ?>" 
                                min="1" max="10" required>
                            <small class="text-muted">
                                <?php echo display('queue_worker_sleep_help'); ?>
                            </small>
                        </div>
                    </div>

                    <!-- Batch Size -->
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                            <?php echo display('batch_size'); ?>
                            <i class="text-danger">*</i>
                        </label>
                        <div class="col-sm-9">
                            <input type="number" name="batch_size" class="form-control" 
                                value="<?php echo get_config_value($configs, 'batch_size', 100); ?>" 
                                min="10" max="1000" required>
                            <small class="text-muted">
                                <?php echo display('batch_size_help'); ?>
                            </small>
                        </div>
                    </div>

                    <!-- Log Failed Jobs -->
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                            <?php echo display('log_failed_jobs'); ?>
                        </label>
                        <div class="col-sm-9">
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" name="log_failed_jobs" value="1" 
                                    id="log_failed_jobs" 
                                    <?php echo get_config_value($configs, 'log_failed_jobs', 1) ? 'checked' : ''; ?>>
                                <label for="log_failed_jobs">
                                    <?php echo display('enable_failed_job_logging'); ?>
                                </label>
                            </div>
                            <small class="text-muted">
                                <?php echo display('log_failed_jobs_help'); ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5">
                            <?php echo display('reset'); ?>
                        </button>
                        <button type="submit" class="btn btn-success w-md m-b-5">
                            <?php echo display('save'); ?>
                        </button>
                    </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<?php
// Helper function to get config value
function get_config_value($configs, $key, $default = '') {
    foreach ($configs as $config) {
        if ($config->config_key === $key) {
            return $config->config_value;
        }
    }
    return $default;
}
?>