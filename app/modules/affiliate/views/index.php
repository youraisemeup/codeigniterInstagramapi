<style>
    [data-timed-style='fade']{display:none}[data-timed-style='scale']{display:none}
    .de-image-block img {
        max-width: 100%;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 0px;
        margin-bottom: 20px;
    }
    .elBTN_b_1 {
        border: 1px solid rgba(0,0,0,0.2);
    }
    .elButtonCorner3 {
        border-radius: 3px;
    }
    .elBtnHP_25 {
        padding-left: 25px !important;
        padding-right: 25px !important;
    }
    .elBtnVP_10 {
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }
    .elButton {
        padding: 13px 35px;
    }
    .elButton {
        margin: 0 auto 8px;
        display: table;
        color: #FFF;
        /*font-weight: bold;*/
        -ms-transform: all .2s ease-in-out;
        -webkit-transform: all .2s ease-in-out;
        transform: all .2s ease-in-out;
        text-align: center !important;
        text-decoration: none !important;
    }
    b, strong {
        font-weight: 700;
    }
    .hsSize3 {
        font-size: 32px;
    }
    .padding10 {
        padding: 10px !important;
    }
</style>
<div class="row dashboard">
    <div class="col-md-12 col-sm-12 col-xs-12">
<!--        <div class="panel-group full-body" id="accordion_23" role="tablist" aria-multiselectable="true">-->
<!--            <div class="panel panel-settings mb20" style="background-color: transparent;">-->
<!--                <div class="panel-heading" role="tab" id="headingThree_23" style="border: 1px solid #fff !important;">-->
        <div style="padding: 20px;">


<!--                    <h4 class="panel-title" style="margin: 0 auto;display: table;">-->
                    <h4 class="panel-title col-black ig_heading" style="margin: 0 auto;display: table;">
<!--                        <a class="collapsed col-black ig_heading" role="button" data-toggle="collapse" href="#collapseThree_23" aria-expanded="false" aria-controls="collapseThree_23">-->
<!--                            --><?php//=l('AFFILIATE REPORT')?>
                            <?=l('Affiliate Report')?>
<!--                        </a>-->
                    </h4>
                    <a href="<?= PATH;?>" class="col-dark-blue" style="margin: 0 auto;display: table;padding-top: 10px;">Back to Dashboard</a>
        </div>
            <!--                </div>-->
<!--                <div id="collapseThree_23" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_23" aria-expanded="true">-->
<!--                    <div class="panel-body row mb0 pb0">-->
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
<!--                                <div class="info-box-2 hover-zoom-effect">-->
                                <div class="info-box-2">
                                    <div class="icon">
<!--                                        <i class="material-icons col-pink">supervisor_account</i>-->
                                        <i class="material-icons col-dark-blue">supervisor_account</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Total Referrals')?></div>
                                        <div class="number"><?=$referralCounts['total_referrals']?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
<!--                                <div class="info-box-2 hover-zoom-effect">-->
                                <div class="info-box-2">
                                    <div class="icon">
<!--                                        <i class="material-icons col-purple">query_builder</i>-->
                                        <i class="material-icons col-dark-blue">query_builder</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Total Pending Referrals')?></div>
                                        <div class="number"><?=$referralCounts['pending_referrals']?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
<!--                                <div class="info-box-2 hover-zoom-effect">-->
                                <div class="info-box-2">
                                    <div class="icon">
<!--                                        <i class="material-icons col-purple">check_circle</i>-->
                                        <i class="material-icons col-dark-blue">check_circle</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Total Paid Referrals')?></div>
                                        <div class="number"><?=$referralCounts['paid_referrals']?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
<!--                                <div class="info-box-2 hover-zoom-effect">-->
                                <div class="info-box-2">
                                    <div class="icon">
<!--                                        <i class="material-icons col-light-green">highlight_off</i>-->
                                        <i class="material-icons col-dark-blue">highlight_off</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Total Unpaid Referrals')?></div>
                                        <div class="number"><?=$referralCounts['unpaid_referrals']?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
<!--                                <div class="info-box-2 hover-zoom-effect">-->
                                <div class="info-box-2">
                                    <div class="icon">
<!--                                        <i class="material-icons col-light-green">monetization_on</i>-->
                                        <i class="material-icons col-dark-blue">monetization_on</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Total Earnings')?></div>
                                        <div class="number">$<?=$referralCounts['total_earning']?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</div>

<div class="row">
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="font-size: 20px !important;font-weight: 100 !important;">
                    <i class="fa fa-usd" aria-hidden="true"></i> <?=l('Earn Money')?>
                </h2>
            </div>
            <div class="body p0">
                <div class="well well-lg">
                    Share your referral link and earn <strong><?=$referralCommission?>%</strong> of every successful referral and their renewal for lifetime.

                    <div class="panel panel-default mt15">
                        <div class="panel-body">
                            <strong>Your Referral Link:</strong> &nbsp;&nbsp;&nbsp; <a href="<?='https://www.igplan.com/' . '?aff=' . $referralCode?>" class="alert-link"><?='https://www.igplan.com/' . '?aff=' . $referralCode?></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<form class="ScheduleList" action="<?=cn('ajax_action_multiple')?>">
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 style="font-size: 20px !important;font-weight: 100 !important;">
                                <i class="fa fa-users" aria-hidden="true"></i> <?=l('User Referrals')?>
                            </h2>
                        </div>
                        <div class="col-md-4 pull-right">
                            <div id="affiliate-range" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                <span></span> <b class="caret"></b>
                                <input type="hidden" name="date_range">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body p0">
                    <table class="table table-bordered table-striped table-hover js-dataTable dataTable mb0 affiliate-table">
                        <thead>
                            <tr>
                                <th><?=l('Name')?></th>
                                <th><?=l('Email')?></th>
                                <th><?=l('Referral Amount')?></th>
                                <th><?=l('Status')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($usersReferrals)){
                            foreach ($usersReferrals as $key => $row) {
                            ?>
                            <tr class="pending" data-action="<?=cn('ajax_action_item')?>" data-id="<?=$row['id']?>">
                                <td><?=$row['fullname']?></td>
                                <td><?=$row['email']?></td>
                                <td>$<?=$row['referral_amount']?></td>
                                <td><h4><span class="label label-<?=$referralStatuses[$row['status']]['class']?>"><?=$referralStatuses[$row['status']]['name']?></span></h4></td>
                            </tr>
                            <?php }}?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td><strong style="float: right">Total Paid</strong><br><strong style="float: right">Total Unpaid</strong></td>
                                <td><strong>$<?=$tableFooter['totalPaidAmount']?></strong><br><strong>$<?=$tableFooter['totalUnpaidAmount']?></strong></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>

<div>
<div class="dropZoneForSections ui-droppable" style="display: none;"><div class="dropIconr"><i class="fa fa-plus"></i></div></div>
<div class="container noTopMargin padding40-top padding40-bottom padding40H noBorder borderSolid border3px cornersAll radius0 activeSection_topBorder activeSection_bottomBorder activeSection_topBorder0 activeSection_bottomBorder0 emptySection fullContainer bgCover shadow0" id="section-1852710000" data-title="sales copy &amp; optin" data-block-color="0074C7" style="padding-top: 20px; padding-bottom: 20px; outline: none; background-color: rgb(255, 255, 255);" data-trigger="none" data-animate="fade" data-delay="500">
    <div class="containerInner ui-sortable">
        <div class="row bgCover noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row--13354" data-trigger="none" data-animate="fade" data-delay="500" data-title="1 column row" style="margin-bottom: 0px; outline: none; padding-top: 0px;">
            <div id="col-full-131" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="full column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin">
                    <div class="de elHeadlineWrapper ui-droppable de-editable" id="tmp_headline1-52345" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 25px; outline: none; display: block; cursor: pointer; font-family: Roboto, Helvetica, sans-serif !important;" data-google-font="Roboto" data-hide-on="" aria-disabled="false">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0 mfs_24" style="text-align: center; color: rgb(0, 0, 0); font-size: 34px;" data-bold="inherit" contenteditable="false"><b>Resources</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dropZoneForSections ui-droppable" style="display: none;"><div class="dropIconr"><i class="fa fa-plus"></i></div></div>
<div class="container fullContainer noTopMargin padding20-top padding20-bottom padding40H noBorder borderSolid border3px cornersAll radius0 shadow0 bgNoRepeat emptySection activeSection_topBorder0 activeSection_bottomBorder0" id="section--68661" data-title="Section" data-block-color="0074C7" style="padding-top: 0px; padding-bottom: 20px; outline: none;" data-trigger="none" data-animate="fade" data-delay="500">
    <div class="containerInner ui-sortable">
        <div class="row bgCover borderSolid cornersAll shadow0 P0-top P0-bottom P0H noTopMargin radius0 border2px noBorder" id="row--65826" data-trigger="none" data-animate="fade" data-delay="500" data-title="3 column row" style="padding-top: 20px; padding-bottom: 20px; margin: 0px; outline: none; border-color: rgb(245, 248, 248);">
            <div id="col-left-166" class="col-md-4 innerContent col_left ui-resizable" data-col="left" data-trigger="none" data-animate="fade" data-delay="500" data-title="1st column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px">
                    <div class="de elImageWrapper de-image-block elAlign_center elMargin0 ui-droppable de-editable" id="tmp_image-44395" data-de-type="img" data-de-editing="false" data-title="image" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; outline: none; cursor: pointer;" aria-disabled="false">
                        <img src="<?=BASE?>assets/resource/story1.png" class="elIMG ximg" alt="">
                    </div>
                </div>
            </div>
            <div id="col-center-158" class="col-md-4 innerContent col_right ui-resizable" data-col="center" data-trigger="none" data-animate="fade" data-delay="500" data-title="2nd column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px">
                    <div class="de elImageWrapper de-image-block elAlign_center elMargin0 ui-droppable de-editable" id="tmp_image-87816" data-de-type="img" data-de-editing="false" data-title="image" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; outline: none; cursor: pointer; display: block;" aria-disabled="false">
                        <img src="<?=BASE?>assets/resource/story2.jpg" class="elIMG ximg" alt="">
                    </div>
                </div>
            </div>
            <div id="col-right-154" class="col-md-4 innerContent col_right ui-resizable" data-col="right" data-trigger="none" data-animate="fade" data-delay="500" data-title="3rd column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px"><div class="de elImageWrapper de-image-block elAlign_center elMargin0 ui-droppable de-editable" id="tmp_image-30509" data-de-type="img" data-de-editing="false" data-title="image" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; outline: none; cursor: pointer; display: block;" aria-disabled="false">
                        <img src="<?=BASE?>assets/resource/story3.png" class="elIMG ximg" alt="">
                    </div></div>
            </div>
        </div>
        <div class="row bgCover borderSolid cornersAll shadow0 P0-top P0-bottom P0H noTopMargin radius0 border2px noBorder" id="row--65826-169" data-trigger="none" data-animate="fade" data-delay="500" data-title="3 column row - Clone" style="padding-top: 20px; padding-bottom: 20px; margin: 0px; outline: none; border-color: rgb(245, 248, 248);">
            <div id="col-left-166-138" class="col-md-4 innerContent col_left ui-resizable" data-col="left" data-trigger="none" data-animate="fade" data-delay="500" data-title="1st column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px">
                    <div class="de elImageWrapper de-image-block elAlign_center elMargin0 ui-droppable de-editable" id="tmp_image-44395-128" data-de-type="img" data-de-editing="false" data-title="image" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; outline: none; cursor: pointer;" aria-disabled="false">
                        <img src="<?=BASE?>assets/resource/post1.png" class="elIMG ximg" alt="">
                    </div>
                </div>
            </div>
            <div id="col-center-158-124" class="col-md-4 innerContent col_right ui-resizable" data-col="center" data-trigger="none" data-animate="fade" data-delay="500" data-title="2nd column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px">
                    <div class="de elImageWrapper de-image-block elAlign_center elMargin0 ui-droppable de-editable" id="tmp_image-87816-181" data-de-type="img" data-de-editing="false" data-title="image" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; outline: none; cursor: pointer; display: block;" aria-disabled="false">
                        <img src="<?=BASE?>assets/resource/post2.png" class="elIMG ximg" alt="">
                    </div>
                </div>
            </div>
            <div id="col-right-154-151" class="col-md-4 innerContent col_right ui-resizable" data-col="right" data-trigger="none" data-animate="fade" data-delay="500" data-title="3rd column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px"><div class="de elImageWrapper de-image-block elAlign_center elMargin0 ui-droppable de-editable" id="tmp_image-30509-167" data-de-type="img" data-de-editing="false" data-title="image" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; outline: none; cursor: pointer; display: block;" aria-disabled="false">
                        <img src="<?=BASE?>assets/resource/post3.png" class="elIMG ximg" alt="">
                    </div></div>
            </div>
        </div>
        <div class="row bgCover noBorder borderSolid border3px shadow0 P0-top P0-bottom P0H noTopMargin radius5 cornersBottom" id="row--45010-102" data-trigger="none" data-animate="fade" data-delay="500" data-title="1 column row - Clone" style="padding-top: 20px; padding-bottom: 30px; margin: 0px; outline: none; background-color: rgb(255, 255, 255);">
            <div id="col-full-132-142" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="1st column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px">
                    <div class="de elBTN elAlign_center elMargin0 ui-droppable de-editable" id="tmp_button-80641" data-de-type="button" data-de-editing="false" data-title="button" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 5px; outline: none; cursor: pointer;" aria-disabled="false">
                        <a href="https://www.dropbox.com/sh/9ltal10l258t2l8/AAAuNodJvCnXTI9_Zng78Ewta?dl=0" target="_blank" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elBtnVP_10 elButtonCorner3 elButtonFluid elBtnHP_25 elBTN_b_1 elButtonTxtColor1 elButtonShadow5" style="color: rgb(255, 255, 255); background-color: #1471b9 !important; font-size: 24px;">
                            <span class="elButtonMain">Click Here To Download All Promo Images From Dropbox</span>
                            <span class="elButtonSub"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dropZoneForSections ui-droppable" style="display: none;"><div class="dropIconr"><i class="fa fa-plus"></i></div></div>
