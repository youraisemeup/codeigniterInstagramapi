<nav class="navbar navbar-default">
    <div class="container<?=session("uid")?"-fluid":""?>">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <?php if(session("uid")){?>
            <a href="javascript:void(0);" class="bars hidden"></a>
            <?php }?>
            <a class="navbar-brand text-center" href="<?=PATH?>"><img src="<?=LOGO?>" title="" alt=""></a>
        </div>
        
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav pull-right">
                <?php if(!hashcheck()){?>
                <li><a href="<?=url("payments")?>"><?=strtoupper(l('Pricing'))?></a></li>
                <?php }?>

                <li class="<?=(segment(1) == "dashboard")?"active":""?>">
                    <a href="<?=url('dashboard')?>">
                        <span><?=l('DASHBOARD')?></span>
                    </a>
                </li>
                <li class="<?=(segment(1) == "instagram_accounts")?"active":""?>">
                    <a href="<?=url('instagram_accounts')?>">
                        <span><?=l('INSTAGRAM ACCOUNTS')?></span>
                    </a>
                </li>
                <li class="<?=(segment(1) == "logs")?"active":""?>">
                    <a href="<?=url('logs')?>">
                        <span><?=l('LOGS')?></span>
                    </a>
                </li>
                <?php if(!IS_ADMIN){
                    $affiliateMenu = '<span>' . l('AFFILIATE') . '</span>';
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

                <?php
                // Show this section only if user has one of permissions?
                if (
                    permission("activity")
                    || permission("post")
                    || permission("message")
                    || permission("search")
                    || permission("download")
                ) {
                ?>
                <li class="dropdown <?=(in_array(segment(1), array('activity', 'post', 'save', 'message', 'search', 'download')) || in_array(segment(2), array('post', 'message')))?"active":""?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?=l('INSTAGRAM TOOLS')?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if(permission("activity")){?>
                            <li class="<?=(segment(1) == "activity")?"active":""?>">
                                <a href="<?=url('activity')?>">
                                    <i class="material-icons">favorite_border</i>
                                    <span><?=l('Auto activity')?></span>
                                </a>
                            </li>
                        <?php }?>
                        <?php if(permission("post")){?>
                            <li class="dropdown-submenu <?=(segment(1) == "post" || segment(2) == "post" || segment(1) == "save")?"active":""?>">
                                <a tabindex="-1" href="#">
                                    <i class="material-icons">send</i>
                                    <span><?=l("Auto post")?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="<?=(segment(1) == "post" && segment(2) != "bulk")?"active":""?>">
                                        <a tabindex="-1" href="<?=url('post')?>">
                                            <span><?=l('Add new')?></span>
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li class="<?=(segment(2) == "post")?"active":""?>">
                                        <a href="<?=url('schedules/post')?>">
                                            <span><?=l('Schedule post')?></span>
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li class="<?=(segment(1) == "save")?"active":""?>">
                                        <a href="<?=url('save')?>">
                                            <span><?=l('Save posts')?></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php }?>
                        <?php if(permission("message")){?>
                            <li class="dropdown-submenu <?=(segment(1) == "message" || segment(2) == "message")?"active":""?>">
                                <a tabindex="-1" href="javascript:void(0);">
                                    <i class="material-icons">message</i>
                                    <span><?=l("Auto direct message")?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="<?=(segment(1) == "message")?"active":""?>">
                                        <a tabindex="-1" href="<?=url('message')?>">
                                            <span><?=l('Add new')?></span>
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li class="<?=(segment(2) == "message")?"active":""?>">
                                        <a href="<?=url('schedules/message')?>">
                                            <span><?=l('Schedule message')?></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php }?>
                        <?php if(permission("search")){?>
                            <li class="<?=(segment(1) == "search")?"active":""?>">
                                <a href="<?=url('search')?>">
                                    <i class="material-icons">search</i>
                                    <span><?=l('Instagram search')?></span>
                                </a>
                            </li>
                        <?php }?>
                        <?php if(permission("download")){?>
                            <li class="<?=(segment(1) == "download")?"active":""?>">
                                <a href="<?=url('download')?>">
                                    <i class="material-icons">file_download</i>
                                    <span><?=l('Instagram download')?></span>
                                </a>
                            </li>
                        <?php }?>
                    </ul>
                </li>
                <?php } ?>

                <?php if(permission("", true)){?>
                <li class="dropdown <?=in_array(segment(1), array('package_settings', 'payment_settings', 'payment_history', 'affiliate_reports', 'coupon', 'user_management', 'settings'))?"active":""?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?=l('ADMIN AREA')?> <span class="caret"></span>
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
                                <?=l('Update')?>
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

                    <div class="btn-group" style="margin-top: 7px; margin-left: 7px;">
                        <button type="button" class="btn btn-white waves-effect bg-white col-black"><?=strtoupper(LANGUAGE)?></button>
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu lang-switcher" style="text-align: center; margin-top: 0px!important;">
                            <?php if(!empty($lang))
                                foreach ($lang as $row) {
                                    ?>
                                    <li><a class="waves-effect waves-block p0" href="<?=PATH?>language?l=<?=$row?>"><?=strtoupper($row)?></a></li>
                                <?php }?>
                        </ul>
                    </div>
                </li>
            </ul>

<!--            <ul class="nav navbar-nav top-menu right mr0">-->
<!--            </ul>-->
        </div>
    </div>
</nav>