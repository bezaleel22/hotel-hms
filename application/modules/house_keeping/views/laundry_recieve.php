<?php $allname = explode(",", $name);$allquantity = explode(",", $quantity);$allchecklist = explode(",,", $checklist);
$allcomment = explode(",", $comment);$allid = explode(",", $id);
for($i=0; $i<count($allname); $i++){ ?>
    <div class="d-flex justify-content-between align-items-center">
        <div class="form-group row"><span for="type" class="col"><?php echo $i+1; ?>.</span></div>
        <div class="form-group row"><label for="type" class="col"><?php echo html_escape($allname[$i]) ?></label></div>
        <div class="form-group row">
            <div class="col-sm-12"><input type="number" id="quantity" required="" min="0" class="form-control"
                    placeholder="Quantity" name="quantity[]" value="<?php echo html_escape($allquantity[$i]) ?>"></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 customesl"><select multiple name="checklist_<?php echo html_escape(($allid[$i])); ?>[]" required="" class="form-control checklist">
                    <?php 
                    $singlechecklist = explode(",", $allchecklist[$i]);
                    for($j=0; $j<count($singlechecklist); $j++){ ?>
                        <option value="<?php echo html_escape($singlechecklist[$j]); ?>" selected="selected"><?php echo ucfirst($singlechecklist[$j]); ?></option>
                    <?php } ?>
                </select></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12"><textarea col="3" name="comments[]" placeholder="Comments"
                    class="form-control"><?php echo (!empty($allcomment[$i])?html_escape($allcomment[$i]):null); ?></textarea></div>
        </div>
    </div>
    <input type="hidden" name="inv_productid[]" id="productid" value="<?php echo html_escape($allid[$i]); ?>">
<?php } ?>