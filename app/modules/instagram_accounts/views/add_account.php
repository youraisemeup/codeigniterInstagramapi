    
    <?php if($count < getMaximumAccount() || !empty($result)){?>

        <div class="card">
            <div class="body account-pop-up custom-popup">
                <div class="row">
                    <div class="col-sm-12 mb0">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3><?=l('Account Connect')?></h3>
                    </div>
                    <div class="col-sm-12 mb0">
                        <div class="bootstrap-alert bootstrap-alert-success" role="alert">
                            <strong>Your account security is very important to us!</strong><br />
                            We will not store your password after this connection process. The password is required to establish a connection with Instagram. Please visit our <a href="https://www.igplan.com/support/" target="_blank" class="alert-link">Help Center</a> before you start.
                        </div>
                        <div class="bootstrap-alert bootstrap-alert-danger error-message hidden" role="alert">
                        </div>
                        <div class="bootstrap-alert bootstrap-alert-pending verification-code-alert hidden" role="alert">
                        </div>
                        <form action="<?=url('instagram_accounts/ajax_update')?>" data-redirect="<?=cn()?>">
                            <div class="form-group username-input">
                                <div class="form-line">
                                    <input type="hidden" class="form-control" name="id" value="<?=!empty($result)?$result->id:0?>">
                                    <input type="hidden" name="proxy" value="0">
                                    <input type="text" autocomplete="new-username" class="form-control" name="username" placeholder="Instagram username">
                                </div>
                            </div>
                            <div class="form-group password-input">
                                <div class="form-line">
                                    <input type="password" autocomplete="new-password" class="form-control" name="password" placeholder="Password">
                                    <a href="javascript:void(0);" id="hideshow" class="hide_show" style="top: 2px !important;"><i class="fa fa-eye"></i> SHOW</a>
                                </div>
                            </div>
                            <div class="form-group verification-code-input hidden">
<!--                                <div class="form-line input-group">-->
<!---->
<!--                                    <input type="password" autocomplete="new-password" name="code" id="verification-code" placeholder="Security code" class="form-control">-->
<!--                                    <span class="input-group-addon">-->
<!--										<i data-original-title="Show Password" data-placement="bottom" data-container="body" class="fa fa-key tooltips" onmouseover="mouseoverPass('verification-code');" onmouseout="mouseoutPass('verification-code');"></i>-->
<!--									</span>-->
<!--                                </div>-->

                                <div class="form-line">

                                    <input type="password" autocomplete="new-password" name="code" id="verification-code" placeholder="Security code" class="form-control">
                                    <a href="javascript:void(0);" id="hideshowcode" class="hide_show" style="top: 2px !important;"><i class="fa fa-eye"></i> SHOW</a>
                                </div>
                            </div>
                            <div class="text-left" style="margin-bottom: 10px;">
                                Select Who You Want To Target <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Target')?>" data-content="<?=l("Select a niche that best fits your Instagram account. We’ll use this to set up default targeting settings to help you get the best results.")?>">?</span>
                            </div>
                            <div class="form-group">
                                <div class="form-line">

                                    <select class="form-control" name="target">
                                        <?php

                                            if($targets != ''){

                                        ?>
                                                <option value="">Select Target</option>
                                        <?php
                                                foreach($targets as $row){
                                        ?>
                                            <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                                        <?php }}else{ ?>
                                            <option value="">No data</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

<!--                            <b>--><?//=l('Code')?><!--</b>-->
<!--                            <div class="form-group">-->
<!--                                <div class="form-line">-->
<!--                                    <input type="text" class="form-control" name="code" placeholder="verification code">-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <button type="submit" id="addaccountbtn" class="btn bg-red waves-effect btnIGAccountUpdate">--><?//=l('Submit')?><!--</button>-->
                            <button type="submit" id="addaccountbtn" class="btn btn-dashboard bg-dashboard-success-new rounded-corner btnIGAccountUpdate text-transform-none m-t-5">Connect</button>

                        </form>
                        <div class="m-t-15 m-b-15">
                            Unable to connect an account? <a href="javascript:void(0);" class="alert-link dotted-underline" data-toggle="modal" data-target="#modal-connect-help">Account connect help</a> <span class="label label-warning-custom">New</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }else{?>
    <div class="card">
        <div class="body">
            <div class="alert alert-danger">
                <?=l('Oh sorry! You have exceeded the number of accounts allowed, You are only allowed to update your account')?>
            </div>
            <a href="<?=cn()?>" class="btn bg-grey waves-effect"><?=l('Back')?></a>
        </div>
    </div>
    <?php }?>
    </div>

