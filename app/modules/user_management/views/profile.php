<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card profile_card">
            <div class="header" style="border-bottom: none !important;">
                <h2 style="text-align: center;">
                    <i class="fa fa-user" aria-hidden="true"></i> <?=l('Update profile')?> 
                </h2>
                <a href="<?= PATH;?>" class="col-dark-blue" style="margin: 0 auto;display: table;padding-top: 10px;">Back to Dashboard</a>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-sm-12 mb0">
                        <?php if(!empty($package)){
                            $permission = json_decode($package->permission);
                        ?>
                        <ul class="list-group">
                            <li class="list-group-item" style="background-color: #f5f8f8 !important; color: #000 !important;"><?=l('Package info')?></li>
                            <li class="list-group-item" style="color: #000 !important;"><?=$package->name?>
                                <?php if($package->type != 0){?>
                                    <span class="badge" style="background-color: #f5f8f8 !important; color: #000 !important;"><?=!empty($result)?date('d-m-Y',strtotime($result->expiration_date)):""?></span>
                                <?php }?>
                            </li>
                            <li class="list-group-item" style="color: #000 !important;"><?=l('Maximum instagram accounts')?><span class="badge" style="background-color: #f5f8f8 !important; color: #000 !important;"><?=$permission->maximum_account?></span></li>
                            <li class="list-group-item">
                                <center>
                                    <a href="<?=url('payments')?>" class="btn bg-light-green waves-effect" target="_blank"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upgrade Your Package</a>
                                </center>
                            </li>
                        </ul>
                        <?php }?>
                        <form style="color: #000 !important;" action="<?=cn('ajax_profile')?>" data-redirect="<?=current_url()?>">
                            <input type="hidden" class="form-control" name="id" value="<?=!empty($result)?$result->id:""?>">
                            <?=l('First name')?>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="fullname" value="<?=!empty($result)?$result->fullname:""?>">
                                </div>
                            </div>
                            <?=l('Email')?>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="email" value="<?=!empty($result)?$result->email:""?>" disabled="" >
                                </div>
                            </div>
                            <?=l('Time zone')?>
                            <div class="form-group">
                                <select name="timezone" class="form-control">
                                <?php foreach(tz_list() as $t) { ?>
                                    <option value="<?=$t['zone'] ?>" <?=(!empty($result) && $result->timezone == $t['zone'])?"selected":""?>>
                                        <?=$t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
                                    </option>
                                <?php } ?>
                                </select>
                            </div>
                            <?=l('Password')?>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <?=l('Re-password')?>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="repassword">
                                </div>
                            </div>
                            <?php if(!IS_ADMIN and permission_view('false', 'affiliate')) { ?>
                                <?=l('PayPal email (get payments for your referrals)')?>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="paypal_email" value="<?=!empty($result)?$result->paypal_email:""?>">
                                    </div>
                                </div>
                            <?php } ?>
                            <button type="submit" class="btn bg-light-green waves-effect btnActionUpdate"><?=l('Submit')?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>