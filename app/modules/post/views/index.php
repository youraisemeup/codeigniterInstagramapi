<?php $this->load->model('common_model'); ?>
<?= $this->common_model->instagram_activity_header(); ?>

<style>
    /*@media screen and (max-width: 320px) {*/
    /*.bold_btn {*/
    /*margin-top: -70px;*/
    /*padding: 0 38px 0 38px;*/
    /*padding: 0 60px 0 60px;*/
    /*}*/
    /*}*/
</style>
<?php
$media_ids = [];

//if($Post != '' && count($Post) > 0 ){
//
//}

if ($Post != '') {
    $ids = explode(",", $Post[0]["media_ids"]);
    foreach ($ids as $id) {
        $id = (int)$id;
        if ($id > 0) {
            $media_ids[] = $id;
        }
    }
}
?>



<?php // require_once(APPPATH.'/views/newfragments/sidemenu.fragment.php'); ?>

<div class='skeleton' id="post">
<form action="javascript:void(0)"
      data-url="<?= PATH."post/schedule" ?>"
      data-post-id="<?= $Post !=''? $Post[0]["id"]: ''; ?>">

<input type="hidden" name="media-ids" value="<?= implode(",", $media_ids) ?>">

<div class="container">
<div class="row">

<div class="col-md-12">

<?php

$newstatus = $Post !=''? $Post[0]["status"] : '';

if ($newstatus == "failed"): ?>
    <div class="post-prev-fail-note">
        <div class="title"><?= l("This post has been failed to publish previously because of the following reason:") ?></div>
        <div class="error"><?= $Post[0]["data"] ?></div>
    </div>
<?php endif ?>

<!--                        <div class="post-types clearfix">-->
<div class="">
<?php
$allowed = [
    "timeline" => [],
    "story" => [],
    "album" => [],
];



$authresp = json_decode($AuthUser[0]["settings"]);

$types = $authresp->post_types;
foreach ($types as $key => $val) {
    if ($val) {
        $p = explode("_", $key, 2);
        if (isset($allowed[$p[0]])) {
            if ($p[1] == "video") {
//                if ($isVideoExtenstionsLoaded) {
                if (check_FFMPEG()) {
                    $allowed[$p[0]][] = l("Video");
                }
            } else {
                $allowed[$p[0]][] = l("Photo");
            }
        }
    }
}

$type = $Post != '' ? $Post[0]["type"] : null;

?>