<div class="container fullContainer noTopMargin padding20-top padding20-bottom padding40H noBorder borderSolid border3px cornersAll radius0 shadow0 bgNoRepeat emptySection activeSection_topBorder0 activeSection_bottomBorder0" id="section--68661-116-173-188" data-title="Section - Clone - Clone - Clone" data-block-color="0074C7" style="padding-top: 0px; padding-bottom: 20px; outline: none;" data-trigger="none" data-animate="fade" data-delay="500">
    <div class="containerInner ui-sortable">
        <div class="row bgCover noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row--98111-142" data-trigger="none" data-animate="fade" data-delay="500" data-title="1 column row" style="margin-bottom: 0px; outline: none; padding-top: 0px; margin-top: 5px;">
            <div id="col-full-141-175" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="full column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin">
                    <div class="de elHeadlineWrapper ui-droppable de-editable" id="tmp_headline1-29730-176" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; cursor: pointer; outline: none; font-family: Roboto, Helvetica, sans-serif !important;" data-hide-on="" aria-disabled="false" data-google-font="Roboto">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0" style="text-align: center; color: rgb(0, 0, 0); font-size: 24px;" data-bold="inherit" contenteditable="false"><b style="">Instagram Swipe</b></div>
                    </div>
                    <div class="de elHeadlineWrapper ui-droppable de-editable" id="headline-43097-181" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; cursor: pointer; outline: none; font-family: Roboto, Helvetica, sans-serif !important;" data-hide-on="" aria-disabled="false" data-google-font="Roboto">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0 mfs_20" style="text-align: center; color: rgb(45, 45, 45); font-size: 18px;" data-bold="inherit" contenteditable="false">Be Sure To Use Some Emojis :)</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bgCover borderSolid shadow0 P0-top P0-bottom P0H noTopMargin border2px radius5 cornersBottom noBorder" id="row--83511-110" data-trigger="none" data-animate="fade" data-delay="500" data-title="2 column row" style="padding-top: 20px; padding-bottom: 20px; margin: 0px; border-color: rgb(245, 248, 248); outline: none;">
            <div id="col-left-143-172" class="col-md-6 innerContent col_left ui-resizable" data-col="left" data-trigger="none" data-animate="fade" data-delay="500" data-title="1st column" style="outline: none;">
                <div class="col-inner bgCover noBorder borderSolid border3px cornersAll shadow0 P0-top P0-bottom P0H noTopMargin radius5" style="padding: 5px 15px; background-color: rgb(245, 248, 248);">
                    <div class="de elHeadlineWrapper ui-droppable hiddenElementTools de-editable" id="headline-90258-150" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; cursor: pointer; outline: none; display: block; font-family: Roboto, Helvetica, sans-serif !important;" aria-disabled="false" data-google-font="Roboto">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0" style="text-align: left; color: rgb(45, 45, 45); font-size: 16px;" data-bold="inherit" contenteditable="false">
                            <div><b>CAPTION SWIPE 1:</b></div>
                            <div><br></div>
                            <div>❓Do you want to LIVE the ONLINE business DREAM❓</div>
                            <div>🔥Click the Link In My Bio To Grow Your Following FAST! 🔥<br>
                            </div>
                            <div>@(Your IG Name)</div>
                            <div>-</div>
                            <div>✅ Followers Turn Into Dollars</div>
                            <div>-</div>
                            <div>✅ More Followers, More Leads</div>
                            <div>-</div>
                            <div>✅ Real Legit &amp; Engaged Followers</div>
                            <div>-</div>
                            <div>✅ Gain 100-250 Real Followers A Day </div>
                            <div>-</div>
                            <div>👉CLICK THE LINK IN MY BIO TO START YOUR FREE 7-DAY TRIAL 👈</div>
                            <div>@(Your IG Name)</div>
                            <div>@(Your IG Name)</div>
                            <div>@(Your IG Name)</div>
                            <div>-</div>
                            <div>😱WARNING: This software will make YOU very popular on Instagram</div>
                            <div>-</div>
                            <div>❗Go Here ➡️@(Your IG Name) and Sign Up NOW❗</div>
                            <div><br></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="col-right-121-121" class="col-md-6 innerContent col_right ui-resizable" data-col="right" data-trigger="none" data-animate="fade" data-delay="500" data-title="2nd column" style="outline: none;">
                <div class="col-inner bgCover noBorder borderSolid border3px cornersAll shadow0 P0-top P0-bottom P0H noTopMargin radius5" style="padding: 5px 15px; background-color: rgb(245, 248, 248);"><div class="de elHeadlineWrapper ui-droppable de-editable" id="headline-31872-133" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; cursor: pointer; outline: none; display: block; font-family: Roboto, Helvetica, sans-serif !important;" aria-disabled="false" data-google-font="Roboto">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0" style="text-align: left; color: rgb(45, 45, 45); font-size: 16px;" data-bold="inherit" contenteditable="false">
                            <div><b>CAPTION SWIPE 2:</b></div>
                            <div><br></div>
                            <div>🔥Free 7-Day Trial 🔥</div>
                            <div>👉Link In Bio (@Your IG Name)</div>
                            <div>-</div>
                            <div>✅ The bigger your audience, the bigger your paycheck will be. </div>
                            <div>-</div>
                            <div>✅ Let this AMAZING software grow your Instagram following on autopilot. </div>
                            <div>-</div>
                            <div>😱WARNING: This software will make YOU very popular on Instagram</div>
                            <div>-</div>
                            <div>👉CLICK THE LINK IN MY BIO TO START YOUR FREE 7-DAY TRIAL 👈</div>
                            <div>@(Your IG Name)</div>
                            <div>@(Your IG Name)</div>
                            <div>@(Your IG Name)</div>
                            <div>-</div>
                            <div>❗Go Here ➡️@(Your IG Name) and Sign Up NOW❗</div>
                            <div><br></div>
                        </div>
                    </div></div>
            </div>
        </div>
    </div>
