<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo (!empty($title)?$title:null) ?></h4>
            </div>
            <div class="card-body">


                <?php  //print_r($facebookloginbackapi);
				echo form_open_multipart("whatsapp/whatsappback/showsetting") ?>



                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="firstname"
                            class="col-sm-4 col-form-label"><?php echo display('whatsapp_phone_numer')?> *</label>
                        <div class="col-sm-8">
                            <input name="whats_phone" class="form-control" type="text"
                                placeholder="<?php echo display('whatsapp_phone_numer')?>" id="api_key"
                                value="<?php echo (!empty($whatsapp->whatsapp_number)?$whatsapp->whatsapp_number:null) ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="firstname" class="col-sm-4 col-form-label"> </label>
                        <div class="col-sm-8">

                            <?php echo display('whatsapp_phone_numer_internation_standard')?>

                        </div>
                    </div>

                </div>
                <div class="col-sm-6 kitchen-tab">
                    <div class="col-sm-6">
                        <div class="checkAll">
                            <input id='ischatenable' name="ischatenable" type='checkbox'
                                <?php if((!empty($whatsapp->chatenable)?$whatsapp->chatenable:null)==1){echo "checked";}?>
                                class="selectall" value="1" />
                            <label for='ischatenable'>
                                <span class="radio-shape">
                                    <i class="fa fa-check"></i>
                                </span>
                                <?php echo display('ischatenable') ?>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class="checkAll">
                            <input id='isordering' name="isordering" type='checkbox' class="selectall" value="1"
                                <?php if((!empty($whatsapp->orderenable)?$whatsapp->orderenable:null)==1){echo "checked";}?> />
                            <label for='isordering'>
                                <span class="radio-shape">
                                    <i class="fa fa-check"></i>
                                </span>
                                <?php echo display('wporder_enable') ?>
                            </label>
                        </div>
                    </div>
                    <div class="form-group text-right">

                        <button type="submit" class="btn btn-success w-md m-b-5">Save</button>
                    </div>
                </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>