<div class="col s12 m2 12">
    <div class="bold_btn">
        <!-- <div class="radio">
            <label class="radion_style"> -->
        <?php
        // if(isset($Accounts)){
        //
        //     if ($AuthUser->get("settings.max_accounts") == -1 ||
        //         $AuthUser->get("settings.max_accounts") > $Accounts->getTotalCount()) {
        //         $url =APPURL.'/accounts/new';
        //         echo '<img class="blt_spc" src="'.APPURL.'/assets/new_res/images/blt.png"><font style="color:#000;">ADD ACCOUNT</font>';
        //     }
        //
        // }

        ?>
        <!--                                            <a href="--><?//= APPURL."/accounts/new" ?><!--" style="color:#000;"><img class="blt_spc" src="--><?//= APPURL."/assets/new_res/images/blt.png" ?><!--">ADD ACCOUNT</a>-->
        <!-- </label>
    </div> -->
        <div class="radio">
            <label class="radion_style single">
                <input id="single" name="type" value="timeline" style="display:none;" type="radio" <?= $type=="timeline" ? "checked" : "" ?>
                    <?= empty($allowed["timeline"]) ? "disabled" : "" ?>><img class="blt_spc" src="<?= BASE."assets/new_res/images/single.png" ?>"  >Single
                <div style="display: none">
                    <span class="sli sli-camera icon"></span>

                    <div  class="type">
                        <div class="name">
                            <span class="hide-on-small-only"><?= l("Add Post") ?></span>
                            <span class="hide-on-medium-and-up"><?= l("Post") ?></span>
                        </div>
                        <div>
                            <?= empty($allowed["timeline"]) ?
                                l("Photo") ." / ". l("Video") :
                                implode(" / ", $allowed["timeline"]) ?>
                        </div>
                    </div>
                </div>
            </label>


        </div>
        <!-- <div class="radio">

                                                    <a style="color:#000;" class="js-fm-filebrowser"
                                                       data-size="small"
                                                       href="javascript:void(0)"
                                                       > <label class="radion_style">

                                                    <img class="blt_spc" src="<?//= APPURL."/assets/new_res/images/gallery.png" ?>"  style="width:15px;">
                                                    GALLERY</label></a>
                                            </div> -->
        <div class="radio" style="display:none;">

            <a style="color:#000;"  class="js-multi-select"
               data-size="small"
               href="javascript:void(0)"
                > <label class="radion_style">

                    <img class="blt_spc" src="<?= BASE."assets/new_res/images/multiple.png" ?>"  >Multiple</label></a>
        </div>
        <div class="radio">
            <label class="radion_style multiple"><input id="multiple" style="display:none;" name="type" type="radio" value="album"
                    <?= $type=="album" ? "checked" : "" ?>
                    <?= empty($allowed["album"]) ? "disabled" : "" ?>

                    ><img class="blt_spc" src="<?= BASE."assets/new_res/images/multiple.png" ?>"  >Multiple
                <div style="display: none" >
                    <span class="sli sli-layers icon"></span>

                    <div class="type">
                        <div class="name">
                            <span class="hide-on-small-only"><?= l("Add Album") ?></span>
                            <span class="hide-on-medium-and-up"><?= l("Album") ?></span>
                        </div>

                        <div>
                            <?= empty($allowed["album"]) ?
                                l("Photo") ." / ". l("Video") :
                                implode(" / ", $allowed["album"]) ?>
                        </div>
                    </div>
                </div>

            </label>
        </div>
        <div class="radio">
            <label class="radion_style story"><input id="story" style="display:none;" name="type" type="radio" value="story"

                    <?= $type=="story" ? "checked" : "" ?>
                    <?= empty($allowed["story"]) ? "disabled" : "" ?>><img class="blt_spc" src="<?= BASE."assets/new_res/images/stories.png" ?>"  >Stories

                <div style="display: none">
                    <span class="sli sli-plus icon"></span>

                    <div class="type">
                        <div class="name">
                            <span class="hide-on-small-only"><?= l("Add Story") ?></span>
                            <span class="hide-on-medium-and-up"><?= l("Story") ?></span>
                        </div>
                        <div>
                            <?= empty($allowed["story"]) ?
                                l("Photo") ." / ". l("Video") :
                                implode(" / ", $allowed["story"]) ?>
                        </div>
                    </div>
                </div>
            </label>
        </div>

        <?php
//        $homepath = dirname(__FILE__);
//        $new_home = str_replace('app/modules/post/views','',$homepath);
//        require_once($new_home . 'app/libraries/moment/src/Moment.php');

//        $datenow = new \Moment\Moment(date("Y-m-d"), TIMEZONE_SYSTEM);
//        $datenow->setTimezone(TIMEZONE_USER);

        $now = new DateTime(date("Y-m-d H:i:s"), new DateTimeZone(TIMEZONE_SYSTEM));
        $now->setTimezone(new DateTimeZone(TIMEZONE_USER));
        $daynumber = $now->format("Y-m-d");
        ?>

        <div class="radio">
            <a style="color:#000;" href="<?= PATH."calendar?date=".$daynumber."&account=".get('account'); ?>">
                <label class="radion_link">
                    <img class="blt_spc" src="<?= BASE."assets/new_res/images/schedule.png" ?>">Scheduled
                </label>
            </a>
        </div>

        <div class="radio">
            <a style="color:#000;" href="<?= PATH."calendar?account=".get('account');?>">
                <label class="radion_link">
                    <img class="blt_spc" src="<?= BASE."assets/new_res/images/calendar2.png" ?>">Calendar
                </label>
            </a>
        </div>
    </div>
</div>