</div>
<div class="dropZoneForSections ui-droppable" style="display: none;"><div class="dropIconr"><i class="fa fa-plus"></i></div></div>
<div class="container fullContainer noTopMargin padding20-top padding20-bottom padding40H noBorder borderSolid border3px cornersAll radius0 shadow0 bgNoRepeat emptySection activeSection_topBorder0 activeSection_bottomBorder0" id="section--68661-116-173-188-183" data-title="Section - Clone - Clone - Clone - Clone" data-block-color="0074C7" style="padding-top: 0px; padding-bottom: 20px; outline: none;" data-trigger="none" data-animate="fade" data-delay="500">
    <div class="containerInner ui-sortable">
        <div class="row bgCover noBorder borderSolid border3px shadow0 P0-top P0-bottom P0H noTopMargin radius5 cornersTop" id="row--45010-113-181-165-121" data-trigger="none" data-animate="fade" data-delay="500" data-title="1 column row" style="padding-top: 25px; padding-bottom: 25px; margin: 0px; outline: none; background-color: rgb(255, 255, 255);">
            <div id="col-full-132-188-105-178-122" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="1st column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px">
                    <div class="de elHeadlineWrapper ui-droppable de-editable" id="headline-65446-163-121-101-177" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; cursor: pointer; outline: none; display: block; font-family: Roboto, Helvetica, sans-serif !important;" data-google-font="Roboto" data-hide-on="all" aria-disabled="false">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0" style="text-align: center;" data-bold="inherit" contenteditable="false"><b>Email Swipe</b></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bgCover noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row--45580" data-trigger="none" data-animate="fade" data-delay="500" data-title="2 column row" style="padding-top: 20px; padding-bottom: 20px; margin: 0px; outline: none;">
            <div id="col-left-126" class="col-md-6 innerContent col_left ui-resizable" data-col="left" data-trigger="none" data-animate="fade" data-delay="500" data-title="1st column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px">
                    <div class="de elHeadlineWrapper ui-droppable radius5 hiddenElementTools de-editable" id="headline-82561" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; cursor: pointer; outline: none; display: block; background-color: rgb(245, 248, 248); font-family: Roboto, Helvetica, sans-serif !important;" aria-disabled="false" data-google-font="Roboto">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0 mfs_18 padding10 radius5" style="text-align: left; color: rgb(0, 0, 0); font-size: 16px; background-color: rgb(245, 248, 248);" data-bold="inherit" contenteditable="false">
                            <div><b>Email Swipe 1 - SUBJECT LINE</b></div>
                            <div><b><br></b></div>
                            <div>Grow Your Instagram Following FAST</div>
                            <div><br></div>
                            <div><b>EMAIL BODY COPY:</b></div>
                            <div><br></div>
                            <div>Hi (First Name)!</div>
                            <div><br></div>
                            <div>I want to give you some <b>FREE info</b> on the <b>best kept secret</b> on Instagram...</div>
                            <div><br></div>
                            <div>=&gt; Grow Your Instagram Following FAST <b>[HYPERLINK YOUR AFFILIATE LINK]</b>
                            </div>
                            <div><br></div>
                            <div>You may already know that Instagram is the world's fastest growing social media network.</div>
                            <div><br></div>
                            <div>But what you may not know...</div>
                            <div><br></div>
                            <div>Is that there is software out there that grows <b>your Instagram</b> following <b>on autopilot</b>.<br><br>✅ REAL followers<br>✅ REAL people<br>
                            </div>
                            <div><br></div>
                            <div>I didn't believe it myself.</div>
                            <div><br></div>
                            <div>But you gotta check this out: Grow Your Instagram Following FAST <b>[hyper link everything after the colon with you affiliate id]</b>
                            </div>
                            <div><br></div>
                            <div>Talk To You Soon!</div>
                            <div><br></div>
                            <div>(Your Name)</div>
                            <div><br></div>
                            <div>P.S. Growing your Instagram following FAST and <b>making money on Instagram has never been easier</b>. <br><br>Check out this secret website to learn more: Grow Your Instagram Following FAST <b>[hyper link everything after the colon with you affiliate id]</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="col-right-138" class="col-md-6 innerContent col_right ui-resizable" data-col="right" data-trigger="none" data-animate="fade" data-delay="500" data-title="2nd column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px"><div class="de elHeadlineWrapper ui-droppable radius5 de-editable" id="headline-57865-116" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; cursor: pointer; outline: none; display: block; background-color: rgb(245, 248, 248); font-family: Roboto, Helvetica, sans-serif !important;" aria-disabled="false" data-google-font="Roboto">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0 mfs_18 padding10 radius5" style="text-align: left; color: rgb(0, 0, 0); font-size: 16px; background-color: rgb(245, 248, 248);" data-bold="inherit" contenteditable="false">
                            <div><b>Email Swipe 2 - SUBJECT LINE</b></div>
                            <div><b><br></b></div>
                            <div>Become Popular on Instagram and Earn $$$</div>
                            <div><br></div>
                            <div><b>EMAIL BODY COPY:</b></div>
                            <div><br></div>
                            <div>Hi (First Name)!<br><br>Let me ask you a question:<br><br>✅ How would it feel if you could <b>EFFORTLESSLY gain followers</b> on Instagram <b>FAST</b>? <br><br><b>✅ Become popular</b> AND be able to make some <b>cold hard cash</b> from your followers?  <br><br>How would that change your life?<br><br>I am not talking pennies - I mean build a SOLID, <b>reliable income stream</b> just using Instagram?<br><br>It's possible for you!</div>
                            <div><br></div>
                            <div>I want to give you <b>FREE Access</b> to the <b>best kept secret</b> on Instagram...</div>
                            <div><br></div>
                            <div>=&gt; Start Growing Your Instagram Following FAST <b>[HYPERLINK YOUR AFFILIATE LINK]</b>
                            </div>
                            <div><br></div>
                            <div>You may already know that Instagram is the world's fastest growing social media platform, with over 500 MILLION daily users!  Yes, daily.</div>
                            <div><br></div>
                            <div>But what you may not know...</div>
                            <div><br></div>
                            <div>Is that there is software out there that grows <b>your Instagram</b> following <b>on autopilot.</b><br><br>
                            </div>
                            <div>I was very skeptical myself, until I saw my Instagram account grow tremendously, even while I slept. <br><br>✅ Best part - these are REAL people!<br>
                            </div>
                            <div><br></div>
                            <div>But you gotta check this out now while the FREE Access is still available: Grow Your Instagram Following FAST <b>[hyper link everything after the colon with you affiliate id]</b>
                            </div>
                            <div><br></div>
                            <div>Talk To You Soon!</div>
                            <div><br></div>
                            <div>(Your Name)</div>
                            <div><br></div>
                            <div>P.S. Growing your Instagram following FAST and <b>making money on Instagram has never been easier</b>. <br><br>Check out this secret website to learn more: Grow Your Instagram Following FAST <b>[hyper link everything after the colon with you affiliate id]</b>
                            </div>
                        </div>
                    </div></div>
            </div>
        </div>
    </div>
</div>
<div class="dropZoneForSections ui-droppable" style="display: none;"><div class="dropIconr"><i class="fa fa-plus"></i></div></div>
<div class="container fullContainer noTopMargin padding20-top padding20-bottom padding40H noBorder borderSolid border3px cornersAll radius0 shadow0 bgNoRepeat emptySection activeSection_topBorder0 activeSection_bottomBorder0" id="section--29639-128-169-122" data-title="Section - Clone - Clone - Clone" data-block-color="0074C7" style="padding-top: 0px; padding-bottom: 10px; outline: none; background-color: rgb(255, 255, 255);" data-trigger="none" data-animate="fade" data-delay="500">
    <div class="containerInner ui-sortable">
        <div class="row bgCover noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row--89891" data-trigger="none" data-animate="fade" data-delay="500" data-title="1 column row" style="padding-top: 20px; padding-bottom: 20px; margin: 0px; outline: none;">
            <div id="col-full-162" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="1st column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px">
                    <div class="de elHeadlineWrapper ui-droppable de-editable" id="headline-32686-185-178" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 20px; cursor: pointer; outline: none; display: block; font-family: Roboto, Helvetica, sans-serif !important;" data-google-font="Roboto" data-hide-on="all" aria-disabled="false">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0" style="text-align: center;" data-bold="inherit" contenteditable="false"><b>IGplan Affiliate Required Forms</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dropZoneForSections ui-droppable" style="display: none;"><div class="dropIconr"><i class="fa fa-plus"></i></div></div>
<div class="container noTopMargin padding40-top padding40-bottom padding40H noBorder borderSolid border3px cornersAll radius0 shadow0 bgNoRepeat activeSection_topBorder0 activeSection_bottomBorder0 fullContainer emptySection" id="section--52582" data-title="Section" data-block-color="0074C7" style="background-color: rgb(255, 255, 255); padding-top: 0px; padding-bottom: 20px; outline: none;" data-trigger="none" data-animate="fade" data-delay="500">
    <div class="containerInner ui-sortable">
        <div class="row bgCover noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row--72058" data-trigger="none" data-animate="fade" data-delay="500" data-title="1 column row" style="margin-bottom: 0px; outline: none;" data-hide-on="">
            <div id="col-full-184" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="full column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin">
                    <div class="de elHeadlineWrapper ui-droppable de-editable" id="headline-41817" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; outline: none; cursor: pointer; font-family: Roboto, Helvetica, sans-serif !important;" aria-disabled="false" data-google-font="Roboto" data-hide-on="">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0" style="text-align: left; font-size: 18px;" data-bold="inherit" contenteditable="false">All affiliates need to fill out and sign completed forms for the United States Internal Revenue Service (IRS). Once that has been done, please scan a copy and email it back to us (support@igplan.com ATTN: Affiliate Commissions) and our affiliate team will process the form within a week upon receiving it.<div><br></div>
                            <div>Here are direct links to the forms (only fill out one, as is relevant).  Click the button that shows your form:</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bgCover noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row--98310" data-trigger="none" data-animate="fade" data-delay="500" data-title="3 column row" style="padding-top: 20px; padding-bottom: 20px; margin: 0px; outline: none;">
            <div id="col-left-142" class="col-md-4 innerContent col_left ui-resizable" data-col="left" data-trigger="none" data-animate="fade" data-delay="500" data-title="1st column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px">
                    <div class="de elBTN elAlign_center elMargin0 ui-droppable de-editable" id="tmp_button-51552" data-de-type="button" data-de-editing="false" data-title="button" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; outline: none; cursor: pointer;" aria-disabled="false">
<!--                        <a href="https://www.irs.gov/pub/irs-pdf/fw9.pdf" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elBtnVP_10 elButtonCorner3 elButtonFluid elBtnHP_25 elBTN_b_1 elButtonShadowN1 elButtonTxtColor1" style="color: rgb(255, 255, 255); font-weight: 600; background-color: rgb(0, 117, 178); font-size: 22px;" target="_blank">-->
                        <a href="https://www.irs.gov/pub/irs-pdf/fw9.pdf" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elBtnVP_10 elButtonCorner3 elButtonFluid elBtnHP_25 elBTN_b_1 elButtonShadowN1 elButtonTxtColor1" style="color: rgb(255, 255, 255); background-color: #1471b9 !important; font-size: 22px;" target="_blank">
                            <span class="elButtonMain">W9 For United States Citizens</span>
                            <span class="elButtonSub"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div id="col-center-104" class="col-md-4 innerContent col_right ui-resizable" data-col="center" data-trigger="none" data-animate="fade" data-delay="500" data-title="2nd column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px">
                    <div class="de elBTN elAlign_center elMargin0 ui-droppable de-editable" id="button-69580" data-de-type="button" data-de-editing="false" data-title="button" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; outline: none; cursor: pointer;" aria-disabled="false">
                        <a href="https://www.irs.gov/pub/irs-pdf/fw8ben.pdf" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elBtnVP_10 elButtonCorner3 elButtonFluid elBtnHP_25 elBTN_b_1 elButtonShadowN1 elButtonTxtColor1" style="color: rgb(255, 255, 255); background-color: #1471b9 !important; font-size: 22px;" id="undefined-116" target="_blank">
                            <span class="elButtonMain">W-8BEN For non-US Citizens</span>
                            <span class="elButtonSub"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div id="col-right-179" class="col-md-4 innerContent col_right ui-resizable" data-col="right" data-trigger="none" data-animate="fade" data-delay="500" data-title="3rd column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px"><div class="de elBTN elAlign_center elMargin0 ui-droppable de-editable" id="button-66970" data-de-type="button" data-de-editing="false" data-title="button" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; outline: none; cursor: pointer;" aria-disabled="false">
                        <a href="https://www.irs.gov/pub/irs-pdf/fw8bene.pdf" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elBtnVP_10 elButtonCorner3 elButtonFluid elBtnHP_25 elBTN_b_1 elButtonShadowN1 elButtonTxtColor1" style="color: rgb(255, 255, 255); background-color: #1471b9 !important; font-size: 22px;" id="undefined-116-786" target="_blank">
                            <span class="elButtonMain">W-8BEN For Foreign Business Entities</span>
                            <span class="elButtonSub"></span>
                        </a>
                    </div></div>
            </div>
        </div>
        <div class="row bgCover noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row--72058-164" data-trigger="none" data-animate="fade" data-delay="500" data-title="1 column row - Clone" style="margin-bottom: 0px; outline: none;" data-hide-on="">
            <div id="col-full-184-101" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="full column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin">
                    <div class="de elHeadlineWrapper ui-droppable de-editable" id="headline-41817-141" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; outline: none; cursor: pointer; font-family: Roboto, Helvetica, sans-serif !important;" aria-disabled="false" data-google-font="Roboto" data-hide-on="">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0" style="text-align: left; font-size: 16px;" data-bold="inherit" contenteditable="false"><div>
                                <span style="color: inherit;">Once you have completed this form, please submit it to our accounting department by emailing it to support@igplan.com, ATTN: Affiliate Commissions</span><br>
                            </div></div>
                    </div>
                    <div class="de elHeadlineWrapper ui-droppable radius5 de-editable" id="tmp_headline1-21959-179" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 25px; cursor: pointer; outline: none; background-color: rgb(255, 255, 255); font-family: Roboto, Helvetica, sans-serif !important;" aria-disabled="false" data-google-font="Roboto">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 elInputBR5 padding10 mfs_24 hsTextShadow0 radius5" style="text-align: center; background-color: rgb(255, 255, 255); color: rgb(0, 0, 0); font-size: 22px;" data-bold="inherit" contenteditable="false">***Commissions are paid by PayPal after a 30 day "cooling off" period (due to potential refunds or cancellations).</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dropZoneForSections ui-droppable" style="display: none;"><div class="dropIconr"><i class="fa fa-plus"></i></div></div>
