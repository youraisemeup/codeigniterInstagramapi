<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <i class="fa fa-ticket" aria-hidden="true"></i> <?=l('Update coupon')?> 
                </h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-sm-12 mb0">
                        <form action="<?=cn('ajax_update')?>" data-redirect="<?=cn()?>">
                            <input type="hidden" class="form-control" name="id" value="<?=!empty($result)?$result->id:""?>">
                            <b><?=l('Coupon name')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="name" value="<?=!empty($result)?$result->name:""?>">
                                </div>
                            </div>
                            <b><?=l('Coupon code')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="code" value="<?=!empty($result)?$result->code:""?>">
                                </div>
                            </div>
                            <b><?=l('Type coupon')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group demo-radio-button mb0">
                                <input name="type" type="radio" id="default_yes" class="radio-col-red" <?=((!empty($result) && $result->type == 1) || empty($result))?"checked=''":""?> value="1">
                                <label for="default_yes"><?=l('Price')?></label>

                                <input name="type" type="radio" id="default_no" class="radio-col-red" <?=(!empty($result) && $result->type == 2)?"checked=''":""?> value="0">
                                <label for="default_no"><?=l('Percent')?></label>
                            </div>
                            <b><?=l('Discount (Percent/Price)')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="price" value="<?=!empty($result)?$result->price:""?>">
                                </div>
                            </div>
                            <b><?=l('Date expritation')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-date" name="date_expiration" value="<?=!empty($result)?$result->date_expiration:""?>">
                                </div>
                            </div>
                            <b><?=l('List packages')?></b>
                            <ul class="list-group">
                            <?php
                            if(!empty($packages)){

                            $item_package = array();
                            if(!empty($result)){
                                $item_package = json_decode($result->packages);
                            }

                            foreach($packages as $row){?>
                                <li class="list-group-item">
                                    <input type="checkbox" name="packages[]" id="md_checkbox_<?=$row->id?>" class="filled-in chk-col-red" value="<?=$row->id?>" <?=(in_array($row->id, $item_package))?"checked":""?>>
                                    <label for="md_checkbox_<?=$row->id?>" class="mb0"><?=$row->name?></label>
                                </li>
                            <?php }}?>
                            </ul>
                            <button type="submit" class="btn bg-red waves-effect btnActionUpdate"><?=l('Submit')?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $(document).on("change", ".package-type", function(){
            value = $(this).val();
            if(value == 0){
                $(".package-day").hide();
            }else{
                $(".package-day").show();
            }
        });
    });
</script>