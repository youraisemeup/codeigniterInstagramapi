<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <i class="fa fa-server" aria-hidden="true"></i> <?=l('Update package')?> 
                </h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-sm-12 mb0">
                        <form action="<?=cn('ajax_update')?>" data-redirect="<?=cn()?>">
                            <input type="hidden" class="form-control" name="id" value="<?=!empty($result)?$result->id:""?>">
                            <b><?=l('Package name')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="name" value="<?=!empty($result)?$result->name:""?>">
                                </div>
                            </div>
                            <?php if((!empty($result) && $result->type==2) || empty($result)){?>
                                <b><?=l('Package price')?> (<span class="col-red">*</span>)</b>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="price" value="<?=!empty($result)?$result->price:""?>">
                                    </div>
                                </div>
                                <b><?=l('Package day')?> (<span class="col-red">*</span>)</b>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="day" value="<?=!empty($result)?$result->day:""?>">
                                    </div>
                                </div>
                                <b><?=l('Package order')?> (<span class="col-red">*</span>)</b>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="orders" value="<?=!empty($result)?$result->orders:"0"?>">
                                    </div>
                                </div>
                                <b><?=l('Package default')?> (<span class="col-red">*</span>)</b>
                                <div class="form-group demo-radio-button mb0">
                                    <input name="default" type="radio" id="default_yes" class="radio-col-red" <?=(!empty($result) && $result->default_package == 1)?"checked=''":""?> value="1">
                                    <label for="default_yes"><?=l('Yes')?></label>

                                    <input name="default" type="radio" id="default_no" class="radio-col-red" <?=(!empty($result) && $result->default_package == 0)?"checked=''":""?> value="0">
                                    <label for="default_no"><?=l('No')?></label>
                                </div>
                            <?php }else{?>
                                <b><?=l('Package price')?> (<span class="col-red">*</span>)</b>
                                <div class="form-group">
                                    <select name="type" class="form-control package-type">
                                        <option value="0" <?=(!empty($result) && $result->type==0)?"selected":""?>><?=l('Free')?></option>
                                        <option value="1" <?=(!empty($result) && $result->type==1)?"selected":""?>><?=l('Trial')?></option>
                                    </select>
                                </div>
                                <div class="package-day" style="<?=(!empty($result) && $result->type==0)?"display: none;":""?>">
                                    <b><?=l('Package day')?> (<span class="col-red">*</span>)</b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="day" value="<?=!empty($result)?$result->day:""?>">
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                            <?php 
                                $modules = array();
                                if(!empty($result)){
                                    $modules = json_decode($result->permission);
                                }
                            ?>
                            <b><?=l('Maximum Instagram account on user')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="maximum_account" value="<?=!empty($modules)?$modules->maximum_account:""?>">
                                </div>
                            </div>
                            <b><?=l('List modules')?></b>
                            <ul class="list-group">
                                <li class="list-group-item" style="padding: 7px 15px 25px;">
                                    <input type="checkbox" name="post" id="md_checkbox_1" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->post) && $modules->post == 1)?"checked":""?>>
                                    <label for="md_checkbox_1" class="mb0"><?=l('Auto post')?></label>
                                </li>
                                <li class="list-group-item" style="padding: 7px 15px 25px;">
                                    <input type="checkbox" name="message" id="md_checkbox_2" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->message) && $modules->message == 1)?"checked":""?>>
                                    <label for="md_checkbox_2" class="mb0"><?=l('Auto message')?></label>
                                </li>
                                <li class="list-group-item" style="padding: 7px 15px 25px;">
                                    <input type="checkbox" name="activity" id="md_checkbox_3" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->activity) && $modules->activity == 1)?"checked":""?>>
                                    <label for="md_checkbox_3" class="mb0"><?=l('Auto activity')?></label>
                                </li>
                                <li class="list-group-item" style="padding: 7px 15px 25px;">
                                    <input type="checkbox" name="search" id="md_checkbox_9" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->search) && $modules->search == 1)?"checked":""?>>
                                    <label for="md_checkbox_9" class="mb0"><?=l('Instagram search')?></label>
                                </li>
                                <li class="list-group-item" style="padding: 7px 15px 25px;">
                                    <input type="checkbox" name="download" id="md_checkbox_10" class="filled-in chk-col-red" value="1" <?=(!empty($modules) && isset($modules->download) && $modules->download == 1)?"checked":""?>>
                                    <label for="md_checkbox_10" class="mb0"><?=l('Instagram download')?></label>
                                </li>
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