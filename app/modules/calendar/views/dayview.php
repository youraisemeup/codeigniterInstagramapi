<?php $this->load->model('common_model'); ?>
<?= $this->common_model->instagram_activity_header(); ?>
<div class="row rowadjust">

<div class="col-md-12">

<div class='skeleton' id="schedule-calendar-day">
<div>
<div class="pos-r">
<?php
//print_r($ActiveAccount);
//die();

if ($Accounts != '' && count($Accounts) > 0){ ?>
<!--    <form class="account-selector clearfix" action="--><?//= PATH."calendar/$year/$month/$day" ?><!--" method="GET">-->
<!--    <form class="account-selector clearfix" action="--><?//= PATH."calendar?date=".$date ?><!--" method="GET">-->
<!--        <span class="label">--><?//= l("Select Account") ?><!--</span>-->
<!---->
<!--        <select id="account" class="input input--small" name="account">-->
<!--            --><?php //foreach ($Accounts as $a){ ?>
<!--                <option value="--><?//= $a['id'] ?><!--" --><?//= $a['id'] == $ActiveAccount["id"] ? "selected" : "" ?><!-->
<!--                    --><?//= $a['username']; ?>
<!--                    (--><?//= isset($count_per_account[$a['id']]) ? $count_per_account[$a['id']] : 0 ?><!--)-->
<!--                </option>-->
<!--            --><?php //} ?>
<!--        </select>-->
<!---->
<!--        <input class="none" type="submit" value="--><?//= l("Submit") ?><!--">-->
<!--    </form>-->

    <?php
    $homepath = dirname(__FILE__);
    $new_home = str_replace('app/modules/calendar/views','',$homepath);

    require($new_home.'app/libraries/Emojione/autoload.php');

    $Emojione = new \Emojione\Client(new \Emojione\Ruleset());
    ?>
    <div class="clearfix">
    <div class="sc-month-switch" style="background-color: #fdfcfc;padding: 20px;">
        <?php
                $date_now = get('date');
                $previus_date = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $date_now ) ) ));
                $next_date = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $date_now ) ) ));

        ?>

        <div class="month">
            <a class="fa fa-angle-left nav left" href="<?= PATH."calendar?date=".$previus_date."&account=".get('account'); ?>"></a>
            <?= $date_now ?>
            <a class="fa fa-angle-right nav right" style="float: none !important;" href="<?= PATH."calendar?date=".$next_date."&account=".get('account'); ?>"></a>
        </div>

    </div>
    <div class="col s12 m6 l4 mb-20">
        <h2 class="page-secondary-title">
            <?= l("In Progress") ?>
            <span class="badge"><?= $in_progress ?></span>
        </h2>

        <div class="post-list clearfix">
            <?php foreach ($Posts as $Post){ ?>
                <?php if (!in_array($Post["status"], ["failed", "published"])){ ?>
                    <?php


                    require_once($new_home . 'app/libraries/moment/src/Moment.php');

                    $date = new \Moment\Moment($Post["schedule_date"], TIMEZONE_SYSTEM);
                    $date->setTimezone(TIMEZONE_USER);

//                    $date = new DateTime($Post["schedule_date"], new DateTimeZone(TIMEZONE_SYSTEM));
//                    $date->setTimezone(new DateTimeZone(TIMEZONE_USER));

//                    $dateformat = $AuthUser->get("preferences.dateformat");
//                    $timeformat = $AuthUser->get("preferences.timeformat") == "24" ? "H:i" : "h:i A";
//                    $format = $dateformat." ".$timeformat;
                    $format = "Y-m-d H:i:s";
                    ?>
                    <div class="post-list-item <?= $Post["status"] == "publishing" ? "" : "haslink" ?> js-list-item">
                        <div>
                            <?php if ($Post["status"] != "publishing"){ ?>
                                <div class="options context-menu-wrapper">
                                    <a href="javascript:void(0)" class="mdi mdi-dots-vertical"></a>

                                    <div class="context-menu">
                                        <ul>
                                            <li>
                                                <a href="<?= PATH."post?postid=".$Post["id"]."&account=".$ActiveAccount["id"]; ?>">
                                                    <?= l("Edit") ?>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)"
                                                   class="js-remove-list-item"
                                                   data-id="<?= $Post["id"] ?>"
                                                   data-url="<?= PATH."calendar" ?>">
                                                    <?= l("Delete") ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="quick-info">
                                <?php if ($Post["status"] == "publishing"){ ?>
                                    <span class="color-dark">
<!--                                                                <span class="icon sli sli-energy"></span>-->
                                                                <span class="fa fa-bolt"></span>
                                        <?= l("Processing now...") ?>
                                                            </span>
                                <?php }else{ ?>
                                    <?php
                                    $diff = $date->fromNow();

                                    if ($diff->getDirection() == "future") {
                                        echo $diff->getRelative();
                                    } else if (abs($diff->getSeconds()) < 60*10) {
                                        echo l("In a few moments");
                                    } else {
                                        echo l("System task error");
                                    }
                                    ?>
                                <?php } ?>
                            </div>

                            <div class="cover">
                                <?php

                                $media_ids = explode(",", $Post["media_ids"]);
//                                $File = Controller::model("File", $media_ids[0]);

                                $this->db->select('*');
                                $this->db->from('files');
                                $this->db->where('user_id',session('uid'));
                                $this->db->where_in("id", $media_ids[0]);
                                $resp2 = $this->db->get();

                                $File = $resp2->num_rows()>0?$resp2->result_array():"";

                                $type = null;

                                if ($File  != '') {
                                    $ext = strtolower(pathinfo($File[0]["filename"], PATHINFO_EXTENSION));

                                    if (in_array($ext, ["mp4"])) {
                                        $type = "video";
                                    } else if (in_array($ext, ["jpg", "jpeg", "png"])) {
                                        $type = "image";
                                    }



                                    $fileurl = BASE. "assets/uploads/". session("uid"). "/" . $File[0]["filename"];


                                    $filepath = $new_home . "assets/uploads/". session("uid"). "/" . $File[0]["filename"];

                                }

                                ?>
                                <?php if (file_exists($filepath)){ ?>
                                    <?php if ($type == "image"){ ?>
                                        <div class="img" style="background-image: url('<?= $fileurl ?>')"></div>
                                    <?php }else{ ?>
                                        <video src='<?= $fileurl ?>' playsinline autoplay muted loop></video>
                                    <?php } ?>
                                <?php } ?>
                            </div>

                            <div class="caption">
                                <?= truncate_string($Emojione->shortnameToUnicode($Post["caption"]), 50); ?>

                            </div>

                            <div class="quick-info mb-10">
                                <?php if ($Post["type"] == "album"){ ?>
<!--                                    <span class="icon sli sli-layers"></span>-->
                                    <span class="fa fa-folder-open"></span>
                                    <?= l("Album") ?>
                                <?php }elseif ($Post["type"] == "story"){ ?>
<!--                                    <span class="icon sli sli-plus"></span>-->
                                    <span class="fa fa-history"></span>
                                    <?= l("Story") ?>
                                <?php }else{ ?>
<!--                                    <span class="icon sli sli-camera"></span>-->
                                    <span class="fa fa-camera"></span>
                                    <?= l("Regular Post") ?>
                                <?php } ?>
                            </div>

                            <div class="quick-info">
<!--                                <span class="icon sli sli-calendar"></span>-->
                                <span class="fa fa-calendar"></span>
                                <?= $date->format($format); ?>
                            </div>

                            <?php if ($Post["status"] == "scheduled"){ ?>
                                <a class="full-link" href="<?= PATH."post?postid=".$Post["id"]."&account=".$ActiveAccount["id"]; ?>"></a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>

    <div class="col s12 m6 m-last l4">
        <h2 class="page-secondary-title">
            <?= l("Completed") ?>
            <span class="badge"><?= $completed ?></span>
        </h2>

        <div class="post-list clearfix">
            <?php foreach ($Posts as $Post){ ?>
                <?php if (in_array($Post["status"], ["failed", "published"])){ ?>
                    <?php

//                    require($new_home.'app/libraries/moment/autoload.php');
//                    require_once($new_home . 'app/libraries/moment/src/FormatsInterface.php');
                    require_once($new_home . 'app/libraries/moment/src/Moment.php');
//                    require_once($new_home . 'app/libraries/moment/src/MomentException.php');
//                    require_once($new_home . 'app/libraries/moment/src/MomentFromVo.php');
//                    require_once($new_home . 'app/libraries/moment/src/MomentHelper.php');
//                    require_once($new_home . 'app/libraries/moment/src/MomentLocale.php');
//                    require_once($new_home . 'app/libraries/moment/src/MomentPeriodVo.php');
//                    require_once($new_home . 'app/libraries/moment/src/CustomFormats/MomentJs.php');

                    $date = new \Moment\Moment($Post["schedule_date"], TIMEZONE_SYSTEM);
                    $date->setTimezone(TIMEZONE_USER);

//                    $dateformat = $AuthUser->get("preferences.dateformat");
//                    $timeformat = $AuthUser->get("preferences.timeformat") == "24" ? "H:i" : "h:i A";
//                    $format = $dateformat." ".$timeformat;
                    $format = "Y-m-d H:i:s";
                    ?>
                    <div class="post-list-item haslink js-list-item">
                        <div>
                            <div class="options context-menu-wrapper">
                                <a href="javascript:void(0)" class="mdi mdi-dots-vertical"></a>

                                <div class="context-menu">
                                    <ul>
                                        <?php if ($Post["status"] == "published"){

                                        $code = json_decode($Post["data"]);
                                        ?>
                                            <li>
                                                <a href="<?= "https://www.instagram.com/p/".$code->code; ?>" target="_blank">
                                                    <?= l("View on Instagram") ?>
                                                </a>
                                            </li>
                                        <?php }else{ ?>
                                            <li>
                                                <a href="<?= PATH."post?postid=".$Post["id"]."&account=".$ActiveAccount["id"]; ?>">
                                                    <?= l("Edit") ?>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)"
                                                   class="js-remove-list-item"
                                                   data-id="<?= $Post["id"] ?>"
                                                   data-url="<?= PATH."calendar" ?>">
                                                    <?= l("Delete") ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="quick-info">
                                <?php if ($Post["status"] == "published"){ ?>
                                <span class="color-success">
<!--                                                                <span class="icon sli sli-check"></span>-->
                                                                <span class="fa fa-check-circle"></span>
                                    <?= l("Published") ?>
                                    <?php }else{ ?>
                                                            </span>
                                                            <span class="color-danger">
<!--                                                                <span class="icon sli sli-close"></span>-->
                                                                <span class="fa fa-times-circle"></span>
                                                                <?= l("Failed") ?>
                                                                <?php } ?>
                                                            </span>
                            </div>

                            <div class="cover">
                                <?php
                                $media_ids = explode(",", $Post["media_ids"]);
//                                $File = Controller::model("File", $media_ids[0]);

                                $this->db->select('*');
                                $this->db->from('files');
                                $this->db->where('user_id',session('uid'));
                                $this->db->where_in("id", $media_ids[0]);
                                $resp2 = $this->db->get();

                                $File = $resp2->num_rows()>0?$resp2->result_array():"";

                                $type = null;
                                if ($File != '') {
                                    $ext = strtolower(pathinfo($File[0]["filename"], PATHINFO_EXTENSION));

                                    if (in_array($ext, ["mp4"])) {
                                        $type = "video";
                                    } else if (in_array($ext, ["jpg", "jpeg", "png"])) {
                                        $type = "image";
                                    }

                                    $fileurl = BASE
                                        . "/assets/uploads/"
                                        . session("uid")
                                        . "/" . $File[0]["filename"];

//                                    $homepath = dirname(__FILE__);
//                                    $new_home = str_replace('app/modules/calendar/views','',$homepath);

                                    $filepath = $new_home
                                        . "/assets/uploads/"
                                        . session("uid")
                                        . "/" . $File[0]["filename"];
                                }

//                                $fileurl = APPURL
//                                    . "/assets/uploads/"
//                                    . $AuthUser->get("id")
//                                    . "/" . $File->get("filename");
//
//                                $filepath = ROOTPATH
//                                    . "/assets/uploads/"
//                                    . $AuthUser->get("id")
//                                    . "/" . $File->get("filename");
                                ?>
                                <?php if (file_exists($filepath)){ ?>
                                    <?php if ($type == "image"){ ?>
                                        <div class="img" style="background-image: url('<?= $fileurl ?>')"></div>
                                    <?php }else{ ?>
                                        <video src='<?= $fileurl ?>' playsinline autoplay muted loop></video>
                                    <?php } ?>
                                <?php } ?>
                            </div>

                            <div class="caption">
                                <?= truncate_string($Emojione->shortnameToUnicode($Post["caption"]), 50); ?>
                            </div>

                            <div class="quick-info mb-10">
                                <?php if ($Post["type"] == "album"){ ?>
<!--                                    <span class="icon sli sli-layers"></span>-->
                                    <span class="fa fa-folder-open"></span>
                                    <?= l("Album") ?>
                                <?php }elseif ($Post["type"] == "story"){ ?>
<!--                                    <span class="icon sli sli-plus"></span>-->
                                    <span class="fa fa-history"></span>
                                    <?= l("Story") ?>
                                <?php }else{ ?>
<!--                                    <span class="icon sli sli-camera"></span>-->
                                    <span class="fa fa-camera"></span>
                                    <?= l("Regular Post") ?>
                                <?php } ?>
                            </div>

                            <div class="quick-info">
<!--                                <span class="icon sli sli-calendar"></span>-->
                                <span class="fa fa-calendar"></span>
                                <?= $date->format($format); ?>
                            </div>

                            <?php if ($Post["status"] == "published"){
                                $code = json_decode($Post["data"]);
                                ?>
                                <a class="full-link" href="<?= "https://www.instagram.com/p/".$code->code; ?>" target="_blank"></a>
                            <?php }else{ ?>
                                <a class="full-link" href="<?= PATH."post?postid=".$Post["id"]."&account=".$ActiveAccount["id"]; ?>"></a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    </div>
<?php } ?>

</div>
</div>
</div>


</div>
</div>