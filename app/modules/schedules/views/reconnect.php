<div class="modal fade" id="modal-reconnect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document"> 
        <div class="modal-content">

        <div class="card">
            <div class="body account-pop-up custom-popup">
                <div class="row"> 
                    <div class="col-sm-12 mb0">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 style="color: #111111;"><?=l('Account Reconnect')?></h3>
                    </div>
                    <div class="col-sm-12 mb0">
                        <div class="bootstrap-alert bootstrap-alert-danger error-message" role="alert">
                            <strong>
                                <?php
                                    if( ($txt=="Connect failure") || ($txt=="Update failure") || ($txt== "Due to checkpoint you can't start/stop the activity.")){

                                        echo l("Expired session, please reconnect this account.");

                                    }elseif($txt== "Challenge required."){

                                        echo l("Instagram verification required.  Please go into your Instagram app and verify.  Once done, reconnect here.");

                                    }else{
                                        echo l($txt);
                                    } ?>

                            </strong>
                        </div>
                        <div class="bootstrap-alert bootstrap-alert-pending verification-code-alert hidden" role="alert">
                        </div>
                        <form action="<?=url('instagram_accounts/ajax_reconnect')?>" data-redirect="">
                            <div class="form-group username-input">
                                <div class="form-line">
                                    <input type="hidden" name="proxy" value="0">
                                    <input type="text" autocomplete="new-username" class="form-control" name="username" value="<?=$username;?>" placeholder="Instagram username">
                                </div>
                            </div>
                            <div class="form-group password-input">
                                <div class="form-line">
                                    <input type="password" autocomplete="new-password" class="form-control" name="password" placeholder="Password">
                                    <a href="javascript:void(0);" id="hideshow2" class="hide_show" style="top: 2px !important;"><i class="fa fa-eye"></i> SHOW</a>
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
<!--                            <b>--><?//=l('Code')?><!--</b>-->
<!--                            <div class="form-group">-->
<!--                                <div class="form-line">-->
<!--                                    <input type="text" class="form-control" name="code" placeholder="verification code">-->
<!--                                </div>-->
<!--                            </div>-->

<!--                            <button type="submit" id="addaccountbtn" class="btn bg-red waves-effect btnIGAccountUpdate">--><?//=l('Submit')?><!--</button>-->
                            <button type="submit" id="addaccountbtn" class="btn btn-dashboard bg-dashboard-success-new rounded-corner btnIGAccountUpdate text-transform-none m-t-5"><?=l('Reconnect')?></button>

                        </form>
                        <div class="m-t-15 m-b-15">
                            Unable to connect an account? <a href="javascript:void(0);" class="alert-link dotted-underline" data-toggle="modal" data-target="#modal-connect-help">Account connect help</a> <span class="label label-warning-custom">New</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>
</div>

<script>
    $(document).ready(function(){
        $('#hideshow2').click(function(){

            var newpassword = $(":input[name='password']").attr('type');
            if(newpassword == 'text'){
                $(":input[name='password']").prop("type", "password");
                $("#hideshow2").html('<i class="fa fa-eye"></i> SHOW');
            }else{
                $(":input[name='password']").prop("type", "text");
                $("#hideshow2").html('<i class="fa fa-eye-slash"></i> HIDE');
            }

        });

        $('#hideshowcode').click(function(){

            var code = $(":input[name='code']").attr('type');
            if(code == 'text'){
                $(":input[name='code']").prop("type", "password");
                $("#hideshowcode").html('<i class="fa fa-eye"></i> SHOW');
            }else{
                $(":input[name='code']").prop("type", "text");
                $("#hideshowcode").html('<i class="fa fa-eye-slash"></i> HIDE');
            }

        });

    });
</script>