<div class="container fullContainer noTopMargin padding20-top padding20-bottom padding40H noBorder borderSolid border3px cornersAll radius0 shadow0 bgNoRepeat emptySection activeSection_topBorder0 activeSection_bottomBorder0" id="section--29639-128-169-122-145" data-title="Section - Clone - Clone - Clone - Clone" data-block-color="0074C7" style="padding-top: 0px; padding-bottom: 10px; outline: none; background-color: rgb(255, 255, 255);" data-trigger="none" data-animate="fade" data-delay="500">
    <div class="containerInner ui-sortable">
        <div class="row bgCover noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row--24051" data-trigger="none" data-animate="fade" data-delay="500" data-title="1 column row" style="padding-top: 20px; padding-bottom: 20px; margin: 0px; outline: none;">
            <div id="col-full-142" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="1st column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px">
                    <div class="de elHeadlineWrapper ui-droppable de-editable" id="headline-32686-185-178-104" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 20px; cursor: pointer; outline: none; display: block; font-family: Roboto, Helvetica, sans-serif !important;" data-google-font="Roboto" data-hide-on="all" aria-disabled="false">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0" style="text-align: center;" data-bold="inherit" contenteditable="false"><b>IGplan Affiliate Rules</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dropZoneForSections ui-droppable" style="display: none;"><div class="dropIconr"><i class="fa fa-plus"></i></div></div>
<div class="container noTopMargin padding40-top padding40-bottom padding40H noBorder borderSolid border3px cornersAll radius0 shadow0 bgNoRepeat activeSection_topBorder0 activeSection_bottomBorder0 fullContainer emptySection" id="section--52582-158" data-title="Section - Clone" data-block-color="0074C7" style="background-color: rgb(255, 255, 255); padding-top: 10px; padding-bottom: 20px; outline: none;" data-trigger="none" data-animate="fade" data-delay="500">
    <div class="containerInner ui-sortable">
        <div class="row bgCover noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row--72058-150" data-trigger="none" data-animate="fade" data-delay="500" data-title="1 column row" style="margin-bottom: 0px; outline: none;" data-hide-on="">
            <div id="col-full-184-105" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="full column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin">
                    <div class="de elHeadlineWrapper ui-droppable hiddenElementTools de-editable" id="headline-41817-172" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 10px; outline: none; cursor: pointer; background-color: rgb(245, 248, 248); font-family: Roboto, Helvetica, sans-serif !important;" aria-disabled="false" data-google-font="Roboto">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0 padding10" style="text-align: left; font-size: 18px; background-color: rgb(245, 248, 248);" data-bold="inherit" contenteditable="false">
                            <b>IGplan Affiliate Promotion Rules</b><div><br></div>
                            <div>It is ABSOLUTELY VITAL that every affiliate adhere to the HIGHEST POSSIBLE STANDARDS of Ethical &amp; Legal Conduct while promoting IGplan.</div>
                            <div><br></div>
                            <div>Tracking is Cookie based - last cookie gets credit for the sale. The Federal Trade Commission has clearly defined best practices for affiliate marketers, and it is our position that all affiliates of IGplan must use these guidelines and regulations as Standard Operating Procedure during their endorsement or promotion.</div>
                            <div><br></div>
                            <div>
                                <b>Step 1</b> - Download and Review the FTC Document for Endorsement Guidelines: <a href="https://ftc.gov/os/2009/10/091005revisedendorsementguides.pdf" id="link-7262-266" class="" target="_blank" style="color: rgb(30, 7, 238);">http://ftc.gov/os/2009/10/091005revisedendorsementguides.pdf</a>
                            </div>
                            <div><br></div>
                            <div>
                                <b>Step 2</b> - In addition to the FTC Guidelines, please observe the following Best Practices.  When you promote, make sure you:</div>
                            <div><br></div>
                            <div>** Include your Affiliate Disclaimers and Disclosures. The bottom line is, if you make a sale via an affiliate link, it’s because you're getting paid to do so – be honest about that. Include these disclaimers during email or advertising promotions.</div>
                            <div><br></div>
                            <div>** Include your relevant Privacy Policies on sites that you are promoting IGplan with.</div>
                            <div><br></div>
                            <div>** Include your Terms of Service on sites that you are promoting IGplan with.</div>
                            <div><br></div>
                            <div>** Include your Forward Looking Earnings Statements on sites that you are promoting IGplan with.</div>
                            <div><br></div>
                            <div>** DO NOT SPAM (Do NOT send JUNK or UNQUALIFIED TRAFFIC to this offer)</div>
                            <div><br></div>
                            <div>** Don't TWITTER SPAM or Social Media Spam</div>
                            <div><br></div>
                            <div>** Don't misrepresent yourself as a "typical result" or as a "typical customer" when you promote this offer</div>
                            <div><br></div>
                            <div>** Be transparent and authentic – We'll treat your prospects with MASSIVE RESPECT!</div>
                            <div><br></div>
                            <div>
                                <b>NOTE:</b> There will be NO commission payments paid on PERSONAL USE Sales of the Product - meaning, if the only purpose in joining this affiliate program was to get a commission on a sale for Personal USE of IGplan, that's not cool. We do track and reconcile every sale – and in cases where an affiliate has a single sale to themselves, commission will NOT be paid on that sale. That's simply NOT FAIR to the affiliates who have promoted in good faith only to have one of their prospects join the affiliate program to get their own commission and cut the original affiliate out.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dropZoneForSections ui-droppable" style="display: none;"><div class="dropIconr"><i class="fa fa-plus"></i></div></div>
<div class="container noTopMargin padding40-top padding40-bottom padding40H noBorder borderSolid border3px cornersAll radius0 shadow0 bgNoRepeat activeSection_topBorder0 activeSection_bottomBorder0 fullContainer emptySection" id="section--52582-101" data-title="Section - Clone" data-block-color="0074C7" style="background-color: rgb(255, 255, 255); padding-top: 10px; padding-bottom: 0px; outline: none;" data-trigger="none" data-animate="fade" data-delay="500">
    <div class="containerInner ui-sortable">
        <div class="row bgCover noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row--68963" data-trigger="none" data-animate="fade" data-delay="500" data-title="1 column row" style="padding-top: 0px; padding-bottom: 20px; margin: 0px; outline: none;">
            <div id="col-full-168" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="1st column" style="outline: none;">
                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px">
                    <div class="de elHeadlineWrapper ui-droppable de-editable" id="headline-32686-185-178-104-105" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 20px; cursor: pointer; outline: none; display: block; font-family: Roboto, Helvetica, sans-serif !important;" data-google-font="Roboto" data-hide-on="all" aria-disabled="false">
                        <div class="ne elHeadline hsSize3 lh3 elMargin0 elBGStyle0 hsTextShadow0" style="text-align: center;" data-bold="inherit" contenteditable="false"><b>Have Questions?</b></div>
                    </div>
                    <div class="de elBTN elAlign_center elMargin0 ui-droppable de-editable" id="tmp_button-80663" data-de-type="button" data-de-editing="false" data-title="button" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 30px; outline: none; cursor: pointer; font-family: Roboto, Helvetica, sans-serif !important;" aria-disabled="false" data-google-font="Roboto">
                        <a href="mailto:support@igplan.com" class="elButton elButtonSize1 elButtonColor1 elButtonRounded elButtonPadding2 elBtnVP_10 elButtonFluid elBtnHP_25 elBTN_b_1 elButtonCorner5 elButtonShadow6 elButtonTxtColor2 mfs_20" style="color: rgb(255, 255, 255); background-color: #1471b9 !important; font-size: 30px;" target="_blank">
                            <span class="elButtonMain"><i class="fa_prepended fa fa-arrow-circle-right"></i> Submit A Support Ticket</span>
                            <span class="elButtonSub"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="dropZoneForSections ui-droppable" style="display: none;"><div class="dropIconr"><i class="fa fa-plus"></i></div></div>-->