<!--                            <label>-->
<!--                                <input name="type" value="timeline" type="radio" -->
<!--                                       --><?//= $type=="timeline" ? "checked" : "" ?>
<!--                                       --><?//= empty($allowed["timeline"]) ? "disabled" : "" ?><!-->
<!--                                <div>-->
<!--                                    <span class="sli sli-camera icon"></span>-->
<!---->
<!--                                    <div class="type">-->
<!--                                        <div class="name">-->
<!--                                            <span class="hide-on-small-only">--><?//= l("Add Post") ?><!--</span>-->
<!--                                            <span class="hide-on-medium-and-up">--><?//= l("Post") ?><!--</span>-->
<!--                                        </div>-->
<!--                                        <div>-->
<!--                                            --><?//= empty($allowed["timeline"]) ?
//                                                l("Photo") ." / ". l("Video") :
//                                                implode(" / ", $allowed["timeline"]) ?><!--    -->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </label>-->
<!---->
<!--                            <label>-->
<!--                                <input name="type" type="radio" value="story" -->
<!--                                       --><?//= $type=="story" ? "checked" : "" ?>
<!--                                       --><?//= empty($allowed["story"]) ? "disabled" : "" ?><!-->
<!--                                <div>-->
<!--                                    <span class="sli sli-plus icon"></span>-->
<!---->
<!--                                    <div class="type">-->
<!--                                        <div class="name">-->
<!--                                            <span class="hide-on-small-only">--><?//= l("Add Story") ?><!--</span>-->
<!--                                            <span class="hide-on-medium-and-up">--><?//= l("Story") ?><!--</span>    -->
<!--                                        </div>-->
<!--                                        <div>-->
<!--                                            --><?//= empty($allowed["story"]) ?
//                                                l("Photo") ." / ". l("Video") :
//                                                implode(" / ", $allowed["story"]) ?><!--    -->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </label>-->
<!---->
<!--                            <label>-->
<!--                                <input name="type" type="radio" value="album" -->
<!--                                      --><?//= $type=="album" ? "checked" : "" ?>
<!--                                      --><?//= empty($allowed["album"]) ? "disabled" : "" ?><!-->
<!--                                <div>-->
<!--                                    <span class="sli sli-layers icon"></span>-->
<!---->
<!--                                    <div class="type">-->
<!--                                        <div class="name">-->
<!--                                            <span class="hide-on-small-only">--><?//= l("Add Album") ?><!--</span>-->
<!--                                            <span class="hide-on-medium-and-up">--><?//= l("Album") ?><!--</span>        -->
<!--                                        </div>-->
<!--                                        -->
<!--                                        <div>-->
<!--                                            --><?//= empty($allowed["album"]) ?
//                                                l("Photo") ." / ". l("Video") :
//                                                implode(" / ", $allowed["album"]) ?><!--    -->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </label>-->
</div>
<?php // require_once(APPPATH.'/views/newfragments/submenu.fragment.php'); ?>

<div class="new-post-inner" style="margin-right:0px;">
<!--                            <div class="col s12 m6 l4">-->


<div class="single-box-a">
    <div class="hide-on-medium-and-up post-mobile-uploader">
        <a href="javascript:void(0)" class="js-fm-filebrowser fluid button button--dark">
            <strong>
<!--                <span class="sli sli-cloud-upload fz-18 mr-10" style="vertical-align: -3px"><strong></strong></span>-->
                <?= l("Pick a file from your device") ?>
            </strong>
        </a>

        <div class="mobile-uploader-result"></div>
    </div>

    <section class="section hide-on-small-only">
        <div class="section-header clearfix">
            <div class="top-title text-center">
                <a class="js-fm-filebrowser"
                   data-size="small"
                   href="javascript:void(0)"
                    ><img src="<?= BASE."assets/new_res/images/add_photo.png" ?>" alt=""> <span class="color-org"><strong>Add Photos</strong></span></a>

                <!-- <a class="mdi mdi-link-variant icon tippy js-fm-urlformtoggler"
                                               data-size="small"
                                               href="javascript:void(0)"
                                               title="<?//= l("URL") ?>"></a> -->
            </div>
        </div>

        <div>
            <div id="filemanager"
                 data-connector-url="<?= PATH."file_manager" ?>"
                 data-maxselect="10"
                 data-selected-file-ids="[<?= implode(",", $media_ids) ?>]"
                 data-img-assets-url="<?= BASE."assets/img/" ?>"
                 style="height: 538px"></div>
        </div>
    </section>
</div>

