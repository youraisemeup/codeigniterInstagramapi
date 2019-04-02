<nav class="navbar navbar-default">
    <div class="container">
<!--    <div class="container-fluid">-->
        <div class="navbar-header">
<!--            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">-->
            <a href="javascript:void(0);" class="collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
<!--                <i class="fa fa-bars newdrop" style="float: right;font-size: 30px;margin-top: 10px;margin-right: 20px;color: #595959;"></i>-->
                <p style="float: right;font-size: 17px;margin-top: 10px;margin-right: 20px;color: #000;font-weight: bold;">Menu</p>
            </a>
            <?php if(session("uid")){?>
            <a href="javascript:void(0);" class="bars hidden"></a>
            <?php }?>
            <a class="navbar-brand text-center" href="<?=PATH?>">
                <img src="<?=LOGO?>" title="" alt="">
<!--                --><?//=config_item('app_name')?>
            </a>
        </div>
        
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav nav-group">
                <li><a href="https://www.igplan.com/about/" target="_blank"><?=l('About')?></a></li>
                <li><a href="https://www.igplan.com/blog/" target="_blank"><?=l('Blog')?></a></li>
                <?php if(!hashcheck()){?>
<!--                    <li><a href="--><?//=url("payments")?><!--">--><?//=l('Plans')?><!--</a></li>-->
                    <li><a href="<?=url("payments")?>"><?=l('Prices')?></a></li>
                <?php }?>
<!--                <li><a href="#">--><?//=l('Training')?><!--</a></li>-->
<!--                <li><a href="#">--><?//=l('Refer')?><!--</a></li>-->

                <?php if(!IS_ADMIN){
//                    $affiliateMenu = '<span>' . l('Affiliate') . '</span>';
                    $affiliateMenu = '<span>' . l('Refer') . '</span>';
                    ?>
                    <li class="<?=(segment(1) == "affiliate")?"active":""?>">
                        <?php if (permission_view('false', 'affiliate')) { ?>
                            <a href="<?=url('affiliate')?>">
                                <?=$affiliateMenu?>
                            </a>
                        <?php } else { ?>
                            <a type="button" class="onlyAlert" data-action="confirm" data-confirm="<?=l('You are not eligible for our affiliate program. Subscribe any one of our premium plans to get access and earn money.')?>">
                                <?=$affiliateMenu?>
                            </a>
                        <?php } ?>
                    </li>
                <?php } ?>
                <li><a href="https://www.igplan.com/support/" target="_blank"><?=l('Support')?></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">


                <?php if(permission("", true)){?>
                    <li class="dropdown <?=in_array(segment(1), array('package_settings', 'payment_settings', 'payment_history', 'affiliate_reports', 'coupon', 'user_management', 'settings'))?"active":""?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cogs fix-iconfa-sidebar" aria-hidden="true"></i><?=l('ADMIN')?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if(!hashcheck()){?>
                                <li class="dropdown-submenu <?=(segment(1) == "package_settings" || segment(1) == "payment_settings" || segment(1) == "payment_history")?"active":""?>">
                                    <a tabindex="-1" href="javascript:void(0);">
                                        <i class="fa fa-cc-paypal fix-iconfa-sidebar" aria-hidden="true"></i>
                                        <span><?=l('Payment management')?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="<?=(segment(1) == "package_settings")?"active":""?>">
                                            <a tabindex="-1" href="<?=url('package_settings')?>">
                                                <span><?=l('Package settings')?></span>
                                            </a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li class="<?=(segment(1) == "payment_settings")?"active":""?>">
                                            <a href="<?=url('payment_settings')?>">
                                                <span><?=l('Payment settings')?></span>
                                            </a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li class="<?=(segment(1) == "payment_history")?"active":""?>">
                                            <a href="<?=url('payment_history')?>">
                                                <span><?=l('Payment history')?></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php } else {?>
                                <li class="<?=(segment(1) == "package_settings")?"active":""?>">
                                    <a href="<?=url('package_settings')?>">
                                        <i class="fa fa-credit-card fix-iconfa-sidebar" aria-hidden="true"></i>
                                        <span><?=l('Package settings')?></span>
                                    </a>
                                </li>
                            <?php }?>
                            <li class="<?=(segment(1) == "affiliate_reports")?"active":""?>">
                                <a href="<?=url('affiliate_reports')?>">
                                    <i class="material-icons">attach_money</i>
                                    <span><?=l('Affiliate reports')?></span>
                                </a>
                            </li>
                            <li class="<?=(segment(1) == "coupon")?"active":""?>">
                                <a href="<?=url('coupon')?>">
                                    <i class="fa fa-ticket fix-iconfa-sidebar" aria-hidden="true"></i>
                                    <span><?=l('Coupon management')?></span>
                                </a>
                            </li>
                            <li class="<?=(segment(1) == "user_management")?"active":""?>">
                                <a href="<?=url('user_management')?>">
                                    <i class="fa fa-user fix-iconfa-sidebar" aria-hidden="true"></i>
                                    <span><?=l('User management')?></span>
                                </a>
                            </li>
                            <li class="<?=(segment(1) == "proxy")?"active":""?>">
                                <a href="<?=url('proxy')?>">
                                    <i class="material-icons">settings_input_antenna</i>
                                    <span><?=l('Proxy')?></span>
                                </a>
                            </li>
                            <li class="<?=(segment(1) == "settings")?"active":""?>">
                                <a href="<?=url('settings')?>">
                                    <i class="fa fa-cogs fix-iconfa-sidebar" aria-hidden="true"></i>
                                    <span><?=l('Settings')?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php }?>


                <?php if(session("uid")){?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user mr5"></i><?=l('Hi')?>, <?=FULLNAME_USER?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="<?=(segment(1) == "profile")?"active":""?>">
                            <a href="<?=url('profile')?>" class=" waves-effect waves-block">
                                <i class="material-icons">account_box</i>
                                <?=l('Profile')?>
                            </a>
                        </li>
                        <li>
                            <a href="<?=url('')?>" class=" waves-effect waves-block">
                                <i class="material-icons">dashboard</i>
                                <?=l('Dashboard')?>
                            </a>
                        </li>
                        <li>
                            <a href="<?=url('logout')?>" class=" waves-effect waves-block">
                                <i class="material-icons">lock_open</i>
                                <?=l('Logout')?>
                            </a>
                        </li>

                    </ul>
                </li>
                <?php }?>

                <li>
                    <?php if(session("tmp_uid")) { ?>
                        <div class="btn-group" style="margin-top: 7px; margin-left: 7px;">
                            <button type="button" class="btn btn-white waves-effect bg-white col-black btnActionBackAdmin" data-action="<?=url("user_management/ajax_action_back_admin")?>"><?=l("Back to Admin")?></button>
                        </div>
                    <?php } ?>
                </li>
            </ul>

<!--            <ul class="nav navbar-nav top-menu right mr0">-->
<!--            </ul>-->
        </div>
    </div>
</nav>