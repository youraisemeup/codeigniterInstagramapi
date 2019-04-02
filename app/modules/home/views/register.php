<!--<div class="box-login" style="margin: 40px auto 0 !important;">-->
<div class="box-login">
  <div class="login-form" style="margin-top: 0px !important; padding-bottom: 0px !important;">
<!--    <ul class="login-nav" >-->
<!--        <li class="bg---><?//=THEME?><!-- left">-->
<!--            <a href="--><?//=url("")?><!--">--><?//=l('Login')?><!--</a>-->
<!--        </li>-->
<!--        <li class="right bg---><?//=THEME?><!-- active">-->
<!--            <a href="--><?//=url("register")?><!--">--><?//=l('Register')?><!--</a>-->
<!--        </li>-->
<!--    </ul>-->
    <div class="clearfix"></div>
<!--    <form  action="--><?//=url('user_management/ajax_register')?><!--" data-redirect="--><?//=current_url()?><!--" style="padding-bottom: 0px !important;">-->
    <form  action="<?=url('user_management/ajax_register')?>" data-redirect="<?=current_url()?>" style="padding: 0px 20px !important;overflow: hidden;">

        <img src="<?=LOGO?>" title="" alt="" style="width: 130px;margin-bottom: 20px;">
        <div class="clearfix"></div>
        <h2 style="font-size: 28px;color: #000">Start Your 7 Day Free Trial</h2>
        <div class="text-center" style="margin-bottom: 20px;font-size: 20px;color: #000">
<!--            Sign up to grow your Instagram following on autopilot.-->
            No credit card required
        </div>
        <div class="clearfix"></div>
        <?php if((FACEBOOK_ID != "" && FACEBOOK_SECRET != "") || (GOOGLE_ID != "" && GOOGLE_SECRET != "") || (TWITTER_ID != "" && TWITTER_SECRET != "")){?>

            <div class="login-social">
                <div class="list-social">
                    <?php if(FACEBOOK_ID != "" && FACEBOOK_SECRET != ""){?>
                        <a href="<?=url("oauth/facebook")?>" title=""><img src="<?=BASE?>assets/images/btn-facebook.png" title="" alt=""></a>
                    <?php }?>
                    <?php if(GOOGLE_ID != "" && GOOGLE_SECRET != ""){?>
                        <!--                        <a href="--><?//=url("oauth/google")?><!--" title=""><img src="--><?//=BASE?><!--assets/images/btn-google.png" title="" alt=""></a>-->
                        <a href="<?=url("oauth/google")?>" title="" class="btn btn-danger" style="width: 100%;padding: 10px;">Sign up with Google</a>
                    <?php }?>
                    <?php if(TWITTER_ID != "" && TWITTER_SECRET != ""){?>
                        <a href="<?=url("oauth/twitter")?>" title=""><img src="<?=BASE?>assets/images/btn-twitter.png" title="" alt=""></a>
                    <?php }?>
                </div>
                <fieldset>
                    <!--                    <legend><span>--><?//=l('OR LOGIN VIA')?><!--</span></legend>-->
                    <legend><span><?=l('OR')?></span></legend>
                </fieldset>
            </div>
            <div class="clearfix"></div>
        <?php } ?>

        <div class="input-group">
<!--            <span class="input-group-addon">-->
<!--                <i class="material-icons">person</i>-->
<!--            </span>-->
            <div class="form-line">
                <input type="text" class="form-control" name="fullname" placeholder="<?=l('First name')?>" required autofocus>
            </div>
        </div>
        <div class="input-group">
<!--            <span class="input-group-addon">-->
<!--                <i class="material-icons">email</i>-->
<!--            </span>-->
            <div class="form-line">
                <input type="email" class="form-control" name="email" placeholder="<?=l('Email')?>" required>
            </div>
        </div>
        <div class="input-group">
<!--            <span class="input-group-addon">-->
<!--                <i class="material-icons">lock</i>-->
<!--            </span>-->
            <div class="form-line">
                <input type="password" class="form-control" name="password" minlength="6" placeholder="<?=l('Password')?>" required>
                <a href="javascript:void(0);" id="hideshow" class="hide_show"><i class="fa fa-eye"></i> SHOW</a>
            </div>
        </div>
        <div class="input-group">
