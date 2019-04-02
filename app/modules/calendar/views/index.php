<!--<div class="row SchedulesListActivity activity-page rowadjust" data-action="--><?//=url("schedules/ajax_enable_activity")?><!--">-->
<!--<link href="--><?//=BASE?><!--assets/css/calendar.css" rel="stylesheet">-->
<?php $this->load->model('common_model'); ?>
<?= $this->common_model->instagram_activity_header(); ?>
<div class="row rowadjust">

    <div class="col-md-12">


<?php
//$start = new \Moment\Moment($year."-".$month."-01 00:00:00",
//    $timezone);
//$start->setTimezone(date_default_timezone_get());

$newevent = explode("-",$event);
$year = $newevent[0];
$month = $newevent[1];


//$start = new DateTime(date($year."-".$month."-01 00:00:00"), new DateTimeZone(TIMEZONE_USER));
//$start->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
$homepath = dirname(__FILE__);
$new_home = str_replace('app/modules/calendar/views','',$homepath);
require_once($new_home . 'app/libraries/moment/src/Moment.php');

$start = new \Moment\Moment($year."-".$month."-01 00:00:00",TIMEZONE_USER);
$start->setTimezone(date_default_timezone_get());


if ($month == 12) {
    $end = ($year + 1) . "-01-01 00:00:00";
} else {
    $end = $year . "-" . sprintf("%02d", $month + 1) . "-01 00:00:00";
}

//$end = new DateTime($end, new DateTimeZone(TIMEZONE_USER));
//$end->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));

$end = new \Moment\Moment($end, TIMEZONE_USER);
$end->setTimezone(date_default_timezone_get());

    $this->db->select('*');
    $this->db->from('posts');
    $this->db->where('user_id',session('uid'));
    $this->db->where('account_id',$account);
    $this->db->where('is_scheduled',1);
    $this->db->where('schedule_date >=',$start->format("Y-m-d H:i:s"));
    $this->db->where('schedule_date <',$end->format("Y-m-d H:i:s"));
$resp = $this->db->get();

$Posts = $resp->num_rows()>0?$resp->result_array():"";

$counts = [];
foreach ($Posts as $p) {

//    $sd = new DateTime($p['schedule_date'], new DateTimeZone(TIMEZONE_USER));
//    $sd->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));

    $sd = new \Moment\Moment($p['schedule_date'], date_default_timezone_get());
    $sd->setTimezone(TIMEZONE_USER);

    $daynumber = $sd->format("d");

    if (empty($counts[$daynumber])) {
        $counts[$daynumber] = 0;
    }

    $counts[$daynumber]++;
}
?>

<div class='skeleton' id="schedule-calendar-month">
<!--    <div class="container">-->
    <div>
        <div class="clearfix">
            <div class="sc-month-switch">
                <?php
                $prevmonth = $month > 1 ? $month - 1 : "12";
                $prevmonth = sprintf('%02d', $prevmonth);

                $nextmonth = $month < 12 ? $month + 1 : "01";
                $nextmonth = sprintf('%02d', $nextmonth);


//                $date = new DateTime($year."-".$month."-01", new DateTimeZone(TIMEZONE_USER));

                $date = new Moment\Moment($year."-".$month."-01",TIMEZONE_USER);
                ?>

                <div class="month">
                    <a class="fa fa-angle-left nav left" href="<?= PATH."calendar?month=".($prevmonth == "12" ? $year-1 : $year)."-".$prevmonth."&account=".$account; ?>"></a>
                    <?= $date->format("F") ?>
                    <a class="fa fa-angle-right nav right" style="float: none !important;" href="<?= PATH."calendar?month=".($nextmonth == "01" ? $year+1 : $year)."-".$nextmonth."&account=".$account; ?>"></a>
                </div>

                <div class="year"><?= $year ?></div>
            </div>

            <div class="schedule-calendar">
                <?php
                $short_week_days = [
                    l("Mon"), l("Tue"), l("Wed"), l("Thu"),
                    l("Fri"), l("Sat"), l("Sun")
                ];
                ?>
                <div class="sc-head clearfix">
                    <?php foreach ($short_week_days as $wd): ?>
                        <div class='cell'><?= $wd ?></div>
                    <?php endforeach ?>
                </div>

                <?php
                $days_in_month = date("t", mktime(0, 0, 0, (int)$month, 1, $year));
                $month_firstday_number = date("N", mktime(0, 0, 0, (int)$month, 1, $year));
                $month_lastday_number = date("N", mktime(0, 0, 0, (int)$month, $days_in_month, $year));

                $days_in_prev_month = date("t", mktime(0, 0, 0, (int)$prevmonth, 1, $prevmonth == "12" ? $year-1 : $year));
                $days_in_next_month = date("t", mktime(0, 0, 0, (int)$nextmonth, 1, $nextmonth == "01" ? $year+1 : $year));

