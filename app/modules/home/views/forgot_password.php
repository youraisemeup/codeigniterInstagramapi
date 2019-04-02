<div class="box-login">
  <div class="login-form">
<!--    <ul class="login-nav" >-->
<!--        <li class="bg---><?//=THEME?><!--" style="width: 100%; border-radius: 10px 10px 0 0">-->
<!--            <a href="">--><?//=l('Forgot password')?><!--</a>-->
<!--        </li>-->
<!--    </ul>-->
    <div class="clearfix"></div>
    <form  action="<?=url('user_management/ajax_forgot_password')?>" data-redirect="<?=url("?st=success")?>">
        <img src="<?=LOGO?>" title="" alt="" style="width: 130px;margin-bottom: 20px;">
        <div class="clearfix"></div>
        <div class="text-center" style="margin-bottom: 20px;">
            We can help you reset your password using the email address linked to your account.
        </div>
        <div class="input-group">
<!--            <span class="input-group-addon">-->
<!--                <i class="material-icons">email</i>-->
<!--            </span>-->
            <div class="form-line">
                <input type="email" class="form-control" name="email" placeholder="<?=l('Email Address')?>" required>
            </div>
        </div>
        <div class="input-group">
<!--            <button type="submit" class="right btn bg-light-green waves-effect btnActionUpdate">--><?//=l('Submit')?><!--</button>-->
            <button type="submit" class="right btn bg-light-green waves-effect btnActionUpdate" style="margin-bottom: 20px;"><?=l('Reset Password')?></button>
        </div>
        <div class="clearfix"></div>
                    <div class="text-center">
<!--                        Don't have an account? <a></a>-->
        <a href="<?=url("")?>" style="width: 100%; z-index: 999; padding: 8px 0px;font-size: 18px !important;"><?=l("Return to Login")?></a>
                    </div>
    </form>
  </div>
<!--  <div class="copyright" style="padding-top: 155px !important;">--><?//=l('2017 © Software. All rights reserved.')?><!--</div>-->
</div>