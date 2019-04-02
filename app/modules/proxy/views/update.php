<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <i class="fa fa-deaf" aria-hidden="true"></i> <?=l('Update proxy')?> 
                </h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-sm-12 mb0">
                        <form action="<?=cn('ajax_update')?>" data-redirect="<?=cn()?>">
                            <input type="hidden" class="form-control" name="id" value="<?=!empty($result)?$result->id:""?>">
                            <b><?=l('Name')?></b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="name" value="<?=!empty($result)?$result->name:""?>">
                                </div>
                            </div>
                            <b><?=l('Proxy')?></b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="proxy" value="<?=!empty($result)?$result->proxy:""?>">
                                </div>
                                <span class="small col-grey"><?=l('Example')?>: <br/>
                                    // HTTP proxy needing authentication: <span class="col-black">http://user:pass@iporhost:port</span><br/>

                                    // HTTP proxy without authentication: <span class="col-black">http://iporhost:port</span><br/>

                                    // Encrypted HTTPS proxy needing authentication: <span class="col-black">https://user:pass@iporhost:port</span><br/>

                                    // Encrypted HTTPS proxy without authentication: <span class="col-black">https://iporhost:port</span><br/>

                                    // SOCKS5 Proxy needing authentication: <span class="col-black">socks5://user:pass@iporhost:port</span><br/>

                                    // SOCKS5 Proxy without authentication: <span class="col-black">socks5://iporhost:port</span><br/>
                                </span>
                            </div>
                            <b><?=l('Status')?></b>
                            <div class="form-group demo-radio-button">
                                <input name="status" type="radio" id="default_yes" class="radio-col-red" <?=(!empty($result) && $result->status == 1)?"checked=''":""?> value="1">
                                <label for="default_yes"><?=l('Yes')?></label>

                                <input name="status" type="radio" id="default_no" class="radio-col-red" <?=(!empty($result) && $result->status == 0)?"checked=''":""?> value="0">
                                <label for="default_no"><?=l('No')?></label>

                            </div>
                            <button type="submit" class="btn bg-red waves-effect btnActionUpdate"><?=l('Submit')?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>