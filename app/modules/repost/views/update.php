<?php 
$schedule_default = SCHEDULE_DEFAULT;
$schedule_default = json_decode($schedule_default);
$targets_default = json_decode($schedule_default->target);
$speed_default = $schedule_default->speed;

$target_hashtag = $targets_default->tag;
$target_location = $targets_default->location;
$target_username = $targets_default->username;
$tags = json_decode($schedule_default->tags);
$locations = json_decode($schedule_default->locations);
$usernames = array();
switch ($speed_default) {
    case 1:
        $slow = json_decode($schedule_default->slow);
        $delay = (int)$slow->delay  * 60;
        $speed = (int)$slow->repost;
        break;
    case 2:
        $medium = json_decode($schedule_default->medium);
        $delay = (int)$medium->delay * 60;
        $speed = (int)$medium->repost;
        break;
    case 3:
        $fast = json_decode($schedule_default->fast);
        $delay = (int)$fast->delay * 60;
        $speed = (int)$fast->repost;
        break;
}

if(!empty($item)){
    $targets = json_decode($item->title);
    $tags = json_decode($item->description);
    $locations = json_decode($item->url);
    $usernames = json_decode($item->image);
    if(isset($targets->tag)){ $target_hashtag = true; }
    if(isset($targets->location)){ $target_location = true; }
    if(isset($targets->username)){ $target_username = true; }
    $delay = (int)$item->deplay;
    $speed_default = (int)$item->speed;
}
?>

