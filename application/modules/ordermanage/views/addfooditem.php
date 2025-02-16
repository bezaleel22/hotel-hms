<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo (!empty($title)?$title:null) ?></h4>

            </div>
            <div class="card-body">


                <?php echo form_open_multipart("ordermanage/item_food/create") ?>

                <?php echo form_hidden('id',$this->session->userdata('id'));?>
                <?php echo form_hidden('ProductsID', (!empty($productinfo->ProductsID)?$productinfo->ProductsID:null)) ?>
                <input name="bigimage" type="hidden"
                    value="<?php echo (!empty($productinfo->bigthumb)?$productinfo->bigthumb:null) ?>" />
                <input name="mediumimage" type="hidden"
                    value="<?php echo (!empty($productinfo->medium_thumb)?$productinfo->medium_thumb:null) ?>" />
                <input name="smallimage" type="hidden"
                    value="<?php echo (!empty($productinfo->small_thumb)?$productinfo->small_thumb:null) ?>" />
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row">
                            <label for="category" class="col-sm-4 col-form-label"><?php echo display('category')?><i class="text-danger"> *</i></label>
                            <div class="col-sm-8">
                                <select name="CategoryID" class="form-control basic-single" required="">
                                    <option value="" selected="selected"><?php echo display('category_name')?></option>
                                    <?php foreach($categories as $caregory){?>
                                    <option value="<?php echo $caregory->CategoryID;?>" class='bolden'
                                        <?php if(!empty($productinfo)){if($productinfo->CategoryID==$caregory->CategoryID){echo "selected";}}?>>
                                        <strong><?php echo $caregory->Name;?></strong>
                                    </option>
                                    <?php if(!empty($caregory->sub)){
                                    foreach($caregory->sub as $subcat){?>
                                    <option value="<?php echo $subcat->CategoryID;?>"
                                        <?php if(!empty($productinfo)){ if($productinfo->CategoryID==$subcat->CategoryID){echo "selected";}}?>>
                                        &nbsp;&nbsp;&nbsp;&mdash;<?php echo $subcat->Name;?></option>
                                    <?php } } } ?>
                                </select>

                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="foodname" class="col-sm-4 col-form-label"><?php echo display('item_name')?> <i class="text-danger"> *</i></label>
                            <div class="col-sm-8">
                                <input name="foodname" class="form-control" type="text" placeholder="<?php echo display('item_name')?>"
                                    id="foodname"
                                    value="<?php echo (!empty($productinfo->ProductName)?$productinfo->ProductName:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="component" class="col-sm-4 col-form-label"><?php echo display('component')?> </label>
                            <div class="col-sm-8">
                                <input name="component" class="form-control" data-role="tagsinput" type="text"
                                    placeholder="<?php echo display('component')?>" id="category_subtitle"
                                    value="<?php echo (!empty($productinfo->component)?$productinfo->component:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="itemnotes" class="col-sm-4 col-form-label"><?php echo display('notes')?> </label>
                            <div class="col-sm-8">
                                <input name="itemnotes" class="form-control" type="text" placeholder="<?php echo display('notes')?>"
                                    id="itemnotes"
                                    value="<?php echo (!empty($productinfo->itemnotes)?$productinfo->itemnotes:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="itemnotes" class="col-sm-4 col-form-label"><?php echo display('description')?> </label>
                            <div class="col-sm-8">
                                <input name="descrip" class="form-control" type="text" placeholder="<?php echo display('description')?>"
                                    id="descrip"
                                    value="<?php echo (!empty($productinfo->descrip)?$productinfo->descrip:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="firstname" class="col-sm-4 col-form-label"><?php echo display('image')?> </label>
                            <div class="col-sm-8">
                                <span class="row">
                                <input type="file" accept="image/*" name="picture" onchange="loadFile(event)" class="ml-2">
                                <a href="#" class="cattooltipsimg" data-toggle="tooltip" data-placement="top" title="Use only .jpg,.jpeg,.gif and .png Images">
                                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                                </a>
                                </span>
                                <small id="fileHelp" class="text-muted">
                                    <img src="<?php echo base_url(!empty($productinfo->ProductImage)?$productinfo->ProductImage:
                                    'assets/img/icons/default.jpg'); ?>" id="output" class="img-thumbnail add_cat_img_item" />
                                </small>
                                <input name="big" type="hidden" value="" id="bigurl" />
                                <input type="hidden" name="old_image" 
                                value="<?php echo (!empty($productinfo->ProductImage)?$productinfo->ProductImage:null) ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row">
                            <label for="vat" class="col-sm-5 col-form-label"><?php echo display('vat_tax')?> 
                                <a class="cattooltips" data-toggle="tooltip" data-placement="top" title="Vat Are always Caltulate percent like: 5 means 5%;">
                                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                                </a>
                            </label>
                            <div class="col-sm-7">
                                <input name="vat" class="form-control" type="text" placeholder="0%" id="vat"
                                    value="<?php echo (!empty($productinfo->productvat)?$productinfo->productvat:'') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="firstname" class="col-sm-5 col-form-label"><?php echo display('is_offer')?> <a
                                    class="cattooltips" data-toggle="tooltip" data-placement="top"
                                    title="If use Food Special Offer then check it and fill necessary field"><i
                                        class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                            <div class="col-sm-2">
                                <div class="checkbox checkbox-success mt-10">
                                    <input type="checkbox" name="isoffer" value="1"
                                        <?php if(!empty($productinfo))if($productinfo->offerIsavailable==1){echo "checked";}?>
                                        id="isoffer">
                                    <label for="isoffer"></label>
                                </div>
                            </div>
                            <label for="special" class="col-sm-3 col-form-label"><?php echo display('is_special')?></label>
                            <div class="col-sm-2">
                                <div class="checkbox checkbox-success mt-10">
                                    <input type="checkbox" name="special" value="1"
                                        <?php if(!empty($productinfo))if($productinfo->special==1){echo "checked";}?>
                                        id="special">
                                    <label for="special"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customqty"
                                class="col-sm-5 col-form-label"><?php echo display('is_custome_quantity')?></label>
                            <div class="col-sm-2">
                                <div class="checkbox checkbox-success mt-10" >
                                    <input type="checkbox" name="customqty" value="1"
                                        <?php if(!empty($productinfo))if($productinfo->is_customqty==1){echo "checked";}?>
                                        id="customqty">
                                    <label for="customqty"></label>
                                </div>
                            </div>
                        </div>
                        <div id="offeractive"
                            class="<?php if(!empty($productinfo)){if($productinfo->offerIsavailable==1){echo "";} else{ echo "showhide";}}else{echo "showhide";}?>">
                            <div class="form-group row">
                                <label for="offerate" class="col-sm-5 col-form-label"><?php echo display('offer_rate')?> <a class="cattooltips"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Offer Rate Must be a number. It a Percentange Like: if 5% then put 5"><i
                                            class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                                <div class="col-sm-7">
                                    <input name="offerate" class="form-control" type="text" placeholder="0" id="offerate"
                                        value="<?php echo (!empty($productinfo->OffersRate)?$productinfo->OffersRate:'') ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="offerstartdate" class="col-sm-5 col-form-label"><?php echo display('offerdate')?></label>
                                <div class="col-sm-7">
                                    <input name="offerstartdate" class="form-control datepicker" type="text"
                                        placeholder="<?php echo display('offerdate')?>" id="offerstartdate"
                                        value="<?php echo (!empty($productinfo->offerstartdate)?$productinfo->offerstartdate:null) ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="offerendate" class="col-sm-5 col-form-label"><?php echo display('offer_end_date')?> </label>
                                <div class="col-sm-7">
                                    <input name="offerendate" class="form-control datepicker" type="text"
                                        placeholder="<?php echo display('offer_end_date')?>" id="offerendate"
                                        value="<?php echo (!empty($productinfo->offerendate)?$productinfo->offerendate:null) ?>">
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="vat" class="col-sm-5 col-form-label"><?php echo display('cookedtime');?></label>
                            <div class="col-sm-7">
                                <input name="cookedtime" type="text" class="form-control timepicker3" id="cookedtime"
                                    placeholder="00:00" autocomplete="off"
                                    value="<?php echo (!empty($productinfo->cookedtime)?$productinfo->cookedtime:null) ?>" />
                            </div>
                        </div>
                        <?php if(!empty($todaymenu)){?>
                        <div class="form-group row">
                            <label for="menutype" class="col-sm-5 col-form-label"><?php echo display('menu_type');?></label>
                            <div class="col-sm-7 row">
                                <?php 
                            $searcharray = [];
                            if (!empty($productinfo)) {
                                
                                $searcharray=explode(',',$productinfo->menutype);
                            }
                            $m=0;
                            foreach($todaymenu as $tmenu){
                                $m++;

                                $key = array_search($tmenu->menutypeid, $searcharray);
                                ?>
                                <div class="col-sm-4 ">
                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" name="menutype[]" value="<?php echo $tmenu->menutypeid;?>"
                                            <?php if(!empty($productinfo))if($searcharray[$key]==$tmenu->menutypeid){echo "checked";}?>
                                            id="<?php echo $m;?>">
                                        <label for="<?php echo $m;?>"><?php echo $tmenu->menutype;?></label>
                                        <input name="mytmenu_<?php echo $tmenu->menutypeid;?>" type="hidden"
                                            value="<?php echo $tmenu->menutypeid;?>" />
                                    </div>
                                </div>
                                <?php }  ?>
                            </div>
                        </div>
                        <?php  } ?>
                        <?php if(!empty($taxitems)){
                            $tx=0;
                            foreach ($taxitems as $taxitem) {
                            $field_name = 'tax'.$tx; 
                            ?>
                        <div class="form-group row">
                            <label for="vat" class="col-sm-5 col-form-label"><?php echo $taxitem['tax_name'];?></label>
                            <div class="col-sm-7">

                                <input name="<?php echo $field_name;?>" type="text" class="form-control"
                                    id="<?php echo $field_name;?>" placeholder="<?php echo $taxitem['tax_name'];?>"
                                    autocomplete="off"
                                    value="<?php echo (!empty($productinfo->$field_name)?$productinfo->$field_name:null) ?>" />
                            </div>
                        </div>
                        <?php
                            $tx++;
                            }
                        }
                        ?>

                        <div class="form-group row">
                            <label for="lastname" class="col-sm-5 col-form-label"><?php echo display('status');?></label>
                            <div class="col-sm-7">
                                <select name="status" class="form-control basic-single">
                                    <option value="" selected="selected"><?php echo display('select_option');?></option>
                                    <option value="1"
                                        <?php  if(!empty($productinfo)){if($productinfo->ProductsIsActive==1){echo "Selected";}} else{echo "Selected";} ?>>
                                        <?php echo display('active');?> </option>
                                    <option value="0"
                                        <?php if(!empty($productinfo)){if($productinfo->ProductsIsActive==0){echo "Selected";}} ?>>
                                        <?php echo display('inactive');?></option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset');?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save');?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/ordermanage/assets/js/addfooditem_script.js'); ?>"
    type="text/javascript"></script>