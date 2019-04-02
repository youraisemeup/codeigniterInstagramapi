<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?php if($count < getMaximumAccount() || !empty($result)){?>
        <div class="card">
            <div class="header">
                <h2>
                    <i class="fa fa-plus-square" aria-hidden="true"></i> <?=l('Update Instagram account')?> 
                </h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-sm-12 mb0">
                        <form action="<?=cn('ajax_update')?>" data-redirect="<?=cn()?>">
                            <b><?=l('Instagram username')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="hidden" class="form-control" name="id" value="<?=!empty($result)?$result->id:0?>">
                                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?=!empty($result)?$result->username:""?>">
                                </div>
                            </div>
                            <b><?=l('Instagram password')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                            </div>


                            <?php if(session('admin')==1){ ?>
                            <b><?=l('Proxy')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <select name="proxy" class="form-control" >
                                    <option value=""><?=l('Select proxy')?></option>
                                    <?php if(!empty($proxy)){

                                    foreach ($proxy as $row) {
                                    ?>
                                    <option value="<?=$row->id?>" <?php if($result->proxy==$row->id) echo"selected";?> ><?=$row->name." (".$row->proxy.")"?></option>
                                    <?php }}?>
                                    <option value="0"><?=l('Using IP Host')?></option>
                                </select>
                            </div>

                            <?php }else{ 
                                if(!empty($proxy)){
                            ?>
                            <b><?=l('Proxy')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <select name="proxy" class="form-control" >
                                    <option value="0"><?=l('Using IP Host (Not recommend)')?></option>
                                    <?php 
                                    foreach ($proxy as $row) {
                                    ?>
                                    <option value="<?=$row->id?>" <?php if($result->proxy==$row->id) echo"selected";?> ><?=$row->name." (".$row->proxy.")"?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <?php }} ?>

                            <button type="submit" class="btn bg-red waves-effect btnIGAccountUpdate"><?=l('Submit')?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php }else{?>
    <div class="card">
        <div class="body">
            <div class="alert alert-danger">
                <?php redirect(PATH."payments")?>
                <?=l('Oh sorry! You have exceeded the number of accounts allowed, You are only allowed to update your account')?>
            </div>
            <a href="<?=cn()?>" class="btn bg-grey waves-effect"><?=l('Back')?></a>
        </div>
    </div>
    <?php }?>
    </div>
</div>

