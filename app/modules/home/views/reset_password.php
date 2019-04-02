<div class="box-login">
  <div class="login-form">
<!--    <ul class="login-nav" >-->
<!--        <li class="bg---><?//=THEME?><!--" style="width: 100%; border-radius: 10px 10px 0 0">-->
<!--            <a href="">--><?//=l('Forgot password')?><!--</a>-->
<!--        </li>-->
<!--    </ul>-->
    <div class="clearfix"></div>
    <form  action="<?=url('user_management/ajax_reset_password')?>" data-redirect="<?=url("?st=success")?>">
        <img src="<?=LOGO?>" title="" alt="" style="width: 130px;margin-bottom: 20px;">
        <div class="clearfix"></div>
        <input type="hidden" class="form-control" name="reset_key" value="<?=get("key")?>">
        <div class="input-group">
<!--            <span class="input-group-addon">-->
<!--                <i class="material-icons">lock</i>-->
<!--            </span>-->
            <div class="form-line">
                <input type="password" class="form-control" name="password" minlength="6" placeholder="<?=l('Password')?>" required>
            </div>
        </div>
        <div class="input-group">
<!--            <span class="input-group-addon">-->
<!--                <i class="material-icons">lock</i>-->
<!--            </span>-->
            <div class="form-line">
                <input type="password" class="form-control" name="repassword" minlength="6" placeholder="<?=l('Confirm password')?>" required>
            </div>
        </div>
        <div class="input-group">
            <button type="submit" class="right btn bg-light-green waves-effect btnActionUpdate" style="margin-bottom: 20px;"><?=l('Submit')?></button>
        </div>
        <div class="clearfix"></div>
        <div class="text-center">
            <!--                        Don't have an account? <a></a>-->
            <a href="<?=url("")?>" style="width: 100%; z-index: 999; padding: 8px 0px;font-size: 18px !important;"><?=l("Return to Login")?></a>
        </div>
    </form>
  </div>
<!--  <div class="copyright">--><?//=l('2017 © Software. All rights reserved.')?><!--</div>-->
</div>