<div class="pricing-table">
	<div class="title uc"><?=l('Complete Order')?></div>
<!--    <a href="--><?//= PATH;?><!--" class="" style="margin: 0 auto;display: table;padding-bottom: 20px;color: black;font-weight: normal;">No contracts, downgrade or cancel your account anytime with a single click from your dashboard.</a>-->
    <p style="margin: 0 auto;font-size: 18px;display: table;padding-bottom: 20px;color: black;font-weight: normal;">No contracts, downgrade or cancel your account anytime with a single click from your dashboard.</p>
	<?php if(!empty($package)){
		$discount = 0;
		$tolal = 0;
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="invoice_table">
					<table class="table">
						<thead>
							<tr>
								<th><?=l("Package Name")?></th>
								<th class="text-center" style="width: 30%;"><?=l("Price")?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="uc text-left"><?=$package->name?></td>
								<td class="text-center"><?=$payment->symbol?><?=number_format($package->price,2)?> <?=$payment->currency?></td>
							</tr>
							<tr class="active">
								<td class="text-right"><?=l("Subtotal:")?></td>
								<td class="text-center"><?=$payment->symbol?><?=number_format($package->price,2)?> <?=$payment->currency?></td>
							</tr>
							<?php if(!empty($coupon)){?>
							<tr class="invoice_warning">
								<td class="text-right"><?=l("Discount:")?></td>
								<td class="text-center">
								<?php 
								if($coupon->type==1){
									$discount = (float)$coupon->price;
								}else{
									$discount = ((float)$coupon->price/100)*(float)$package->price;
								}
								$discount = ($discount < 0)?0:$discount;
								$tolal =number_format($package->price-$discount,2)*100;
								echo $payment->symbol.number_format($discount,2);
								?>
								<?=$payment->currency?></td>
							</tr>
							<?php }?>
<!--							<tr class="invoice_success col-green">-->
							<tr class="invoice_success">
								<td class="text-right"><?=l("Total:")?></td>
								<td class="text-center"><?=$payment->symbol?><?=number_format($package->price-$discount,2)?> <?=$payment->currency?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
<!--			<div class="col-md-4">-->
<!--				<form action="--><?//=cn('ajax_coupon')?><!--" data-redirect="--><?php //=cn("type?package=").(int)get("package")?><!--">-->
<!--					<div class="invoice_coupon">-->
<!--						<div class="invoice_title">--><?php //=l("Promotional Code")?><!--</div>-->
<!--						<div class="invoice_content">-->
<!--							<div class="form-group">-->
<!--					     		<input type="hidden" class="form-control" name="package_id" value="--><?php //=get("package")?><!--">-->
<!--					     		<input type="text" class="form-control" name="coupon" value="--><?php //=(!empty($coupon))?$coupon->code:""?><!--">-->
<!--					     	</div>-->
<!--					     	<button type="button" class="btn btn-white btn-lg btnActionUpdate">--><?php //=l("Validate Code")?><!--</button>-->
<!--						</div>-->
<!--					</div>-->
<!--				</form>-->
<!--			</div>-->
		</div>
	</div>
	<?php }?>

	<div class="container">
		<div class="row">

            <?php if($payment->paypal_email !=""){?>
			<div class="col-md-6">
				<div class="whole" style="width: 100%; margin: 0 0 15px; border: none !important;">
					<div class="plan" style="width: 100%;">

                        <?php if(session("uid")){?>

                            <?php if($payment->sandbox == 1){ ?>
                            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <?php }else{ ?>
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <?php } ?>
                                <input type='hidden' name='business' value='<?=$payment->paypal_email?>'>

<!--                                <input type="hidden" name="a1"  value="10" />-->
<!--                                <input type="hidden" name="t1" value="D" >-->
<!--                                <input type="hidden" name="p1" value="10" >-->
<!---->
<!--                                <input type="hidden" name="a2" value="5.00">-->
<!--                                <input type="hidden" name="p2" value="3">-->
<!--                                <input type="hidden" name="t2" value="W">-->

                                <!-- Set the terms of the regular subscription. -->
                                <input type="hidden" name="a3" value="<?=number_format($package->price-$discount,2)?>">
                                <input type="hidden" name="p3" value="1">
                                <input type="hidden" name="t3" value="M">

                                <input type="hidden" name="src" value="1" >
                                <input type="hidden" name="no_note" value="1" />
                                <input type="hidden" name="lc" value="US" />
                                <input type="hidden" name="custom" value="<?=session('uid')?>"/>
                                <input type="hidden" name="invoice" value="<?=random_string('numeric',8);?>"/>
                                <input type='hidden' name='item_name' value='<?=$package->name?>'>
                                <input type='hidden' name='item_number' value='<?=$package->id?>'>
                                <input type='hidden' name='currency_code' value='<?=$payment->currency?>'>
                                <input type='hidden' name='notify_url' value='<?=BASE?>paypal/ipn.php'>
<!--                                <input type='hidden' name='notify_url' value='--><?//=PATH?><!--payments/process_payment'>-->
                                <input type='hidden' name='cancel_return' value='<?=PATH?>payments/cancel_payment'>
                                <input type='hidden' name='return' value='<?=PATH?>payments/process_payment'>
                                <!-- COPY and PASTE Your Button Code -->
                                <!--<input type="hidden" name="cmd" value="_xclick">-->
                                <input type="hidden" name="cmd" value="_xclick-subscriptions">
                                <input type="hidden" name="hosted_button_id" value="### COPY FROM BUTTON CODE ###">
<!--                                <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">-->

                                <input type="image" class="btnPaypalPayment" src="<?= BASE."assets/new_res/images/payment_btn.png" ?>"  border="0" name="pay" alt="PayPal - The safer, easier way to pay online!">
                                <!-------------------------hide recurring payment and show "Complete Order"-------------------------------->
<!--                                <input type="submit" class="btn btn-block bg-light-green btn-lg waves-effect" border="0" name="pay" value="--><?//=l('RECURRING PAYMENT')?><!--" alt="PayPal - The safer, easier way to pay online!">-->
<!--                                <input type="submit" class="btn btn-block bg-light-green btn-lg waves-effect" border="0" name="pay" value="--><?//=l('Complete Order')?><!--" alt="PayPal - The safer, easier way to pay online!">-->
                            </form>

                       <?php }else{?>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal" class="btn btn-block bg-light-green btn-lg waves-effect"><?=l('PAYMENT NOW')?></a>
                       <?php }?>
					</div>
				</div>
			</div>
            <?php }?>

            <?php if($payment->stripe_email !=""){?>

                <div class="col-md-6">
                    <div class="whole" style="width: 100%; margin: 0 0 15px; border: none !important;">
                        <div class="plan" style="width: 100%;">

                            <?php if(session("uid")){?>

                                <form action="<?=PATH."payments/stripe_process?package=".(int)get("package")?>" method="post">
                                    <a href="javascript:void(0);" class="btn btn-block bg-light-green btn-lg waves-effect btnStripePayment" style="background: rgba(0, 0, 0, 0) linear-gradient(to bottom, rgb(0, 163, 227) 0%, rgb(0, 114, 184) 100%) repeat scroll 0 0;background-color: rgba(0, 0, 0, 0);border: medium none;font-size: 16px !important;width: 150px;padding: 6px 12px;"
                                       data-key="<?=$payment->stripe_pk?>"
                                       data-amount="<?=$tolal?>"
                                       data-stripe-panel-label="<?=l("Pay")?> <?=$tolal?>"
                                       data-currency="<?=$payment->currency?>"
                                       data-name="<?=$package->name?> <?=l('Package')?>"
                                       data-url="<?=PATH."payments/stripe_process?package=".(int)get("package")?>"
                                       data-image="<?=BASE?>assets/images/shield.png"
                                       data-description="Monthly Subscription"
                                       data-panel-label="Complete Order"
                                       data-locale="auto"><?=l('Credit Card')?></a>
                                </form>
                            <?php }else{?>
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal" class="btn btn-block bg-light-green btn-lg waves-effect"><?=l('PAYMENT NOW')?></a>
                            <?php }?>
                        </div>
                    </div>
                </div>

            <?php }?>

			<?php if($payment->pagseguro_email !=""){?>
			<div class="col-md-4">
				<div class="whole" style="width: 100%; margin: 0 0 15px;">
					<div class="plan" style="width: 100%;">
						<div class="header">
							<img src="<?=BASE."assets/images/pagseguro.gif"?>" height="100">
						</div>
						<div class="price">
							<?php if(session("uid")){?>
				      			<a href="<?=cn("do_payment_pagseguro?package=".get("package"))?>" class="btn btn-block bg-light-green btn-lg waves-effect"><?=l('PAYMENT NOW')?></a>
							<?php }else{?>
								<a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal" class="btn btn-block bg-light-green btn-lg waves-effect"><?=l('PAYMENT NOW')?></a>
				      		<?php }?>
						</div>
					</div>
				</div>
			</div>
			<?php }?>
		</div>
	</div>