<!--<div class="container noTopMargin padding40-top padding40-bottom padding40H borderSolid cornersAll radius0 shadow0 activeSection_topBorder0 activeSection_bottomBorder0 fullContainer bgCover borderLightTop border2px emptySection" id="section--39766" data-title="Section" data-block-color="0074C7" style="padding-top: 30px; padding-bottom: 40px; outline: none; border-color: rgba(0, 0, 0, 0.098); background-color: rgb(255, 255, 255); margin-top: 60px; border-top: 2px solid #e6e6e6; width:100%;" data-trigger="none" data-animate="fade" data-delay="500" data-hide-on="">-->
<!--    <div class="containerInner ui-sortable" style="padding-left: 20px; padding-right: 20px;">-->
<!--        <div class="row bgCover noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" id="row--77398" data-trigger="none" data-animate="fade" data-delay="500" data-title="1 column row" style="padding-top: 20px; padding-bottom: 20px; margin: 0px; outline: none;">-->
<!--            <div id="col-full-185" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="1st column" style="outline: none;">-->
<!--                <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin" style="padding: 0 10px">-->
<!--                    <div class="de elHeadlineWrapper ui-droppable de-editable" id="tmp_headline1-55285" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; outline: none; cursor: pointer;" aria-disabled="false">-->
<!--                        <div class="ne elHeadline hsSize3 lh4 elMargin0 elBGStyle0 hsTextShadow0" style="text-align: center;font-size: 32px" data-bold="inherit" data-gramm="false" contenteditable="false">-->
<!--                            <b>STOCK SITE FOOTER</b>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="dropZoneForSections ui-droppable" style="display: none;"><div class="dropIconr"><i class="fa fa-plus"></i></div></div>
<style id="bold_style_tmp_headline1-87872">#tmp_headline1-87872 .elHeadline b{ color: rgb(255, 255, 255);}</style>
<style id="bold_style_tmp_headline1-21841">#tmp_headline1-21841 .elHeadline b{color:rgb(156,49,49);}</style>
<style id="button_style_tmp_button-17235">#tmp_button-17235 .elButtonFlat:hover{background-color:#dc0f0f!important;}#tmp_button-17235 .elButtonBottomBorder:hover{background-color:#dc0f0f!important;}#tmp_button-17235 .elButtonSubtle:hover{background-color:#dc0f0f!important;}#tmp_button-17235 .elButtonGradient{background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0,rgb(240,36,36)),color-stop(1,#dc0f0f));background-image:-o-linear-gradient(bottom,rgb(240,36,36) 0%,#dc0f0f 100%);background-image:-moz-linear-gradient(bottom,rgb(240,36,36) 0%,#dc0f0f 100%);background-image:-webkit-linear-gradient(bottom,rgb(240,36,36) 0%,#dc0f0f 100%);background-image:-ms-linear-gradient(bottom,rgb(240,36,36) 0%,#dc0f0f 100%);background-image:linear-gradient(to bottom,rgb(240,36,36) 0%,#dc0f0f 100%);}#tmp_button-17235 .elButtonGradient:hover{background-image:-webkit-gradient(linear,left top,left bottom,color-stop(1,rgb(240,36,36)),color-stop(0,#dc0f0f));background-image:-o-linear-gradient(bottom,rgb(240,36,36) 100%,#dc0f0f 0%);background-image:-moz-linear-gradient(bottom,rgb(240,36,36) 100%,#dc0f0f 0%);background-image:-webkit-linear-gradient(bottom,rgb(240,36,36) 100%,#dc0f0f 0%);background-image:-ms-linear-gradient(bottom,rgb(240,36,36) 100%,#dc0f0f 0%);background-image:linear-gradient(to bottom,rgb(240,36,36) 100%,#dc0f0f 0%);}#tmp_button-17235 .elButtonBorder{border:3px solid rgb(240,36,36)!important;color:rgb(240,36,36)!important;}#tmp_button-17235 .elButtonBorder:hover{background-color:rgb(240,36,36)!important;color:#FFF!important;}</style>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=sans-serif%7CRoboto%7Csans-serif%7CRoboto%7Csans-serif%7CRoboto%7Csans-serif%7C%7C" id="custom_google_font">
<style id="bold_style_tmp_headline1-67935">#tmp_headline1-67935 .elHeadline b{color:rgb(0,0,0);}</style>
<style id="bold_style_headline-29463">#headline-29463 .elHeadline b{color:rgb(0,0,0);}</style>
<style id="bold_style_headline-59051">#headline-59051 .elHeadline b{color:rgb(0,0,0);}</style>
<style id="bold_style_headline-80314">#headline-80314 .elHeadline b{color:rgb(0,0,0);}</style>
<style id="bold_style_tmp_headline1-21959">#tmp_headline1-21959 .elHeadline b{color:rgb(255,0,0);}</style>
<style id="bold_style_headline-74723">#headline-74723 .elHeadline b{color:rgb(0,120,255);}</style>
<style id="button_style_button-30316">#button-30316 .elButtonFlat:hover{background-color:#0086c2!important;}#button-30316 .elButtonBottomBorder:hover{background-color:#0086c2!important;}#button-30316 .elButtonSubtle:hover{background-color:#0086c2!important;}#button-30316 .elButtonGradient{background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0,rgb(0,162,235)),color-stop(1,#0086c2));background-image:-o-linear-gradient(bottom,rgb(0,162,235) 0%,#0086c2 100%);background-image:-moz-linear-gradient(bottom,rgb(0,162,235) 0%,#0086c2 100%);background-image:-webkit-linear-gradient(bottom,rgb(0,162,235) 0%,#0086c2 100%);background-image:-ms-linear-gradient(bottom,rgb(0,162,235) 0%,#0086c2 100%);background-image:linear-gradient(to bottom,rgb(0,162,235) 0%,#0086c2 100%);}#button-30316 .elButtonGradient:hover{background-image:-webkit-gradient(linear,left top,left bottom,color-stop(1,rgb(0,162,235)),color-stop(0,#0086c2));background-image:-o-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 0%);background-image:-moz-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 0%);background-image:-webkit-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 0%);background-image:-ms-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 0%);background-image:linear-gradient(to bottom,rgb(0,162,235) 100%,#0086c2 0%);}#button-30316 .elButtonGradient2{background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0,rgb(0,162,235)),color-stop(1,#0086c2));background-image:-o-linear-gradient(bottom,rgb(0,162,235) 30%,#0086c2 80%);background-image:-moz-linear-gradient(bottom,rgb(0,162,235) 30%,#0086c2 80%);background-image:-webkit-linear-gradient(bottom,rgb(0,162,235) 30%,#0086c2 80%);background-image:-ms-linear-gradient(bottom,rgb(0,162,235) 30%,#0086c2 80%);background-image:linear-gradient(to bottom,rgb(0,162,235) 30%,#0086c2 80%);}#button-30316 .elButtonGradient2:hover{background-image:-webkit-gradient(linear,left top,left bottom,color-stop(1,rgb(0,162,235)),color-stop(0,#0086c2));background-image:-o-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 30%);background-image:-moz-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 30%);background-image:-webkit-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 30%);background-image:-ms-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 30%);background-image:linear-gradient(to bottom,rgb(0,162,235) 100%,#0086c2 30%);}#button-30316 .elButtonBorder{border:3px solid rgb(0,162,235)!important;color:rgb(0,162,235)!important;}#button-30316 .elButtonBorder:hover{background-color:rgb(0,162,235)!important;color:#FFF!important;}</style>
<style id="bold_style_headline-15369">#headline-15369 .elHeadline b{color:rgb(0,0,0);}</style>
<style id="bold_style_headline-32504">#headline-32504 .elHeadline b{color:rgb(0,0,0);}</style>
<style id="bold_style_headline-60691">#headline-60691 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_tmp_headline1-86445">#tmp_headline1-86445 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_tmp_headline1-95622">#tmp_headline1-95622 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-63708">#headline-63708 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_tmp_headline1-87872-129">#tmp_headline1-87872-129 .elHeadline b{ color: rgb(255, 255, 255);}</style>
<style id="bold_style_headline-57370">#headline-57370 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-75226">#headline-75226 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-44699">#headline-44699 .elHeadline b{ color: rgb(0, 0, 0);}</style>
<style id="button_style_tmp_button-26609-187">#tmp_button-26609-187 .elButtonFlat:hover{background-color:#0086c2!important;}#tmp_button-26609-187 .elButtonBottomBorder:hover{background-color:#0086c2!important;}#tmp_button-26609-187 .elButtonSubtle:hover{background-color:#0086c2!important;}#tmp_button-26609-187 .elButtonGradient{background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0,rgb(0,162,235)),color-stop(1,#0086c2));background-image:-o-linear-gradient(bottom,rgb(0,162,235) 0%,#0086c2 100%);background-image:-moz-linear-gradient(bottom,rgb(0,162,235) 0%,#0086c2 100%);background-image:-webkit-linear-gradient(bottom,rgb(0,162,235) 0%,#0086c2 100%);background-image:-ms-linear-gradient(bottom,rgb(0,162,235) 0%,#0086c2 100%);background-image:linear-gradient(to bottom,rgb(0,162,235) 0%,#0086c2 100%);}#tmp_button-26609-187 .elButtonGradient:hover{background-image:-webkit-gradient(linear,left top,left bottom,color-stop(1,rgb(0,162,235)),color-stop(0,#0086c2));background-image:-o-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 0%);background-image:-moz-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 0%);background-image:-webkit-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 0%);background-image:-ms-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 0%);background-image:linear-gradient(to bottom,rgb(0,162,235) 100%,#0086c2 0%);}#tmp_button-26609-187 .elButtonGradient2{background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0,rgb(0,162,235)),color-stop(1,#0086c2));background-image:-o-linear-gradient(bottom,rgb(0,162,235) 30%,#0086c2 80%);background-image:-moz-linear-gradient(bottom,rgb(0,162,235) 30%,#0086c2 80%);background-image:-webkit-linear-gradient(bottom,rgb(0,162,235) 30%,#0086c2 80%);background-image:-ms-linear-gradient(bottom,rgb(0,162,235) 30%,#0086c2 80%);background-image:linear-gradient(to bottom,rgb(0,162,235) 30%,#0086c2 80%);}#tmp_button-26609-187 .elButtonGradient2:hover{background-image:-webkit-gradient(linear,left top,left bottom,color-stop(1,rgb(0,162,235)),color-stop(0,#0086c2));background-image:-o-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 30%);background-image:-moz-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 30%);background-image:-webkit-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 30%);background-image:-ms-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 30%);background-image:linear-gradient(to bottom,rgb(0,162,235) 100%,#0086c2 30%);}#tmp_button-26609-187 .elButtonBorder{border:3px solid rgb(0,162,235)!important;color:rgb(0,162,235)!important;}#tmp_button-26609-187 .elButtonBorder:hover{background-color:rgb(0,162,235)!important;color:#FFF!important;}</style>
<style id="button_style_button-30316-109">#button-30316-109 .elButtonFlat:hover{background-color:#0086c2!important;}#button-30316-109 .elButtonBottomBorder:hover{background-color:#0086c2!important;}#button-30316-109 .elButtonSubtle:hover{background-color:#0086c2!important;}#button-30316-109 .elButtonGradient{background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0,rgb(0,162,235)),color-stop(1,#0086c2));background-image:-o-linear-gradient(bottom,rgb(0,162,235) 0%,#0086c2 100%);background-image:-moz-linear-gradient(bottom,rgb(0,162,235) 0%,#0086c2 100%);background-image:-webkit-linear-gradient(bottom,rgb(0,162,235) 0%,#0086c2 100%);background-image:-ms-linear-gradient(bottom,rgb(0,162,235) 0%,#0086c2 100%);background-image:linear-gradient(to bottom,rgb(0,162,235) 0%,#0086c2 100%);}#button-30316-109 .elButtonGradient:hover{background-image:-webkit-gradient(linear,left top,left bottom,color-stop(1,rgb(0,162,235)),color-stop(0,#0086c2));background-image:-o-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 0%);background-image:-moz-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 0%);background-image:-webkit-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 0%);background-image:-ms-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 0%);background-image:linear-gradient(to bottom,rgb(0,162,235) 100%,#0086c2 0%);}#button-30316-109 .elButtonGradient2{background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0,rgb(0,162,235)),color-stop(1,#0086c2));background-image:-o-linear-gradient(bottom,rgb(0,162,235) 30%,#0086c2 80%);background-image:-moz-linear-gradient(bottom,rgb(0,162,235) 30%,#0086c2 80%);background-image:-webkit-linear-gradient(bottom,rgb(0,162,235) 30%,#0086c2 80%);background-image:-ms-linear-gradient(bottom,rgb(0,162,235) 30%,#0086c2 80%);background-image:linear-gradient(to bottom,rgb(0,162,235) 30%,#0086c2 80%);}#button-30316-109 .elButtonGradient2:hover{background-image:-webkit-gradient(linear,left top,left bottom,color-stop(1,rgb(0,162,235)),color-stop(0,#0086c2));background-image:-o-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 30%);background-image:-moz-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 30%);background-image:-webkit-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 30%);background-image:-ms-linear-gradient(bottom,rgb(0,162,235) 100%,#0086c2 30%);background-image:linear-gradient(to bottom,rgb(0,162,235) 100%,#0086c2 30%);}#button-30316-109 .elButtonBorder{border:3px solid rgb(0,162,235)!important;color:rgb(0,162,235)!important;}#button-30316-109 .elButtonBorder:hover{background-color:rgb(0,162,235)!important;color:#FFF!important;}</style>
<style id="button_style_tmp_button-26609">#tmp_button-26609 .elButtonFlat:hover{ background-color: #f24802 !important;}
    #tmp_button-26609 .elButtonBottomBorder:hover{ background-color: #f24802 !important;}
    #tmp_button-26609 .elButtonSubtle:hover{ background-color: #f24802 !important;}
    #tmp_button-26609 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(253, 96, 32)), color-stop(1, #f24802));                                                 background-image: -o-linear-gradient(bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                                 background-image: linear-gradient(to bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                             }
    #tmp_button-26609 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(253, 96, 32)), color-stop(0, #f24802));                                                 background-image: -o-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                                 background-image: linear-gradient(to bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                             }
    #tmp_button-26609 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(253, 96, 32)), color-stop(1, #f24802));     background-image: -o-linear-gradient(bottom, rgb(253, 96, 32) 30%, #f24802 80%);     background-image: -moz-linear-gradient(bottom, rgb(253, 96, 32) 30%, #f24802 80%);     background-image: -webkit-linear-gradient(bottom, rgb(253, 96, 32) 30%, #f24802 80%);     background-image: -ms-linear-gradient(bottom, rgb(253, 96, 32) 30%, #f24802 80%);     background-image: linear-gradient(to bottom, rgb(253, 96, 32) 30%, #f24802 80%); }
    #tmp_button-26609 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(253, 96, 32)), color-stop(0, #f24802));     background-image: -o-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 30%);     background-image: -moz-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 30%);     background-image: -webkit-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 30%);     background-image: -ms-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 30%);     background-image: linear-gradient(to bottom, rgb(253, 96, 32) 100%, #f24802 30%); }
    #tmp_button-26609 .elButtonBorder{                        border: 3px solid rgb(253, 96, 32) !important;                         color: rgb(253, 96, 32) !important;                     }
    #tmp_button-26609 .elButtonBorder:hover{                          background-color:rgb(253, 96, 32) !important;                          color: #FFF !important;                       }
