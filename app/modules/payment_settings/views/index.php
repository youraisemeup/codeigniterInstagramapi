<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?php if(hashcheck()){?>
        <div class="alert alert-danger">
            <?=l("You need Extended License to your users can payment via paypal to use")?>
        </div>
        <?php }?>
        <div class="card">
            <div class="header">
                <h2>
                    <i class="fa fa-cc-paypal" aria-hidden="true"></i> <?=l('Payment settings')?> 
                </h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-sm-12 mb0">
                        <form action="<?=cn('ajax_update')?>" data-redirect="<?=cn()?>">
                            <input type="hidden" class="form-control" name="id" value="<?=!empty($result)?$result->id:""?>">
                            <b><?=l('Paypal email')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="paypal_email" value="<?=!empty($result)?$result->paypal_email:""?>">
                                </div>
                            </div>
                            <b><?=l('Stripe email')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="stripe_email" value="<?=!empty($result)?$result->stripe_email:""?>">
                                </div>
                            </div>
                            <b><?=l('Stripe publishable key')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="stripe_pk" value="<?=!empty($result)?$result->stripe_pk:""?>">
                                </div>
                            </div>
                            <b><?=l('Stripe secret key')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="stripe_sk" value="<?=!empty($result)?$result->stripe_sk:""?>">
                                </div>
                            </div>
                            <b><?=l('Pagseguro email')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="pagseguro_email" value="<?=!empty($result)?$result->pagseguro_email:""?>">
                                </div>
                            </div>
                            <b><?=l('Pagseguro token')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="pagseguro_token" value="<?=!empty($result)?$result->pagseguro_token:""?>">
                                </div>
                            </div>
                            <b><?=l('Type')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <select name="sandbox" class="form-control">
                                    <option value="0" <?=(!empty($result) && $result->sandbox == "0")?"selected":""?>>Live</option>
                                    <option value="1" <?=(!empty($result) && $result->sandbox == "1")?"selected":""?>>Sandbox</option>
                                </select>
                            </div>
                            <b><?=l('Currency')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <select name="currency" class="form-control">
                                    <option value="USD" <?=(!empty($result) && $result->currency == "USD")?"selected":""?>>USD</option>
                                    <option value="AUD" <?=(!empty($result) && $result->currency == "AUD")?"selected":""?>>AUD</option>
                                    <option value="CAD" <?=(!empty($result) && $result->currency == "CAD")?"selected":""?>>CAD</option>
                                    <option value="EUR" <?=(!empty($result) && $result->currency == "EUR")?"selected":""?>>EUR</option>
                                    <option value="ILS" <?=(!empty($result) && $result->currency == "ILS")?"selected":""?>>ILS</option>
                                    <option value="NZD" <?=(!empty($result) && $result->currency == "NZD")?"selected":""?>>NZD</option>
                                    <option value="RUB" <?=(!empty($result) && $result->currency == "RUB")?"selected":""?>>RUB</option>
                                    <option value="SGD" <?=(!empty($result) && $result->currency == "SGD")?"selected":""?>>SGD</option>
                                    <option value="SEK" <?=(!empty($result) && $result->currency == "SEK")?"selected":""?>>SEK</option>
                                    <option value="BRL" <?=(!empty($result) && $result->currency == "BRL")?"selected":""?>>BRL</option>
                                    <option value="MXN" <?=(!empty($result) && $result->currency == "MXN")?"selected":""?>>MXN</option>
                                    <option value="THB" <?=(!empty($result) && $result->currency == "THB")?"selected":""?>>THB</option>
                                    <option value="JPY" <?=(!empty($result) && $result->currency == "JPY")?"selected":""?>>JPY</option>
                                    <option value="MYR" <?=(!empty($result) && $result->currency == "MYR")?"selected":""?>>MYR</option>
                                    <option value="PHP" <?=(!empty($result) && $result->currency == "PHP")?"selected":""?>>PHP</option>
                                    <option value="TWD" <?=(!empty($result) && $result->currency == "TWD")?"selected":""?>>TWD</option>
                                    <option value="CZK" <?=(!empty($result) && $result->currency == "CZK")?"selected":""?>>CZK</option>
                                    <option value="PLN" <?=(!empty($result) && $result->currency == "PLN")?"selected":""?>>PLN</option>
                                </select>
                            </div>
                            <b><?=l('Currency symbol')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="symbol" value="<?=!empty($result)?$result->symbol:""?>">
                                </div>
                            </div>
                            <button type="submit" class="btn bg-red waves-effect btnActionUpdate"><?=l('Submit')?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>