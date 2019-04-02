<div class="row">
    <form class="formSchedule" data-action="<?=url('message/ajax_save_schedules')?>">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header uc">
                    <h2>
                        <i class="fa fa-commenting col-blue" aria-hidden="true"></i> <?=l('Auto direct message')?>
                    </h2>
                </div>
                <div class="body pb0">
                    <div class="row mb0">
                        <div class="col-sm-4">
                            <b><?=l('Limit')?></b>
                            <div class="form-group mb0">
                                <select name="limit" class="form-control show-tick">
                                    <?php for($i = 1; $i <= 5000; $i++){
                                        if($i%50 == 0){
                                    ?>
                                        <option value="<?=$i?>"><?=$i?></option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <b><?=l('Instagram account')?></b>
                            <div class="form-group mb0">
                                <select name="account" class="form-control show-tick">
                                    <?php if(!empty($accounts)){
                                    foreach ($accounts as $row) {
                                    ?>
                                    <option value="<?=$row->id?>"><?=$row->username?></option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <b><?=l('Type')?></b>
                            <div class="form-group mb0">
                                <input type="hidden" name="keyword" class="form-control" value="follow">

                                <select name="follow_type" class="form-control show-tick">
                                    <option value="followers"><?=l('Followers')?></option>
                                    <option value="following"><?=l('Following')?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card" style="box-shadow: none; border: 1px solid #ddd;">
                                <div class="body pt0">
                                    <div class="row clearfix">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb0">
                                            <!-- Tab panes -->
                                            <div class="row mt15">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb0">
                                                    <label><?=l('Message')?></label>
                                                    <div class="form-group">
                                                        <div class="form-line p5">
                                                            <textarea rows="4" class="form-control no-resize post-message" name="message" placeholder="<?=l('Write something...')?>"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt15 box-post-schedule" style="display: block;">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb0">
                                                    <div class="custom-card">
                                                        <div class="body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <b><i class="fa fa-clock-o" aria-hidden="true"></i> <?=l('Time post')?></b>
                                                                    <div class="input-group mb0">
                                                                        <div class="form-line">
                                                                            <input type="text" name="time_post" class="form-control form-datetime">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-xs-6">
                                                                    <b><i class="fa fa-bullseye" aria-hidden="true"></i> <?=l('Delay (minutes)')?></b>
                                                                    <div class="input-group mb0">
                                                                        <select name="deplay" class="form-control">
                                                                            <?php for ($i = 1; $i <= 720; $i++) {
                                                                                if(MINIMUM_DEPLAY <= $i){
                                                                            ?>
                                                                                <option value="<?=$i?>" <?=(DEFAULT_DEPLAY == $i)?"selected":""?>><?=$i." ".l('minutes')?></option>
                                                                            <?php }} ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <b><i class="fa fa-pause-circle-o" aria-hidden="true"></i> <?=l('Auto pause after complete')?></b>
                                                                    <div class="input-group mb0">
                                                                        <select name="auto_pause" class="form-control">
                                                                            <option value="0"><?=l('No')?></option>
                                                                            <?php for ($i = 1; $i <= 50; $i++) {
                                                                            ?>
                                                                                <option value="<?=$i?>"><?=$i." ".l('posts')?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <b><i class="fa fa-clock-o" aria-hidden="true"></i> <?=l('Time pause')?></b>
                                                                    <select name="time_pause" class="form-control">
                                                                        <?php for ($i = 15; $i <= 900; $i++) {
                                                                        if($i%5 == 0){
                                                                        ?>
                                                                            <option value="<?=$i?>"><?=$i." ".l('minutes')?></option>
                                                                        <?php }} ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <b><i class="fa fa-repeat" aria-hidden="true"></i> <?=l('Repeat post')?></b>
                                                                    <div class="input-group mb0">
                                                                        <select name="auto_repeat" class="form-control">
                                                                            <option value="0"><?=l('No')?></option>
                                                                            <?php for ($i = 1; $i <= 365; $i++) {
                                                                            ?>
                                                                                <option value="<?=$i*86400?>"><?=$i." ".l('days')?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <b><i class="fa fa-calendar" aria-hidden="true"></i> <?=l('End day')?></b>
                                                                    <div class="input-group mb0">
                                                                        <div class="form-line">
                                                                            <input type="text" name="repeat_end" class="form-control form-date">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12 mb0">
                                                                    <div class="btn-group" role="group">
                                                                        <button type="button" class="btn bg-light-blue waves-effect btnSaveSchedules"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?=l('Save the schedule')?></button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </form>
</div>