</style>
<style id="bold_style_headline-60691-148">#headline-60691-148 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-57370-125">#headline-57370-125 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-63708-111">#headline-63708-111 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_tmp_headline1-86445-147">#tmp_headline1-86445-147 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-44699-100">#headline-44699-100 .elHeadline b{ color: rgb(0, 0, 0);}</style>
<style id="bold_style_headline-75226-161">#headline-75226-161 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_tmp_headline1-95622-169">#tmp_headline1-95622-169 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-63708-181">#headline-63708-181 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-60691-164">#headline-60691-164 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-57370-124">#headline-57370-124 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_tmp_headline1-86445-168">#tmp_headline1-86445-168 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-44699-166">#headline-44699-166 .elHeadline b{ color: rgb(0, 0, 0);}</style>
<style id="bold_style_headline-75226-157">#headline-75226-157 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_tmp_headline1-95622-148">#tmp_headline1-95622-148 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-63708-157">#headline-63708-157 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_tmp_headline1-86445-157">#tmp_headline1-86445-157 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-44699-129">#headline-44699-129 .elHeadline b{ color: rgb(0, 0, 0);}</style>
<style id="bold_style_headline-29302">#headline-29302 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_tmp_headline1-67935-141">#tmp_headline1-67935-141 .elHeadline b{color:rgb(0,0,0);}</style>
<style id="bold_style_headline-15369-154">#headline-15369-154 .elHeadline b{color:rgb(0,0,0);}</style>
<style id="bold_style_headline-29463-168">#headline-29463-168 .elHeadline b{color:rgb(0,0,0);}</style>
<style id="bold_style_headline-32504-142">#headline-32504-142 .elHeadline b{color:rgb(0,0,0);}</style>
<style id="bold_style_headline-59051-109">#headline-59051-109 .elHeadline b{color:rgb(0,0,0);}</style>
<style id="bold_style_headline-80314-157">#headline-80314-157 .elHeadline b{color:rgb(0,0,0);}</style>
<style id="bold_style_tmp_headline1-21959-146">#tmp_headline1-21959-146 .elHeadline b{color:rgb(255,0,0);}</style>
<style id="bold_style_tmp_headline1-21959-135">#tmp_headline1-21959-135 .elHeadline b{color:rgb(255,0,0);}</style>
<style id="bold_style_tmp_headline1-21959-118">#tmp_headline1-21959-118 .elHeadline b{color:rgb(255,0,0);}</style>
<style id="bold_style_tmp_headline1-21959-168">#tmp_headline1-21959-168 .elHeadline b{color:rgb(255,0,0);}</style>
<style id="button_style_headline-95824">#headline-95824 .elButtonFlat:hover{ background-color: #000517 !important;}
    #headline-95824 .elButtonBottomBorder:hover{ background-color: #000517 !important;}
    #headline-95824 .elButtonSubtle:hover{ background-color: #000517 !important;}
    #headline-95824 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 13, 64)), color-stop(1, #000517));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 13, 64) 0%, #000517 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 13, 64) 0%, #000517 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 13, 64) 0%, #000517 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 13, 64) 0%, #000517 100%);                                                 background-image: linear-gradient(to bottom, rgb(0, 13, 64) 0%, #000517 100%);                                             }
    #headline-95824 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 13, 64)), color-stop(0, #000517));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 0%);                                                 background-image: linear-gradient(to bottom, rgb(0, 13, 64) 100%, #000517 0%);                                             }
    #headline-95824 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 13, 64)), color-stop(1, #000517));     background-image: -o-linear-gradient(bottom, rgb(0, 13, 64) 30%, #000517 80%);     background-image: -moz-linear-gradient(bottom, rgb(0, 13, 64) 30%, #000517 80%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 13, 64) 30%, #000517 80%);     background-image: -ms-linear-gradient(bottom, rgb(0, 13, 64) 30%, #000517 80%);     background-image: linear-gradient(to bottom, rgb(0, 13, 64) 30%, #000517 80%); }
    #headline-95824 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 13, 64)), color-stop(0, #000517));     background-image: -o-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 30%);     background-image: -moz-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 30%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 30%);     background-image: -ms-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 30%);     background-image: linear-gradient(to bottom, rgb(0, 13, 64) 100%, #000517 30%); }
    #headline-95824 .elButtonBorder{                        border: 3px solid rgb(0, 13, 64) !important;                         color: rgb(0, 13, 64) !important;                     }
    #headline-95824 .elButtonBorder:hover{                          background-color:rgb(0, 13, 64) !important;                          color: #FFF !important;                       }
</style>
<style id="button_style_headline-96305">#headline-96305 .elButtonFlat:hover{ background-color: #000517 !important;}
    #headline-96305 .elButtonBottomBorder:hover{ background-color: #000517 !important;}
    #headline-96305 .elButtonSubtle:hover{ background-color: #000517 !important;}
    #headline-96305 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 13, 64)), color-stop(1, #000517));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 13, 64) 0%, #000517 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 13, 64) 0%, #000517 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 13, 64) 0%, #000517 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 13, 64) 0%, #000517 100%);                                                 background-image: linear-gradient(to bottom, rgb(0, 13, 64) 0%, #000517 100%);                                             }
    #headline-96305 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 13, 64)), color-stop(0, #000517));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 0%);                                                 background-image: linear-gradient(to bottom, rgb(0, 13, 64) 100%, #000517 0%);                                             }
    #headline-96305 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 13, 64)), color-stop(1, #000517));     background-image: -o-linear-gradient(bottom, rgb(0, 13, 64) 30%, #000517 80%);     background-image: -moz-linear-gradient(bottom, rgb(0, 13, 64) 30%, #000517 80%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 13, 64) 30%, #000517 80%);     background-image: -ms-linear-gradient(bottom, rgb(0, 13, 64) 30%, #000517 80%);     background-image: linear-gradient(to bottom, rgb(0, 13, 64) 30%, #000517 80%); }
    #headline-96305 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 13, 64)), color-stop(0, #000517));     background-image: -o-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 30%);     background-image: -moz-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 30%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 30%);     background-image: -ms-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 30%);     background-image: linear-gradient(to bottom, rgb(0, 13, 64) 100%, #000517 30%); }
    #headline-96305 .elButtonBorder{                        border: 3px solid rgb(0, 13, 64) !important;                         color: rgb(0, 13, 64) !important;                     }
    #headline-96305 .elButtonBorder:hover{                          background-color:rgb(0, 13, 64) !important;                          color: #FFF !important;                       }
</style>
<style id="button_style_headline-75066">#headline-75066 .elButtonFlat:hover{ background-color: #000517 !important;}
    #headline-75066 .elButtonBottomBorder:hover{ background-color: #000517 !important;}
    #headline-75066 .elButtonSubtle:hover{ background-color: #000517 !important;}
    #headline-75066 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 13, 64)), color-stop(1, #000517));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 13, 64) 0%, #000517 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 13, 64) 0%, #000517 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 13, 64) 0%, #000517 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 13, 64) 0%, #000517 100%);                                                 background-image: linear-gradient(to bottom, rgb(0, 13, 64) 0%, #000517 100%);                                             }
    #headline-75066 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 13, 64)), color-stop(0, #000517));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 0%);                                                 background-image: linear-gradient(to bottom, rgb(0, 13, 64) 100%, #000517 0%);                                             }
    #headline-75066 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 13, 64)), color-stop(1, #000517));     background-image: -o-linear-gradient(bottom, rgb(0, 13, 64) 30%, #000517 80%);     background-image: -moz-linear-gradient(bottom, rgb(0, 13, 64) 30%, #000517 80%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 13, 64) 30%, #000517 80%);     background-image: -ms-linear-gradient(bottom, rgb(0, 13, 64) 30%, #000517 80%);     background-image: linear-gradient(to bottom, rgb(0, 13, 64) 30%, #000517 80%); }
    #headline-75066 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 13, 64)), color-stop(0, #000517));     background-image: -o-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 30%);     background-image: -moz-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 30%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 30%);     background-image: -ms-linear-gradient(bottom, rgb(0, 13, 64) 100%, #000517 30%);     background-image: linear-gradient(to bottom, rgb(0, 13, 64) 100%, #000517 30%); }
    #headline-75066 .elButtonBorder{                        border: 3px solid rgb(0, 13, 64) !important;                         color: rgb(0, 13, 64) !important;                     }
    #headline-75066 .elButtonBorder:hover{                          background-color:rgb(0, 13, 64) !important;                          color: #FFF !important;                       }
</style>
<style id="bold_style_tmp_headline1-52345">#tmp_headline1-52345 .elHeadline b{ color: rgb(0, 0, 0);}</style>
<style id="button_style_tmp_button-26609-174">#tmp_button-26609-174 .elButtonFlat:hover{ background-color: #f24802 !important;}
    #tmp_button-26609-174 .elButtonBottomBorder:hover{ background-color: #f24802 !important;}
    #tmp_button-26609-174 .elButtonSubtle:hover{ background-color: #f24802 !important;}
    #tmp_button-26609-174 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(253, 96, 32)), color-stop(1, #f24802));                                                 background-image: -o-linear-gradient(bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                                 background-image: linear-gradient(to bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                             }
    #tmp_button-26609-174 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(253, 96, 32)), color-stop(0, #f24802));                                                 background-image: -o-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                                 background-image: linear-gradient(to bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                             }
    #tmp_button-26609-174 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(253, 96, 32)), color-stop(1, #f24802));     background-image: -o-linear-gradient(bottom, rgb(253, 96, 32) 30%, #f24802 80%);     background-image: -moz-linear-gradient(bottom, rgb(253, 96, 32) 30%, #f24802 80%);     background-image: -webkit-linear-gradient(bottom, rgb(253, 96, 32) 30%, #f24802 80%);     background-image: -ms-linear-gradient(bottom, rgb(253, 96, 32) 30%, #f24802 80%);     background-image: linear-gradient(to bottom, rgb(253, 96, 32) 30%, #f24802 80%); }
    #tmp_button-26609-174 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(253, 96, 32)), color-stop(0, #f24802));     background-image: -o-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 30%);     background-image: -moz-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 30%);     background-image: -webkit-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 30%);     background-image: -ms-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 30%);     background-image: linear-gradient(to bottom, rgb(253, 96, 32) 100%, #f24802 30%); }
    #tmp_button-26609-174 .elButtonBorder{                        border: 3px solid rgb(253, 96, 32) !important;                         color: rgb(253, 96, 32) !important;                     }
    #tmp_button-26609-174 .elButtonBorder:hover{                          background-color:rgb(253, 96, 32) !important;                          color: #FFF !important;                       }
