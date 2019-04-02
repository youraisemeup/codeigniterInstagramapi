<div class="box-login">
  <div class="login-form">
<!--    <ul class="login-nav" >-->
<!--        <li class="bg---><?//=THEME?><!-- left active" style="--><?//=(REGISTER_ALLOWED == 0)?"width: 100%;":""?><!--">-->
<!--            <a href="--><?//=url("")?><!--">--><?//=l('Login')?><!--</a>-->
<!--        </li>-->
<!--        --><?php //if(REGISTER_ALLOWED == 1){?>
<!--        <li class="right bg---><?//=THEME?><!--">-->
<!--            <a href="--><?//=url("register")?><!--">--><?//=l('Register')?><!--</a>-->
<!--        </li>-->
<!--        --><?php //}?>
<!--    </ul>-->
    <div class="clearfix"></div>
    <form action="<?=url('user_management/ajax_login')?>" data-redirect="<?=current_url()?>">

        <img src="<?=LOGO?>" title="" alt="" style="width: 130px;margin-bottom: 20px;">

        <?php if((FACEBOOK_ID != "" && FACEBOOK_SECRET != "") || (GOOGLE_ID != "" && GOOGLE_SECRET != "") || (TWITTER_ID != "" && TWITTER_SECRET != "")){?>

            <div class="login-social">
                <div class="list-social">
                    <?php if(FACEBOOK_ID != "" && FACEBOOK_SECRET != ""){?>
                        <a href="<?=url("oauth/facebook")?>" title=""><img src="<?=BASE?>assets/images/btn-facebook.png" title="" alt=""></a>
                    <?php }?>
                    <?php if(GOOGLE_ID != "" && GOOGLE_SECRET != ""){?>
<!--                        <a href="--><?//=url("oauth/google")?><!--" title=""><img src="--><?//=BASE?><!--assets/images/btn-google.png" title="" alt=""></a>-->
                        <a href="<?=url("oauth/google")?>" title="" class="btn btn-danger" style="width: 100%;padding: 10px;">Sign in with Google</a>
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
        <?php }?>
        <div class="input-group">
<!--            <span class="input-group-addon">-->
<!--                <i class="material-icons">person</i>-->
<!--            </span>-->
            <div class="form-line">
                <input type="text" class="form-control" name="email" placeholder="<?=l('Email')?>" required autofocus>
            </div>
        </div>
        <div class="input-group">
<!--            <span class="input-group-addon">-->
<!--                <i class="material-icons">lock</i>-->
<!--            </span>-->
            <div class="form-line">
                <input type="password" class="form-control" name="password" placeholder="<?=l('Password')?>" required>
                <a href="javascript:void(0);" id="hideshow" class="hide_show"><i class="fa fa-eye"></i> SHOW</a>
            </div>
        </div>
        <div class="input-group">

            <button type="submit" class="right btn bg-light-green waves-effect btnActionUpdate"><?=l('Log In')?></button>
            <div class="clearfix"></div>



        </div>
        <div class="another_action" style="margin-bottom: 60px;">
            <input type="checkbox" id="md_checkbox_38" checked name="remember" class="filled-in chk-col-grey">
            <label for="md_checkbox_38"><?=l('Remember me')?></label>
            <a class="pull-right text-right" href="<?=url("forgot_password")?>"><?=l('Forgot password?')?></a>
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
        <a href="<?=url("register")?>" class="right btn new-bg-grey waves-effect" style="width: 100%;padding: 8px 0px;font-size: 18px !important;color: #000 !important;"><?=l("Sign Up")?></a>
        <!--            </div>-->


    </form>
  </div>
<!--  <div class="copyright">--><?//=l('2017 © Software. All rights reserved.')?><!--</div>-->
</div>

<script>
    $(document).ready(function(){
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

    });
</script>