<!--                            <div class="col s12 m6 m-last l4">-->
<div class="single-box-a">
    <section class="section">
        <div class="section-header clearfix hide-on-small-only">
            <span class="section-title"><?= l($Post != '' ? 'Edit Post' : 'New Post') ?></span>
        </div>

        <div class="section-content controls" style="min-height: 429px;">
            <div class="form-result"></div>

            <div class="mini-preview droppable">
                <div class="items clearfix">
                </div>

                <div class="drophere">
                    <span class="none"><?= l("Drop here") ?></span>
                    <span><?= l("Drag media here to post") ?></span>
                </div>
            </div>

            <div class="mb-20 pos-r pac-card" id="pac-card">
                <!--<div>
                    <div id="title">
                        Autocomplete search
                    </div>
                </div>-->
                <?php

                if($Post != ''){
                    $newplace = json_decode($Post[0]["location"]);
                    $placename = $newplace->placename;
                    $lat = $newplace->lat;
                    $long = $newplace->long;
                }else{
                    $placename = '';
                    $lat = '';
                    $long = '';
                }

                ?>
                <div id="pac-container">
                    <!--                                                <label>-->
                    <!--                                                    <input id="location" type="checkbox"-->
                    <!--                                                           class="checkbox"-->
                    <!--                                                           name="location">-->
                    <!--                                                    <span>-->
                    <!--                                                    <span class="icon unchecked" style="margin-top:19px;">-->
                    <!--                                                        <span class="mdi mdi-check"></span>-->
                    <!--                                                    </span>-->
                    <!--                                                        <input id="pac-input" class="input" type="text" placeholder="Enter a location(optional)">-->
                    <input autocomplete="off" id="pac-input" class="input" name="placename" value="<?= $placename ?>" type="text" placeholder="Enter a location">

                    <!--                                                        </span>-->
                    <!--                                                </label>-->
                    <div style="width:100%;height:300px;overflow:auto; position: absolute; z-index: 999; background: #fff;" id="locationlist"></div>
                    <input class="input" id="lat" name="lat" type="hidden" value="<?= $lat ?>">
                    <input class="input" id="long" name="long" type="hidden" value="<?= $long ?>">
                    <input class="input" id="post-new" name="post" type="hidden" value="<?= $Post !=''? $Post[0]["id"]: '' ?>">
                </div>
            </div>
            <div id="map" hidden=""></div>

            <div class="mb-20 pos-r storycaptionbox">
                <?php
                $caption = $Post !=''? $Post[0]["caption"]: '';
                if ($Post == '') {
//                                                    $CaptionModel = Controller::model("Caption", Input::get("caption"));
//
//                                                    if ($CaptionModel->isAvailable() &&
//                                                        $CaptionModel->get("user_id") == $AuthUser->get("id")) {
//                                                        $caption = $CaptionModel->get("caption");
//                                                    }
                }

                ?>

                <div class="post-caption input"
                     data-placeholder="<?= l("Write a caption") ?>"
                     contenteditable="true" spellcheck="true"><?= htmlspecialchars($caption, ENT_QUOTES, "UTF-8"); ?></div>

                <a  class="sli sli-grid post-caption-picker" hidden href="<?= PATH."/captions" ?>"></a>
            </div>

            <div class="mb-20 pos-r commentbox">
                <?php
                $comment = $Post !=''? $Post[0]["comment"]: '';
                if ($Post == '') {
//                    $CaptionModel = Controller::model("Caption", Input::get("caption"));
//
//                    if ($CaptionModel->isAvailable() &&
//                        $CaptionModel->get("user_id") == $AuthUser->get("id")) {
//                        $comment = $CaptionModel->get("caption");
//                    }

//                                                if ($comment) {
//                                                    $comment = $Post->get("comment");
//                                                }
                }

                ?>

                <div class="post-caption input" id="hashtag"
                     data-placeholder="<?= l("Write a comment") ?>"
                     contenteditable="true" spellcheck="true"><?= htmlspecialchars($comment, ENT_QUOTES, "UTF-8"); ?></div>


                <a class="sli sli-grid post-caption-picker" hidden href="<?= PATH."captions" ?>"></a>
            </div>
            <div class="mb-20 pos-r" style="overflow: hidden;">

                <button class="myhashbtn fluid bttags button" style="font-family: 'Avenir-Medium', sans-serif, arial;font-size: 14px !important;" type="button" id="savetag">Save Tag</button>
                <input class="input" id="captionid" type="hidden">
                <button class="myhashbtn fluid bttags button" style="font-family: 'Avenir-Medium', sans-serif, arial;font-size: 14px !important;" type="button" id="loadtag">Load Tag</button>

            </div>


            <div class="mb-20 pos-r" style="display: none;">
                <select class="input combobox leftpad"
                        name="accounts"
                        data-placeholder="<?= l('Choose Accounts') ?>"
                        style="width: 100%"
                        multiple>
                    <?php