</style>
<style id="button_style_tmp_button-26609-174-181">#tmp_button-26609-174-181 .elButtonFlat:hover{ background-color: #f24802 !important;}
    #tmp_button-26609-174-181 .elButtonBottomBorder:hover{ background-color: #f24802 !important;}
    #tmp_button-26609-174-181 .elButtonSubtle:hover{ background-color: #f24802 !important;}
    #tmp_button-26609-174-181 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(253, 96, 32)), color-stop(1, #f24802));                                                 background-image: -o-linear-gradient(bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                                 background-image: linear-gradient(to bottom, rgb(253, 96, 32) 0%, #f24802 100%);                                             }
    #tmp_button-26609-174-181 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(253, 96, 32)), color-stop(0, #f24802));                                                 background-image: -o-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                                 background-image: linear-gradient(to bottom, rgb(253, 96, 32) 100%, #f24802 0%);                                             }
    #tmp_button-26609-174-181 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(253, 96, 32)), color-stop(1, #f24802));     background-image: -o-linear-gradient(bottom, rgb(253, 96, 32) 30%, #f24802 80%);     background-image: -moz-linear-gradient(bottom, rgb(253, 96, 32) 30%, #f24802 80%);     background-image: -webkit-linear-gradient(bottom, rgb(253, 96, 32) 30%, #f24802 80%);     background-image: -ms-linear-gradient(bottom, rgb(253, 96, 32) 30%, #f24802 80%);     background-image: linear-gradient(to bottom, rgb(253, 96, 32) 30%, #f24802 80%); }
    #tmp_button-26609-174-181 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(253, 96, 32)), color-stop(0, #f24802));     background-image: -o-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 30%);     background-image: -moz-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 30%);     background-image: -webkit-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 30%);     background-image: -ms-linear-gradient(bottom, rgb(253, 96, 32) 100%, #f24802 30%);     background-image: linear-gradient(to bottom, rgb(253, 96, 32) 100%, #f24802 30%); }
    #tmp_button-26609-174-181 .elButtonBorder{                        border: 3px solid rgb(253, 96, 32) !important;                         color: rgb(253, 96, 32) !important;                     }
    #tmp_button-26609-174-181 .elButtonBorder:hover{                          background-color:rgb(253, 96, 32) !important;                          color: #FFF !important;                       }
</style>
<style id="bold_style_headline-49722">#headline-49722 .elHeadline b{ color: rgb(0, 0, 0);}</style>
<style id="button_style_headline-87212">#headline-87212 .elButtonFlat:hover{ background-color: #005a89 !important;}
    #headline-87212 .elButtonBottomBorder:hover{ background-color: #005a89 !important;}
    #headline-87212 .elButtonSubtle:hover{ background-color: #005a89 !important;}
    #headline-87212 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                             }
    #headline-87212 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                             }
    #headline-87212 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 30%, #005a89 80%); }
    #headline-87212 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 30%); }
    #headline-87212 .elButtonBorder{                        border: 3px solid rgb(0, 117, 178) !important;                         color: rgb(0, 117, 178) !important;                     }
    #headline-87212 .elButtonBorder:hover{                          background-color:rgb(0, 117, 178) !important;                          color: #FFF !important;                       }
</style>
<style id="button_style_tmp_headline1-93000">#tmp_headline1-93000 .elButtonFlat:hover{ background-color: #dde7e7 !important;}
    #tmp_headline1-93000 .elButtonBottomBorder:hover{ background-color: #dde7e7 !important;}
    #tmp_headline1-93000 .elButtonSubtle:hover{ background-color: #dde7e7 !important;}
    #tmp_headline1-93000 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(245, 248, 248)), color-stop(1, #dde7e7));                                                 background-image: -o-linear-gradient(bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                                 background-image: linear-gradient(to bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                             }
    #tmp_headline1-93000 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(245, 248, 248)), color-stop(0, #dde7e7));                                                 background-image: -o-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                                 background-image: linear-gradient(to bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                             }
    #tmp_headline1-93000 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(245, 248, 248)), color-stop(1, #dde7e7));     background-image: -o-linear-gradient(bottom, rgb(245, 248, 248) 30%, #dde7e7 80%);     background-image: -moz-linear-gradient(bottom, rgb(245, 248, 248) 30%, #dde7e7 80%);     background-image: -webkit-linear-gradient(bottom, rgb(245, 248, 248) 30%, #dde7e7 80%);     background-image: -ms-linear-gradient(bottom, rgb(245, 248, 248) 30%, #dde7e7 80%);     background-image: linear-gradient(to bottom, rgb(245, 248, 248) 30%, #dde7e7 80%); }
    #tmp_headline1-93000 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(245, 248, 248)), color-stop(0, #dde7e7));     background-image: -o-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 30%);     background-image: -moz-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 30%);     background-image: -webkit-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 30%);     background-image: -ms-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 30%);     background-image: linear-gradient(to bottom, rgb(245, 248, 248) 100%, #dde7e7 30%); }
    #tmp_headline1-93000 .elButtonBorder{                        border: 3px solid rgb(245, 248, 248) !important;                         color: rgb(245, 248, 248) !important;                     }
    #tmp_headline1-93000 .elButtonBorder:hover{                          background-color:rgb(245, 248, 248) !important;                          color: #FFF !important;                       }
</style>
<style id="button_style_tmp_button-80641">#tmp_button-80641 .elButtonFlat:hover{ background-color: #005a89 !important;}
    #tmp_button-80641 .elButtonBottomBorder:hover{ background-color: #005a89 !important;}
    #tmp_button-80641 .elButtonSubtle:hover{ background-color: #005a89 !important;}
    #tmp_button-80641 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                             }
    #tmp_button-80641 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                             }
    #tmp_button-80641 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 30%, #005a89 80%); }
    #tmp_button-80641 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 30%); }
    #tmp_button-80641 .elButtonBorder{                        border: 3px solid rgb(0, 117, 178) !important;                         color: rgb(0, 117, 178) !important;                     }
    #tmp_button-80641 .elButtonBorder:hover{                          background-color:rgb(0, 117, 178) !important;                          color: #FFF !important;                       }
</style>
<style id="button_style_tmp_button-80641-139">#tmp_button-80641-139 .elButtonFlat:hover{ background-color: #005a89 !important;}
    #tmp_button-80641-139 .elButtonBottomBorder:hover{ background-color: #005a89 !important;}
    #tmp_button-80641-139 .elButtonSubtle:hover{ background-color: #005a89 !important;}
    #tmp_button-80641-139 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                             }
    #tmp_button-80641-139 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                             }
    #tmp_button-80641-139 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 30%, #005a89 80%); }
    #tmp_button-80641-139 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 30%); }
    #tmp_button-80641-139 .elButtonBorder{                        border: 3px solid rgb(0, 117, 178) !important;                         color: rgb(0, 117, 178) !important;                     }
    #tmp_button-80641-139 .elButtonBorder:hover{                          background-color:rgb(0, 117, 178) !important;                          color: #FFF !important;                       }
</style>
<style id="button_style_tmp_button-80641-139-148">#tmp_button-80641-139-148 .elButtonFlat:hover{ background-color: #005a89 !important;}
    #tmp_button-80641-139-148 .elButtonBottomBorder:hover{ background-color: #005a89 !important;}
    #tmp_button-80641-139-148 .elButtonSubtle:hover{ background-color: #005a89 !important;}
    #tmp_button-80641-139-148 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                             }
    #tmp_button-80641-139-148 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                             }
    #tmp_button-80641-139-148 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 30%, #005a89 80%); }
    #tmp_button-80641-139-148 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 30%); }
    #tmp_button-80641-139-148 .elButtonBorder{                        border: 3px solid rgb(0, 117, 178) !important;                         color: rgb(0, 117, 178) !important;                     }
    #tmp_button-80641-139-148 .elButtonBorder:hover{                          background-color:rgb(0, 117, 178) !important;                          color: #FFF !important;                       }
</style>
<style id="bold_style_headline-70610">#headline-70610 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-49557">#headline-49557 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-63708-157-140">#headline-63708-157-140 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="bold_style_headline-49557-180">#headline-49557-180 .elHeadline b{ color: rgb(45, 45, 45);}</style>
<style id="button_style_tmp_button-80641-139-148-174">#tmp_button-80641-139-148-174 .elButtonFlat:hover{ background-color: #005a89 !important;}
    #tmp_button-80641-139-148-174 .elButtonBottomBorder:hover{ background-color: #005a89 !important;}
    #tmp_button-80641-139-148-174 .elButtonSubtle:hover{ background-color: #005a89 !important;}
    #tmp_button-80641-139-148-174 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                             }
    #tmp_button-80641-139-148-174 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                             }
    #tmp_button-80641-139-148-174 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 30%, #005a89 80%); }
    #tmp_button-80641-139-148-174 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 30%); }
    #tmp_button-80641-139-148-174 .elButtonBorder{                        border: 3px solid rgb(0, 117, 178) !important;                         color: rgb(0, 117, 178) !important;                     }
    #tmp_button-80641-139-148-174 .elButtonBorder:hover{                          background-color:rgb(0, 117, 178) !important;                          color: #FFF !important;                       }
</style>
<style id="bold_style_tmp_headline1-29730-176">#tmp_headline1-29730-176 .elHeadline b{ color: rgb(0, 0, 0);}</style>
<style id="bold_style_tmp_headline1-21959-179">#tmp_headline1-21959-179 .elHeadline b{color:rgb(255,0,0);}</style>
<style id="button_style_tmp_button-51552">#tmp_button-51552 .elButtonFlat:hover{ background-color: #005a89 !important;}
    #tmp_button-51552 .elButtonBottomBorder:hover{ background-color: #005a89 !important;}
    #tmp_button-51552 .elButtonSubtle:hover{ background-color: #005a89 !important;}
    #tmp_button-51552 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                             }
    #tmp_button-51552 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                             }
    #tmp_button-51552 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 30%, #005a89 80%); }
    #tmp_button-51552 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 30%); }
    #tmp_button-51552 .elButtonBorder{                        border: 3px solid rgb(0, 117, 178) !important;                         color: rgb(0, 117, 178) !important;                     }
    #tmp_button-51552 .elButtonBorder:hover{                          background-color:rgb(0, 117, 178) !important;                          color: #FFF !important;                       }
</style>
<style id="button_style_button-69580">#button-69580 .elButtonFlat:hover{ background-color: #005a89 !important;}
    #button-69580 .elButtonBottomBorder:hover{ background-color: #005a89 !important;}
    #button-69580 .elButtonSubtle:hover{ background-color: #005a89 !important;}
    #button-69580 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                             }
    #button-69580 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                             }
    #button-69580 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 30%, #005a89 80%); }
    #button-69580 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 30%); }
    #button-69580 .elButtonBorder{                        border: 3px solid rgb(0, 117, 178) !important;                         color: rgb(0, 117, 178) !important;                     }
    #button-69580 .elButtonBorder:hover{                          background-color:rgb(0, 117, 178) !important;                          color: #FFF !important;                       }
