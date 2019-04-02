<div class="config-timezone">
    <div class="col-md-offset-4 col-sm-offset-3 col-md-4 col-sm-6 col-xs-12">
        <div class="card">
            
            <?php if($count < getMaximumAccount() || !empty($result)){?>
                <div class="card">
                    <div class="header">
                        <h2>
                            <i class="fa fa-plus-square" aria-hidden="true"></i> <?=l('Instagram account')?> 
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-sm-12 mb0">
                                <div class="alert alert-warning mb0">
                                    <strong><?=l('Important')?></strong>: <?=l('To start using app add your first Instagram account')?>

                                        
                                </div>

                                <div class="alert mb15 mt15" style="color: #000!important">
                                    <i class="fa fa-check-circle-o col-green" aria-hidden="true"></i> <?=l('Make sure that e-mail, which you used for registration in Instagram is real, and you have access to it.')?><br/>
                                    <i class="fa fa-check-circle-o col-green" aria-hidden="true"></i> <?=l('E-mail, which you used for registration in Instagram is confirmed and approved by Instagram.')?><br/>
                                    <i class="fa fa-check-circle-o col-green" aria-hidden="true"></i> <?=l('It is strongly recommended to bind your Instagram account to any Facebook page.')?><br/>
                                    <i class="fa fa-check-circle-o col-green" aria-hidden="true"></i> <?=l('Upload avatar and fill in your profile.')?><br/>
                                    <i class="fa fa-check-circle-o col-green" aria-hidden="true"></i> <?=l('Add at least 6 photos to your account from mobile phone.')?><br/>
                                    <i class="fa fa-check-circle-o col-green" aria-hidden="true"></i> <?=l('Ensure that your content does not violate the rules of Instagram. ')?><br/>
                                </div>

                                <form action="<?=url('instagram_accounts/ajax_update')?>" data-redirect="<?=url('activity/settings')?>">
                                    <b><?=l('Instagram username')?> (<span class="col-red">*</span>)</b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="hidden" class="form-control" name="id" value="<?=!empty($result)?$result->id:0?>">
                                            <input type="text" class="form-control" name="username">
                                        </div>
                                    </div>
                                    <b><?=l('Instagram password')?> (<span class="col-red">*</span>)</b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn bg-red waves-effect btnIGAccountUpdate"><?=l('Submit')?></button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            <?php }else{?>
            <div class="card">
                <div class="body">
                    <div class="alert alert-danger">
                        <?php redirect(PATH."payments")?>
                        <?=l('Oh sorry! You have exceeded the number of accounts allowed, You are only allowed to update your account')?>
                    </div>
                    <a href="<?=cn()?>" class="btn bg-grey waves-effect"><?=l('Back')?></a>
                </div>
            </div>
            <?php }?>
            </div>
        </div>
    </div>
</div>