<!--            <span class="input-group-addon">-->
<!--                <i class="material-icons">lock</i>-->
<!--            </span>-->
            <div class="form-line">
                <input type="password" class="form-control" name="repassword" minlength="6" placeholder="<?=l('Confirm password')?>" required>
                <a href="javascript:void(0);" id="hideshow2" class="hide_show"><i class="fa fa-eye"></i> SHOW</a>
            </div>

        </div>
        <div class="another_action" style="margin-bottom: 60px;">
            <input type="checkbox" class="filled-in chk-col-grey" id="terms">
            <label for="terms"><span class="login_check">I have read and agreed to accept the <a href="https://www.igplan.com/terms/" target="_blank" style='color:#0D509F;'>Terms</a> and <a href="https://www.igplan.com/privacy/" target="_blank" style='color:#0D509F;'>Privacy Policy</a>.</span></label>
        </div>
        <div class="input-group">

<!--            <div class="text-center" style="margin-bottom: 20px;">-->
<!--                By signing up , you agree to our Terms and Privacy Policy.-->

<!--            </div>-->
            <div class="clearfix"></div>
            <button type="submit" class="right btn bg-light-green waves-effect btnActionUpdate"><?=l('Sign Up')?></button>
<!--            <button type="submit" class="right btn bg-light-green waves-effect btnActionUpdate1">--><?//=l('Sign Up')?><!--</button>-->

<!--            <div class="clearfix"></div>-->
<!--            <div class="text-center">-->
<!--                Have an account? <a href="--><?//=url("")?><!--">--><?//=l("Log In")?><!--</a>-->
<!--            </div>-->
        </div>
        <div class="login-social">
            <fieldset>
                <!--                    <legend><span>--><?//=l('OR LOGIN VIA')?><!--</span></legend>-->
                <legend><span><?=l('OR')?></span></legend>
            </fieldset>
        </div>
        <div class="clearfix"></div>
        <!--            <div class="text-center">-->
        <!--                Don't have an account? <a></a>-->
        <a href="<?=url("")?>" class="right btn new-bg-grey waves-effect" style="color: #000 !important;width: 100%; z-index: 999; padding: 8px 0px;font-size: 18px !important;"><?=l("Log In")?></a>
        <!--            </div>-->


    </form>
  </div>
<!--    --><?php //if((FACEBOOK_ID != "" && FACEBOOK_SECRET != "") || (GOOGLE_ID != "" && GOOGLE_SECRET != "") || (TWITTER_ID != "" && TWITTER_SECRET != "")){?>
<!--        <div class="copyright" style="padding-top: 20px !important;">--><?//=l('2017 © Software. All rights reserved.')?><!--</div>-->
<!--    --><?php //}else{ ?>
<!--        <div class="copyright" style="padding-top: 70px !important;">--><?//=l('2017 © Software. All rights reserved.')?><!--</div>-->
<!--    --><?php //} ?>
</div>

<script>
    $(document).ready(function(){

        $('.btnActionUpdate').prop('disabled','true');

        $('#terms').change(function(){

            if($(this).is(':checked')){

                $('.btnActionUpdate').removeAttr('disabled');

            }else{
                $('.btnActionUpdate').prop('disabled','true');
            }

        });

        $('#hideshow').click(function(){

            var newpassword = $(":input[name='password']").attr('type');
            if(newpassword == 'text'){
                $(":input[name='password']").prop("type", "password");
                $("#hideshow").html('<i class="fa fa-eye"></i> SHOW');
            }else{
                $(":input[name='password']").prop("type", "text");
                $("#hideshow").html('<i class="fa fa-eye-slash"></i> HIDE');
            }

        });

        $('#hideshow2').click(function(){

            var newpassword = $(":input[name='repassword']").attr('type');
            if(newpassword == 'text'){
                $(":input[name='repassword']").prop("type", "password");
                $("#hideshow2").html('<i class="fa fa-eye"></i> SHOW');
            }else{
                $(":input[name='repassword']").prop("type", "text");
                $("#hideshow2").html('<i class="fa fa-eye-slash"></i> HIDE');
            }

        });
    });
</script>