</style>
<style id="button_style_button-66970">#button-66970 .elButtonFlat:hover{ background-color: #005a89 !important;}
    #button-66970 .elButtonBottomBorder:hover{ background-color: #005a89 !important;}
    #button-66970 .elButtonSubtle:hover{ background-color: #005a89 !important;}
    #button-66970 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                             }
    #button-66970 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                             }
    #button-66970 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 30%, #005a89 80%); }
    #button-66970 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 30%); }
    #button-66970 .elButtonBorder{                        border: 3px solid rgb(0, 117, 178) !important;                         color: rgb(0, 117, 178) !important;                     }
    #button-66970 .elButtonBorder:hover{                          background-color:rgb(0, 117, 178) !important;                          color: #FFF !important;                       }
</style>
<style id="button_style_headline-41817-172">#headline-41817-172 .elButtonFlat:hover{ background-color: #dde7e7 !important;}
    #headline-41817-172 .elButtonBottomBorder:hover{ background-color: #dde7e7 !important;}
    #headline-41817-172 .elButtonSubtle:hover{ background-color: #dde7e7 !important;}
    #headline-41817-172 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(245, 248, 248)), color-stop(1, #dde7e7));                                                 background-image: -o-linear-gradient(bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                                 background-image: linear-gradient(to bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                             }
    #headline-41817-172 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(245, 248, 248)), color-stop(0, #dde7e7));                                                 background-image: -o-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                                 background-image: linear-gradient(to bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                             }
    #headline-41817-172 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(245, 248, 248)), color-stop(1, #dde7e7));     background-image: -o-linear-gradient(bottom, rgb(245, 248, 248) 30%, #dde7e7 80%);     background-image: -moz-linear-gradient(bottom, rgb(245, 248, 248) 30%, #dde7e7 80%);     background-image: -webkit-linear-gradient(bottom, rgb(245, 248, 248) 30%, #dde7e7 80%);     background-image: -ms-linear-gradient(bottom, rgb(245, 248, 248) 30%, #dde7e7 80%);     background-image: linear-gradient(to bottom, rgb(245, 248, 248) 30%, #dde7e7 80%); }
    #headline-41817-172 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(245, 248, 248)), color-stop(0, #dde7e7));     background-image: -o-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 30%);     background-image: -moz-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 30%);     background-image: -webkit-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 30%);     background-image: -ms-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 30%);     background-image: linear-gradient(to bottom, rgb(245, 248, 248) 100%, #dde7e7 30%); }
    #headline-41817-172 .elButtonBorder{                        border: 3px solid rgb(245, 248, 248) !important;                         color: rgb(245, 248, 248) !important;                     }
    #headline-41817-172 .elButtonBorder:hover{                          background-color:rgb(245, 248, 248) !important;                          color: #FFF !important;                       }
</style>
<style id="button_style_tmp_button-80663">#tmp_button-80663 .elButtonFlat:hover{ background-color: #005a89 !important;}
    #tmp_button-80663 .elButtonBottomBorder:hover{ background-color: #005a89 !important;}
    #tmp_button-80663 .elButtonSubtle:hover{ background-color: #005a89 !important;}
    #tmp_button-80663 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 0%, #005a89 100%);                                             }
    #tmp_button-80663 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));                                                 background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                                 background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 0%);                                             }
    #tmp_button-80663 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(0, 117, 178)), color-stop(1, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 30%, #005a89 80%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 30%, #005a89 80%); }
    #tmp_button-80663 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(0, 117, 178)), color-stop(0, #005a89));     background-image: -o-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -moz-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -webkit-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: -ms-linear-gradient(bottom, rgb(0, 117, 178) 100%, #005a89 30%);     background-image: linear-gradient(to bottom, rgb(0, 117, 178) 100%, #005a89 30%); }
    #tmp_button-80663 .elButtonBorder{                        border: 3px solid rgb(0, 117, 178) !important;                         color: rgb(0, 117, 178) !important;                     }
    #tmp_button-80663 .elButtonBorder:hover{                          background-color:rgb(0, 117, 178) !important;                          color: #FFF !important;                       }
</style>
<style id="button_style_headline-57865-116">#headline-57865-116 .elButtonFlat:hover{ background-color: #dde7e7 !important;}
    #headline-57865-116 .elButtonBottomBorder:hover{ background-color: #dde7e7 !important;}
    #headline-57865-116 .elButtonSubtle:hover{ background-color: #dde7e7 !important;}
    #headline-57865-116 .elButtonGradient{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(245, 248, 248)), color-stop(1, #dde7e7));                                                 background-image: -o-linear-gradient(bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                                 background-image: -moz-linear-gradient(bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                                 background-image: -ms-linear-gradient(bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                                 background-image: linear-gradient(to bottom, rgb(245, 248, 248) 0%, #dde7e7 100%);                                             }
    #headline-57865-116 .elButtonGradient:hover{                                                background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(245, 248, 248)), color-stop(0, #dde7e7));                                                 background-image: -o-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                                 background-image: -moz-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                                 background-image: -webkit-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                                 background-image: -ms-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                                 background-image: linear-gradient(to bottom, rgb(245, 248, 248) 100%, #dde7e7 0%);                                             }
    #headline-57865-116 .elButtonGradient2{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(245, 248, 248)), color-stop(1, #dde7e7));     background-image: -o-linear-gradient(bottom, rgb(245, 248, 248) 30%, #dde7e7 80%);     background-image: -moz-linear-gradient(bottom, rgb(245, 248, 248) 30%, #dde7e7 80%);     background-image: -webkit-linear-gradient(bottom, rgb(245, 248, 248) 30%, #dde7e7 80%);     background-image: -ms-linear-gradient(bottom, rgb(245, 248, 248) 30%, #dde7e7 80%);     background-image: linear-gradient(to bottom, rgb(245, 248, 248) 30%, #dde7e7 80%); }
    #headline-57865-116 .elButtonGradient2:hover{    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(245, 248, 248)), color-stop(0, #dde7e7));     background-image: -o-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 30%);     background-image: -moz-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 30%);     background-image: -webkit-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 30%);     background-image: -ms-linear-gradient(bottom, rgb(245, 248, 248) 100%, #dde7e7 30%);     background-image: linear-gradient(to bottom, rgb(245, 248, 248) 100%, #dde7e7 30%); }
    #headline-57865-116 .elButtonBorder{                        border: 3px solid rgb(245, 248, 248) !important;                         color: rgb(245, 248, 248) !important;                     }
    #headline-57865-116 .elButtonBorder:hover{                          background-color:rgb(245, 248, 248) !important;                          color: #FFF !important;                       }
</style>
<style id="button_style_tmp_headline1-21959-179">#tmp_headline1-21959-179 .elButtonFlat:hover{ background-color: #e6e6e6 !important;}
    #tmp_headline1-21959-179 .elButtonBottomBorder:hover{ background-color: #e6e6e6 !important;}
    #tmp_headline1-21959-179 .elButtonSubtle:hover{ background-color: #e6e6e6 !important;}
    #tmp_headline1-21959-179 .elButtonGradient{                    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgb(255, 255, 255)), color-stop(1, #e6e6e6));                     background-image: -o-linear-gradient(bottom, rgb(255, 255, 255) 0%, #e6e6e6 100%);                     background-image: -moz-linear-gradient(bottom, rgb(255, 255, 255) 0%, #e6e6e6 100%);                     background-image: -webkit-linear-gradient(bottom, rgb(255, 255, 255) 0%, #e6e6e6 100%);                     background-image: -ms-linear-gradient(bottom, rgb(255, 255, 255) 0%, #e6e6e6 100%);                     background-image: linear-gradient(to bottom, rgb(255, 255, 255) 0%, #e6e6e6 100%);                 }
    #tmp_headline1-21959-179 .elButtonGradient:hover{                    background-image: -webkit-gradient( linear, left top, left bottom, color-stop(1, rgb(255, 255, 255)), color-stop(0, #e6e6e6));                     background-image: -o-linear-gradient(bottom, rgb(255, 255, 255) 100%, #e6e6e6 0%);                     background-image: -moz-linear-gradient(bottom, rgb(255, 255, 255) 100%, #e6e6e6 0%);                     background-image: -webkit-linear-gradient(bottom, rgb(255, 255, 255) 100%, #e6e6e6 0%);                     background-image: -ms-linear-gradient(bottom, rgb(255, 255, 255) 100%, #e6e6e6 0%);                     background-image: linear-gradient(to bottom, rgb(255, 255, 255) 100%, #e6e6e6 0%);                 }
    #tmp_headline1-21959-179 .elButtonBorder{                    border: 3px solid rgb(255, 255, 255) !important;                     color: rgb(255, 255, 255) !important;                 }
    #tmp_headline1-21959-179 .elButtonBorder:hover{                      background-color:rgb(255, 255, 255) !important;                      color: #000 !important;                   }
</style>
</div>
<style id="custom-css"></style>
<input type="hidden" value="24274687" id="page-id">
<input type="hidden" value="24274687" id="root-id">
<input type="hidden" value="core" id="variant-check">
<input type="hidden" value="822439" id="user-id">
<input type="hidden" value="" id="cf-cid">
<script>
    function CFFacebookMessengerCheckbox() {}
    CFFacebookMessengerCheckbox.endpoint = "https://app.clickfunnels.com/facebook_user_ref";
</script>
<script type="text/javascript">
    window.CFAppDomain = "#{Rails.application.config.app_domain}"
</script>
<!--<script src="//www.mysocialsecret.com/assets/lander.js"></script>-->
<div id="fb-root"></div>
<script>
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script>
    window.cfFacebookInitOptions = {
        appId            : 246441615530259,
        autoLogAppEvents : false,
        status           : true,
        xfbml            : true,
        version          : "v3.0"
    };
    window.fbAsyncInit = function() {
        FB.init(window.cfFacebookInitOptions);

        FB.Event.subscribe('messenger_checkbox', function(e) {
            var a = document.createElement('a');
            a.href = window.location.href;
            if(/[&\?]debug/.test(a.search)) {
                console.log("messenger_checkbox event", e);
            }
        });

        var initializeClickFunnelsFBMessengerCheckbox = function(){
            if(typeof(CFFacebookMessengerCheckbox) === "undefined") {
                setTimeout(initializeClickFunnelsFBMessengerCheckbox, 100);
                return;
            }
            CFFacebookMessengerCheckbox.fbLoaded(FB);
        };

        initializeClickFunnelsFBMessengerCheckbox();

        // Iterates over all .fb-comments elements on the page, and renders them using the FB SDK.
        // It only runs if we have not told the FB.init() to render XFBML on page load
        var renderFacebookComments = function(renderXFBMLAtLoadTime) {
            // If we have already marked XFBML to render at page load time, do not proceed.
            if(renderXFBMLAtLoadTime) { return; }

            var comments = document.getElementsByClassName('fb-comments');
            var i = 0;
            var len = comments.length;
            var comment = null;
            for(; i < len; i++) {
                comment = comments[i];
                FB.XFBML.parse(comment.parentElement); // comments need to be rendered/parsed from their parent element.
            }
        }

        renderFacebookComments(true);
    };
</script>
</div>

<script>
    let referrals = <?=json_encode($userWise)?>;
    let dateRangePicker = <?=json_encode($dateRangePicker)?>;
</script>