//                    $acc = $Post !=''? $Post[0]["account_id"]: '';

                    if($Post !=''){
                        $acc = $Post[0]["account_id"];
                    }else{
                        $acc = get('account');
                    }

                    foreach ($Accounts as $a): ?>
                        <option value="<?= $a["id"] ?>" <?= $a["id"] == $acc ? "selected" : "" ?>><?= $a["username"] ?></option>
                    <?php endforeach; ?>
                </select>

                <span class="sli sli-social-instagram field-icon--left pe-none"></span>
            </div>
            <?php
            $is_scheduled = $Post !=''? $Post[0]["is_scheduled"] : '';

            $timezone = new DateTimeZone(TIMEZONE_USER);

            $now = new DateTime();
            $now->setTimezone($timezone);

            if ($Post == '' &&
                isValidDate(get("date"), "Y-m-d") &&
                get("date") >= $now->format("Y-m-d")) {
                $date = new DateTime(get("date")." ".$now->format("H:i"), $timezone);
                $is_scheduled = true;
            } else {
                $schedule_date = $Post !=''? $Post[0]["schedule_date"] : '';

                $date = new DateTime($is_scheduled ? $schedule_date : "now");
                $date->setTimezone($timezone);
            }

            $dateformat = 'Y-m-d';
            //                                            $timeformat = $AuthUser->get("preferences.timeformat") == "24" ? "H:i" : "h:i A";
            $timeformat = "h:i A";
            $format = $dateformat." ".$timeformat;
            ?>

            <div class="mb-20">
                <label>
                    <input type="checkbox"
                           class="checkbox"
                           name="schedule"
                           value="1"
                        <?= $is_scheduled ? "checked" : "" ?>>
                                                <span style="margin-left:13px;">
                                                    <span class="icon unchecked">
                                                        <span class="mdi mdi-check"></span>
                                                    </span>
                                                    <?= l('Schedule') ?>
                                                </span>
                </label>
            </div>

            <div class="pos-r">
                <input class="input leftpad js-datepicker"
                       name="schedule-date"
                       data-position="top left"
                       data-language='en'
                       data-date-format="<?= str_replace(["Y", "m", "d", "F"], ["yyyy", "mm", "dd", "MM"], $dateformat) ?>"
                       data-time-format="<?= str_replace(["h:i", "H:i", "A"], ["hh:ii", "hh:ii", "AA"], $timeformat) ?>"
                       data-min-date="<?= $now->format("c") ?>"
                       data-start-date="<?= $date->format("c") ?>"
                       data-user-datetime-format="<?= $format ?>"
                       type="text"
                       value="<?= $date->format($format); ?>"
                       readonly>
                <span class="sli sli-calendar field-icon--left pe-none"></span>
            </div>
        </div>

        <div class="post-submit">
            <input class="fluid large button"
                   data-value-now="<?= l("Post now") ?>"
                   data-value-schedule="<?= l("Schedule the post") ?>"
                   type="submit"
                   value="<?= l($is_scheduled == 1 ? "Schedule the post" : "Post now") ?>">
        </div>
    </section>
</div>

<!--                            <div class="col s12 m6 l4 l-last hide-on-medium-and-down">-->
<!-- <div class="col s12 m3 12 l-last hide-on-medium-and-down" style="display:none;"> -->
<div class="single-box-a l-last hide-on-medium-and-down">
    <section class="section">
        <section class="section">
            <div class="post-preview" data-type="timeline">
                <!--                                        <div class="preview-header">-->
                <!--                                            <img src="--><?//= APPURL."/assets/img/instagram-logo.png" ?><!--" alt="Instagram">-->
                <!--                                        </div>-->
                <div class="section-header clearfix hide-on-small-only">
                    <span class="section-title"><strong>Instagram</strong></span>
                </div>

                <div class="preview-account clearfix">
                    <span class="img"></span>
                                            <span class="lines">
                                                <span class="line-placeholder" style="width: 47.76%"></span>
                                                <span class="line-placeholder" style="width: 29.85%"></span>
                                            </span>
                </div>

                <div class="preview-media--timeline">
                    <div class="placeholder"></div>
                    <!-- <video src="#" playsinline autoplay muted loop></video> -->
                </div>

                <div class="preview-media--story">
                    <!-- <div class="img"></div> -->
                    <!-- <video src="#" playsinline autoplay muted loop></video> -->
                </div>
                <div class="story-placeholder"></div>

                <div class="preview-media--album">
                    <!-- <div class="img"></div> -->
                    <!-- <video src="http://demo.thepostcode.co/nextpost/assets/uploads/1/instagram/19026330_428324574201218_2358753720650432512_n.mp4" playsinline autoplay muted loop class="video-preview"></video> -->
                </div>

                <div class="preview-caption-wrapper">
                    <div class="preview-caption-placeholder" style="<?= $caption ? "display:none" : "" ?>">
                        <span class="line-placeholder"></span>
                        <span class="line-placeholder" style="width: 61.19%"></span>
                    </div>

                    <div class="preview-caption" style="<?= $caption ? "display:block" : "" ?>"><?= htmlspecialchars($caption, ENT_QUOTES, "UTF-8"); ?></div>
                </div>
            </div>
        </section>
</div>
</div>
</div>
</div>
</div>
</div>
</form>
</div>



