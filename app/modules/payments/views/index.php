
<div class="pricing-table">
<!--	--><?php //if(!check_expiration()  && IS_ADMIN != 1){?>
<!--	<div class="container">-->
<!--		<div class="box-notice-2">-->
<!--			<i class="fa fa-exclamation-circle" aria-hidden="true"></i> --><?//=l('Out of date! Please select a package below to continue using')?>
<!--		</div>-->
<!--	</div>-->
<!--	--><?php //}?>
	<div class="title"><?=l('Prices')?></div>
<!--    <a href="--><?//= PATH;?><!--" class="col-dark-blue" style="margin: 0 auto;display: table;padding-bottom: 20px;">Back to Dashboard</a>-->
    <p style="color:#111111 !important;font-size: 18px;margin: 0 auto;display: table;padding-bottom: 20px;font-weight: normal;">No contracts, downgrade or cancel your account anytime with a single click from your dashboard.</p>
	<?php if(!empty($package)){?>

	<?php foreach ($package as $row) {
		$price = explode(".", $row->price);
		$permission = json_decode($row->permission);
	?>
	<div class="whole">
<!--		<div class="type --><?php //echo =($row->default_package == 1)?"bg-recommend":""?><!--">-->
		<div class="type">
			<?php if($row->default_package == 1){?>
<!--			<div class="recommend"></div>-->
                <div class="popular"><img src="<?=BASE?>assets/images/most-popular.svg"></div>
			<?php }?>
			<p><?=$row->name?></p>
			</div>
		<div class="plan">
			<div class="header" style="font-size: 65px !important;">
				<span><?=$payment->symbol?></span><?=$price[0]?><sup><?php //=(isset($price[1])?$price[1]:"00")?></sup>
				<!--<p class="month">/<?php //=$row->day?> <?php//=l('days')?></p>-->
				<p class="month"><?=l('per month')?></p>
			</div>
			<div class="content">
				<ul>
<!--					<li class="bg-light-green">--><?php //echo =$permission->maximum_account?><!-- --><?//=l('Instagram Accounts')?><!--</li>-->
					<li><?=$permission->maximum_account?> <?=l('Instagram Accounts')?></li>
<!--					<li>--><?//=l('Auto post')?><!-- --><?php //echo =permission_list($row->permission, 'post')?><!--</li>-->
<!--					<li>--><?//=l('Auto message')?><!-- --><?php //echo =permission_list($row->permission, 'message')?><!--</li>-->
<!--					<li>--><?//=l('Auto activity')?><!-- --><?php //echo =permission_list($row->permission, 'activity')?><!--</li>-->
<!--					<li>--><?//=l('Auto search')?><!-- --><?php //echo =permission_list($row->permission, 'search')?><!--</li>-->
<!--					<li>--><?//=l('Auto download')?><!-- --><?php //echo =permission_list($row->permission, 'download')?><!--</li>-->

                    <li><?=l('Auto Like')?></li>
                    <li><?=l('Auto Follow')?></li>
                    <li><?=l('Auto Unfollow')?></li>
                    <li><?=l('Auto Comment')?></li>
                    <li><?=l('Auto DM')?></li>
                    <li><?=l('Schedule Stories/Posts')?></li>
                    <li><?=l('Analytics')?></li>
                    <li><?=l('24/7 Support')?></li>
                    <li><?=l('Cancel Anytime')?></li>

				</ul>
			</div>
			<div class="price">
				<?php if(session("uid")){?>
	      			<a href="<?=cn("type?package=".$row->id)?>" style="background-color: #1471b9 !important;box-shadow: #808080 5px 6px 15px !important;font-size: 26px !important;font-weight: 500 !important;line-height: 100% !important;border-radius: 5px !important;padding: 14px !important;" class="btn btn-block bg-light-green btn-lg waves-effect"><?=l('Buy Plan')?></a>
				<?php }else{?>
					<a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal" style="background-color: #0070bc !important;box-shadow: #808080 5px 6px 15px !important;font-size: 26px !important;font-weight: 500 !important;line-height: 100% !important;border-radius: 5px !important;padding: 14px !important;" class="btn btn-block bg-light-green btn-lg waves-effect"><?=l('Buy Plan')?></a>
	      		<?php }?>
			</div>
		</div>


	</div>
	<?php }?>

	<?php }?>
</div>
<p align="center" style="margin: 30px 0px 75px;font-size: 16px;">Looking for an agency plan? <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-new-contact" style="font-weight: bold; text-decoration: underline;">Contact us</a> and we can find a solution that’s right for you.</p>


<div class="modal fade" id="modal-new-contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="defaultModalLabel"><?=l('Send Request')?></h4>
            </div>
            <form class="PackNew" action="javascript:void(0);" data-action="<?=url("payments/send_mail")?>">
            <div class="modal-body pt0">
                <div class="tab-content" style="display: block;">
                    <div role="tabpanel" class="tab-pane fade active in" id="profile">
                        <?=l('Email:');?>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="email" name="email" required class="form-control">
                            </div>
                        </div>
                        <?=l('Username:');?>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="username" class="form-control" placeholder="<?=l('Your Instgram username (optional)')?>">
                            </div>
                        </div>
                        <?=l('Subject:');?>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="subject" class="form-control">
                                    <option value="-">-</option>
                                    <option value="Question">Question</option>
                                    <option value="Error">Error</option>
                                    <option value="Refund">Refund</option>
                                    <option value="Idea">Idea</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <?=l('Message:');?>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea name="message" class="form-control" placeholder="Your message"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn new-blue waves-effect PackMail" style="text-transform: none !important;width: 100px;"><?=l('Send')?></button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php //=modules::run("blocks/footer")?>