</div>
<?php //=modules::run("blocks/footer")?>
<script src="https://checkout.stripe.com/v2/checkout.js"></script>
<script type="text/javascript">
 	$(document).ready(function() {
        $('.btnStripePayment').on('click', function(event) {
            event.preventDefault();
            var $button = $(this),
                $form = $button.parents('form');
            var opts = $.extend({}, $button.data(), {
                token: function(result) {
                    $form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
                }
            });
            StripeCheckout.open(opts);
        });
    });
</script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
Stripe.setPublishableKey('pk_test_z64ycgNobgmDYYULv4Kvwkd4');
$(function() {
  	var $form = $('#payment-form');
  	$form.submit(function(event) {
		// Disable the submit button to prevent repeated clicks:
		$form.find('.submit').prop('disabled', true);
		$form.find('.submit').val('Please wait...');

		// Request a token from Stripe:
		Stripe.card.createToken($form, stripeResponseHandler);
		// Prevent the form from being submitted:
		return false;
	});
});

function stripeResponseHandler(status, response) {
 	if (response.error) {
		alert(response.error.message);
 	}else{
		$.ajax({
			url: PATH+"payments/stripe_process",
			data: {access_token: response.id},
			type: 'POST',
			dataType: 'JSON',
			success: function(response){
				console.log(response);
				if(response.success)
				window.location.href=PATH+"payments/stripe_success";
			},
			error: function(error){
				console.log(error);
			}
		});
	}
}
</script>
