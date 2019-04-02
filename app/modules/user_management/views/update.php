<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <i class="fa fa-user" aria-hidden="true"></i> <?=l('Update user')?> 
                </h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-sm-12 mb0">
                        <form action="<?=cn('ajax_update')?>" data-redirect="<?=cn()?>">
                            <input type="hidden" class="form-control" name="id" value="<?=!empty($result)?$result->id:""?>">
                            <b><?=l('Fullname')?></b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="fullname" value="<?=!empty($result)?$result->fullname:""?>">
                                </div>
                            </div>
                            <b><?=l('Email')?></b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="email" value="<?=!empty($result)?$result->email:""?>">
                                </div>
                            </div>
                            <b><?=l('Package')?></b>
                            <div class="form-group">
                                <div class="form-group">
                                    <select name="package_id" class="form-control">
                                        <?php if(!empty($package)){
                                        foreach ($package as $row) {
                                        ?>
                                        <option value="<?=$row->id?>" <?=(!empty($result) && $row->id == $result->package_id)?"selected":""?>><?=$row->name?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div>
                            <b><?=l('Expiration date')?></b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control form-date" name="expiration_date" value="<?=!empty($result)?$result->expiration_date:""?>">
                                </div>
                            </div>
                            <b><?=l('Time zone')?></b>
                            <div class="form-group">
                                <select name="timezone" class="form-control">
                                <?php foreach(tz_list() as $t) { ?>
                                    <option value="<?=$t['zone'] ?>" <?=(!empty($result) && $result->timezone == $t['zone'])?"selected":""?>>
                                        <?=$t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
                                    </option>
                                <?php } ?>
                                </select>
                            </div>
                            <b><?=l('Password')?></b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <b><?=l('Re-password')?></b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="repassword">
                                </div>
                            </div>
                            <b><?=l('Status')?></b>
                            <div class="form-group demo-radio-button">
                                <input name="status" type="radio" id="default_yes" class="radio-col-red" <?=(!empty($result) && $result->status == 1)?"checked=''":""?> value="1">
                                <label for="default_yes"><?=l('Yes')?></label>

                                <input name="status" type="radio" id="default_no" class="radio-col-red" <?=(!empty($result) && $result->status == 0)?"checked=''":""?> value="0">
                                <label for="default_no"><?=l('No')?></label>

                            </div>
                            <button type="submit" class="btn bg-red waves-effect btnActionUpdate"><?=l('Submit')?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>