<div class="row">
    <form class="formSchedule" action="javascript:void(0);" data-type="repost" data-action="<?=url("schedules/ajax_add_schedules")?>" data-redirect="<?=cn()?>">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header uc">
                <h2>
                    <i class="fa fa-retweet col-blue" aria-hidden="true"></i> <?=l('Auto Repost Media')?>
                </h2>
            </div>
            <div class="body pb0">
                <div class="row">
                    <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12 mb0">
                        <div class="panel-group full-body" id="accordion_22" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_22">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_22" aria-expanded="false" aria-controls="collapseThree_22">
                                            <i class="fa fa-users col-black" aria-hidden="true"></i> <?=l('Accounts')?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_22" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_22" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="list-instagram-accounts">
                                        <?php if(!empty($accounts)){
                                        foreach ($accounts as $key => $row) {
                                        ?>
                                        <div class="item">
                                            <img src="<?=Instagram_Get_Avatar($row->username)?>">
                                            <input type="checkbox" name="accounts[]" value="<?=$row->id?>" id="md_checkbox_<?=$row->fid?>" class="filled-in chk-col-blue" <?=(!empty($item))?"checked":""?> />
                                            <label for="md_checkbox_<?=$row->fid?>">&nbsp;</label>
                                            <div class="username"><?=$row->username?></div>
                                        </div>
                                        <?php }}?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingOne_22">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapseOne_19" aria-expanded="true" aria-controls="collapseOne_19" class="collapsed">
                                            <i class="fa fa-dot-circle-o col-red" aria-hidden="true"></i> <?=l('Targeting')?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="row mb0">
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Hashtags')?>
                                                        <span class="badge bg-none">
                                                            <div class="switch">
                                                                <label><input type="checkbox" name="enable_tag" <?=($target_hashtag)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Location')?>
                                                        <span class="badge bg-none">
                                                            <div class="switch">
                                                                <label><input type="checkbox" name="enable_location" <?=($target_location)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Username')?>
                                                        <span class="badge bg-none">
                                                            <div class="switch">
                                                                <label><input type="checkbox" name="enable_username" <?=($target_username)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_20">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_20" aria-expanded="false" aria-controls="collapseThree_20">
                                            <i class="fa fa-tachometer col-blue" aria-hidden="true"></i> <?=l('Speed')?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_20" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_20" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="row mb0">
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Activity speed')?>
                                                        <span class="badge bg-none">
                                                            <select name="speed" class="form-control show-tick activity_speed">
                                                                <option value="1" <?=($speed_default == 1)?"selected":""?>><?=l('Slow')?></option>
                                                                <option value="2" <?=($speed_default == 2)?"selected":""?>><?=l('Medium')?></option>
                                                                <option value="3" <?=($speed_default == 3)?"selected":""?>><?=l('Fast')?></option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Likes / hour (post)')?>
                                                        <span class="badge bg-none">
                                                            <select name="repeat" class="form-control show-tick">
                                                                <?php for($i = 1; $i <= 60; $i++){?>
                                                                    <option value="<?=$i?>" <?=($speed == $i)?"selected":""?>><?=$i?></option>
                                                                <?php }?>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Delay on each account (minutes)')?>
                                                        <span class="badge bg-none">
                                                            <select name="delay" class="form-control show-tick">
                                                                <?php for($i = 1; $i <= 60; $i++){?>
                                                                    <option value="<?=$i?>" <?=($delay == $i*60)?"selected":""?>><?=$i?></option>
                                                                <?php }?>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_19">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_19" aria-expanded="false" aria-controls="collapseThree_19">
                                            <i class="fa fa-hashtag col-blue-grey" aria-hidden="true"></i> <?=l('Hashtags')?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_19" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="vttags list-tags">
                                            <?php 
                                            if(!empty($tags)){
                                            foreach ($tags as $key => $row) {?>
                                                <div class="item" data-tag="<?=$row?>">
                                                    <?=$row?>
                                                    <input type="hidden" name="tags[]" value="<?=$row?>">
                                                    <div class="icon-remove btnRemoveTag">x</div>
                                                    <div class="icon-tag"></div>
                                                </div>
                                            <?php }}?>
                                            <div class="btn-group actionAddTags" role="group">
                                                <button type="button" class="btn bg-blue-grey waves-effect btnOpenAddTags"><?=l('Add')?></button>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn bg-blue-grey waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block"><?=l('Delete all hashtags')?></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_11">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_11" aria-expanded="false" aria-controls="collapseThree_11">
                                            <i class="fa fa-map-marker col-red" aria-hidden="true"></i> <?=l('Locations')?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_11" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_11" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="vttags list-locations">
                                            <?php 
                                            if(!empty($locations)){
                                            foreach ($locations as $key => $row) {
                                                $array_row = explode("|", $row);
                                                if(count($array_row) == 4){
                                            ?>
                                                <div class="item" data-location="<?=$row?>">
                                                    <a href="https://www.instagram.com/explore/locations/<?=$array_row[3]?>" target="_blank"><?=$array_row[0]?></a>
                                                    <input type="hidden" name="locations[]" value="<?=$row?>">
                                                    <div class="icon-remove btnRemoveTag">x</div>
                                                    <div class="icon-tag"></div>
                                                </div>
                                            <?php }}}?>
                                            <div class="btn-group actionAddLocations" role="group">
                                                <button type="button" class="btn bg-blue-grey waves-effect btnOpenAddLocations"><?=l('Add')?></button>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn bg-blue-grey waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block"><?=l('Delete all locations')?></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-settings mb20">
                                    <div class="panel-heading" role="tab" id="headingThree_33">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_33" aria-expanded="false" aria-controls="collapseThree_33">
                                                <i class="fa fa-user col-lime" aria-hidden="true"></i> <?=l('Usernames')?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree_33" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_33" aria-expanded="true">
                                        <div class="panel-body row mb0">
                                            <div class="vttags list-usernames">
                                                <?php 
                                                if(!empty($usernames)){
                                                foreach ($usernames as $key => $row) {
                                                    $array_row = explode("|", $row);
                                                    if(count($array_row) == 2){
                                                ?>
                                                    <div class="item" data-tag="<?=$array_row[1]?>">
                                                        <a href="https://www.instagram.com/<?=$array_row[1]?>" target="_blank"><?=$array_row[1]?></a>
                                                        <input type="hidden" name="usernames[]" value="<?=$row?>">
                                                        <div class="icon-remove btnRemoveTag">x</div>
                                                        <div class="icon-tag"></div>
                                                    </div>
                                                <?php }}}?>
                                                <div class="btn-group actionAddUsernames" role="group">
                                                    <button type="button" class="btn bg-blue-grey waves-effect btnOpenAddUsernames"><?=l('Add')?></button>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn bg-blue-grey waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="javascript:void(0);" class=" waves-effect waves-block"><?=l('Delete all usernames')?></a></li>
                                                        </ul>
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
            <div class="footer">
                <div class="btn-group right" role="group">
                    <button type="button" class="btn bg-light-green waves-effect btnAddSchedules"><i class="fa fa-play" aria-hidden="true"></i> <?=l('Add now')?></button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> 
    </form><form class="formSchedule" action="javascript:void(0);" data-type="repost" data-action="<?=url("schedules/ajax_add_schedules")?>" data-redirect="<?=cn()?>">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header uc">
                <h2>
                    <i class="fa fa-retweet col-blue" aria-hidden="true"></i> <?=l('Auto Repost Media')?>
                </h2>
            </div>
            <div class="body pb0">
                <div class="row">
                    <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12 mb0">
                        <div class="panel-group full-body" id="accordion_22" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_22">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_22" aria-expanded="false" aria-controls="collapseThree_22">
                                            <i class="fa fa-users col-black" aria-hidden="true"></i> <?=l('Accounts')?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_22" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_22" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="list-instagram-accounts">
                                        <?php if(!empty($accounts)){
                                        foreach ($accounts as $key => $row) {
                                        ?>
                                        <div class="item">
                                            <img src="<?=Instagram_Get_Avatar($row->username)?>">
                                            <input type="checkbox" name="accounts[]" value="<?=$row->id?>" id="md_checkbox_<?=$row->fid?>" class="filled-in chk-col-blue" <?=(!empty($item))?"checked":""?> />
                                            <label for="md_checkbox_<?=$row->fid?>">&nbsp;</label>
                                            <div class="username"><?=$row->username?></div>
                                        </div>
                                        <?php }}?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingOne_22">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapseOne_19" aria-expanded="true" aria-controls="collapseOne_19" class="collapsed">
                                            <i class="fa fa-dot-circle-o col-red" aria-hidden="true"></i> <?=l('Targeting')?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="row mb0">
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Hashtags')?>
                                                        <span class="badge bg-none">
                                                            <div class="switch">
                                                                <label><input type="checkbox" name="enable_tag" <?=($target_hashtag)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Location')?>
                                                        <span class="badge bg-none">
                                                            <div class="switch">
                                                                <label><input type="checkbox" name="enable_location" <?=($target_location)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Username')?>
                                                        <span class="badge bg-none">
                                                            <div class="switch">
                                                                <label><input type="checkbox" name="enable_username" <?=($target_username)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_20">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_20" aria-expanded="false" aria-controls="collapseThree_20">
                                            <i class="fa fa-tachometer col-blue" aria-hidden="true"></i> <?=l('Speed')?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_20" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_20" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="row mb0">
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Activity speed')?>
                                                        <span class="badge bg-none">
                                                            <select name="speed" class="form-control show-tick activity_speed">
                                                                <option value="1" <?=($speed_default == 1)?"selected":""?>><?=l('Slow')?></option>
                                                                <option value="2" <?=($speed_default == 2)?"selected":""?>><?=l('Medium')?></option>
                                                                <option value="3" <?=($speed_default == 3)?"selected":""?>><?=l('Fast')?></option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Likes / hour (post)')?>
                                                        <span class="badge bg-none">
                                                            <select name="repeat" class="form-control show-tick">
                                                                <?php for($i = 1; $i <= 60; $i++){?>
                                                                    <option value="<?=$i?>" <?=($speed == $i)?"selected":""?>><?=$i?></option>
                                                                <?php }?>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Delay on each account (minutes)')?>
                                                        <span class="badge bg-none">
                                                            <select name="delay" class="form-control show-tick">
                                                                <?php for($i = 1; $i <= 60; $i++){?>
                                                                    <option value="<?=$i?>" <?=($delay == $i*60)?"selected":""?>><?=$i?></option>
                                                                <?php }?>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_19">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_19" aria-expanded="false" aria-controls="collapseThree_19">
                                            <i class="fa fa-hashtag col-blue-grey" aria-hidden="true"></i> <?=l('Hashtags')?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_19" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="vttags list-tags">
                                            <?php 
                                            if(!empty($tags)){
                                            foreach ($tags as $key => $row) {?>
                                                <div class="item" data-tag="<?=$row?>">
                                                    <?=$row?>
                                                    <input type="hidden" name="tags[]" value="<?=$row?>">
                                                    <div class="icon-remove btnRemoveTag">x</div>
                                                    <div class="icon-tag"></div>
                                                </div>
                                            <?php }}?>
                                            <div class="btn-group actionAddTags" role="group">
                                                <button type="button" class="btn bg-blue-grey waves-effect btnOpenAddTags"><?=l('Add')?></button>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn bg-blue-grey waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block"><?=l('Delete all hashtags')?></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_11">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_11" aria-expanded="false" aria-controls="collapseThree_11">
                                            <i class="fa fa-map-marker col-red" aria-hidden="true"></i> <?=l('Locations')?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_11" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_11" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="vttags list-locations">
                                            <?php 
                                            if(!empty($locations)){
                                            foreach ($locations as $key => $row) {
                                                $array_row = explode("|", $row);
                                                if(count($array_row) == 4){
                                            ?>
                                                <div class="item" data-location="<?=$row?>">
                                                    <a href="https://www.instagram.com/explore/locations/<?=$array_row[3]?>" target="_blank"><?=$array_row[0]?></a>
                                                    <input type="hidden" name="locations[]" value="<?=$row?>">
                                                    <div class="icon-remove btnRemoveTag">x</div>
                                                    <div class="icon-tag"></div>
                                                </div>
                                            <?php }}}?>
                                            <div class="btn-group actionAddLocations" role="group">
                                                <button type="button" class="btn bg-blue-grey waves-effect btnOpenAddLocations"><?=l('Add')?></button>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn bg-blue-grey waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block"><?=l('Delete all locations')?></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-settings mb20">
                                    <div class="panel-heading" role="tab" id="headingThree_33">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_33" aria-expanded="false" aria-controls="collapseThree_33">
                                                <i class="fa fa-user col-lime" aria-hidden="true"></i> <?=l('Usernames')?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree_33" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_33" aria-expanded="true">
                                        <div class="panel-body row mb0">
                                            <div class="vttags list-usernames">
                                                <?php 
                                                if(!empty($usernames)){
                                                foreach ($usernames as $key => $row) {
                                                    $array_row = explode("|", $row);
                                                    if(count($array_row) == 2){
                                                ?>
                                                    <div class="item" data-tag="<?=$array_row[1]?>">
                                                        <a href="https://www.instagram.com/<?=$array_row[1]?>" target="_blank"><?=$array_row[1]?></a>
                                                        <input type="hidden" name="usernames[]" value="<?=$row?>">
                                                        <div class="icon-remove btnRemoveTag">x</div>
                                                        <div class="icon-tag"></div>
                                                    </div>
                                                <?php }}}?>
                                                <div class="btn-group actionAddUsernames" role="group">
                                                    <button type="button" class="btn bg-blue-grey waves-effect btnOpenAddUsernames"><?=l('Add')?></button>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn bg-blue-grey waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="javascript:void(0);" class=" waves-effect waves-block"><?=l('Delete all usernames')?></a></li>
                                                        </ul>
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
            <div class="footer">
                <div class="btn-group right" role="group">
                    <button type="button" class="btn bg-light-green waves-effect btnAddSchedules"><i class="fa fa-play" aria-hidden="true"></i> <?=l('Add now')?></button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> 
    </form>
</div>