//                $now = new Moment\Moment("now", date_default_timezone_get());
//                $now->setTimezone($timezone);

//                $now = new DateTime(date("Y-m-d H:i:s"), new DateTimeZone(TIMEZONE_SYSTEM));
//                $now->setTimezone(new DateTimeZone(TIMEZONE_USER));

                $now = new Moment\Moment("now", date_default_timezone_get());
                $now->setTimezone(TIMEZONE_USER);
                ?>
                <div class="clearfix">
                    <?php if ($month_firstday_number > 1): ?>
                        <?php for ($i=1; $i<$month_firstday_number; $i++): ?>
                            <?php
                            $day = $days_in_prev_month - ($month_firstday_number-1-$i);
                            $date = ($prevmonth == "12" ? $year-1 : $year) . "-". $prevmonth . "-" . sprintf("%02d", $day);

//                            $date = new DateTime($date, new DateTimeZone(TIMEZONE_USER));
                            $date = new Moment\Moment($date,TIMEZONE_USER);
                            ?>
                            <div class='cell in-other-month'>
                                <div class='cell-inner'>
                                    <span class="day-name"><?= $date->format("D") ?></span>
                                    <span class="day-number"><?= $day ?></span>

                                    <a href="<?= PATH."calendar?month=".$date->format("Y")."-".$date->format("m")."&account=".$account; ?>" class="full-link"></a>
                                </div>
                            </div>
                        <?php endfor; ?>
                    <?php endif ?>

                    <?php for ($day=1; $day<=$days_in_month; $day++): ?>
                        <?php
                        $date = $year . "-". $month . "-" . sprintf("%02d", $day);

//                        $date = new DateTime($date, new DateTimeZone(TIMEZONE_USER));
                        $date = new Moment\Moment($date, TIMEZONE_USER);
                        ?>
                        <div class="cell <?= $date->format("Y-m-d") == $now->format("Y-m-d") ? "today" : "" ?>">
                            <div class='cell-inner'>
                                <span class="day-name"><?= $date->format("D") ?></span>
                                <span class="day-number"><?= $day ?></span>

                                <?php if ($date->format("Y-m-d") >= $now->format("Y-m-d")): ?>
                                    <a class="add-post" href="<?= PATH."post?date=".$date->format("Y-m-d")."&account=".$account ?>">
<!--                                        <span class="sli sli-plus icon"></span>-->
                                        <span class="fa fa-plus-circle"></span>
                                                <span class="hide-on-medium-and-down">
                                                    <?= l("Add post") ?>
                                                </span>
                                    </a>
                                <?php endif ?>

                                <?php if (!empty($counts[$date->format("d")])): ?>
                                    <?php
                                    $count = $counts[$date->format("d")];
                                    $count_class="";
                                    if ($count > 10) {
                                        $count_class = "high";
                                    } else if ($count > 5) {
                                        $count_class = "medium";
                                    }

                                    ?>

                                    <div class="count <?= $count_class ?>">
                                        <a href="<?= PATH."calendar?date=".$date->format("Y-m-d")."&account=".$account; ?>">
                                            <?php //= l("%s scheduled post", "%s scheduled posts", $count, $count) ?>
                                            <?= l($count." scheduled post(s)") ?>
                                        </a>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endfor; ?>


                    <?php if ($month_lastday_number < 7): ?>
                        <?php $day = 1; ?>
                        <?php for ($i=$month_lastday_number; $i<7; $i++): ?>
                            <?php
                            $date = ($nextmonth == "01" ? $year+1 : $year) . "-". $nextmonth . "-" . sprintf("%02d", $day);

//                            $date = new DateTime($date, new DateTimeZone(TIMEZONE_USER));

                            $date = new Moment\Moment($date, TIMEZONE_USER);
                            ?>
                            <div class='cell in-other-month'>
                                <div class='cell-inner'>
                                    <span class="day-name"><?= $date->format("D") ?></span>
                                    <span class="day-number"><?= $day++ ?></span>

                                    <a href="<?= PATH."calendar?month=".$date->format("Y")."-".$date->format("m")."&account=".$account;  ?>" class="full-link"></a>
                                </div>
                            </div>
                        <?php endfor; ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>



    </div>

</div>