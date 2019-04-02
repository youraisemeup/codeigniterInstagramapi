
<style>
    .carousel-indicators {
        position: absolute;
        bottom: 20px !important;
        left: 50%;
        z-index: 15;
        width: 60%;
        padding-left: 0;
        margin-left: -30%;
        text-align: center;
        list-style: none;
    }
    .modal-content {
        padding: 0px !important;
    }
    .carousel-control.left{background: none !important;}
    .carousel-control.right{background: none !important;}
    .carousel-indicators li {
        display: inline-block;
        width: 8px;
        height: 8px;
        margin: 1px;
        text-indent: -999px;
        cursor: pointer;
        background-color: #000\9;
        background-color: rgb(167, 167, 165);
        border: 0px !important;
        /* border-radius: 50%; */
    }

    .carousel-inner {

        margin-bottom: 50px !important;
    }


    .carousel-indicators .active {
        width: 8px;
        height: 8px;
        margin: 1px;
        background-color: #0070bc;
    }
    .carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right, .carousel-control .icon-next, .carousel-control .icon-prev{
        font-size: 14px !important;
        color: #0070bd;
    }
    /*.carousel-control{*/
    /*opacity: 1;*/
    /*box-shadow: 0px;}*/

    .item h2{
        margin: 0px;
        text-align: center;
        font-size: 22px;
        color: #000;
        padding: 20px 0px 20px;
    }
    .item p{
        font-size: 13px;
        color: #000;
        text-align: center;
        width: 80%;
        margin: 0 auto;}
    .carousel{position: initial !important;}
    .slider_go {
        /*background: #a7a7a5;*/
        /*margin: 10px auto;*/
        /*display: table;*/
        /*font-size: 12px;*/
        /*padding: 10px 30px;*/
        /*color: #fff;*/
        /*border-radius: 5px;*/
        /*float: none;*/
        /*opacity: 1;*/
        /*font-weight: normal;*/

        background: #0D509F;
        margin: 10px auto;
        display: table;
        font-size: 14px;
        padding: 10px 30px;
        color: #fff;
        border-radius: 5px;
        float: none;
        opacity: 1 !important;
        font-weight: normal;
        text-shadow: none;
    }

    .slider_go:hover{
        background: #0D509F;
        color: #fff;
    }

    .carousel-control {text-shadow: 0 0px 0px rgba(0, 0, 0, .6);}
</style>
<section class="content">
<div class="container">
<div class="row SchedulesListActivity activity-page rowadjust" data-action="<?=BASE?>index.php/schedules/ajax_enable_activity">

    <div class="col-md-12 m-b-15">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 instabottom">
                <a href="<?= PATH ?>" target="_blank">
                    <img class="instagram-avatar" src="<?=BASE?>assets/images/default-avatar.png" alt="Instagram avatar">
                </a>
                <a href="<?= PATH ?>" target="_blank" class="instagram-username">
                   username
                </a>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-add-email" style="color: #000 !important;font-size: 20px;margin-right: 3px;"><i class="fa fa-at" style="vertical-align: middle;"></i></a>
                <a href="<?= PATH ?>" style="color: #000 !important;font-size: 20px;margin-right: 3px;"><i class="material-icons" style="vertical-align: middle;">dashboard</i></a>

                <div class="modal fade" id="modal-add-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header new-grey">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="defaultModalLabel"><?=l('Add Your Email')?></h4>
                            </div>
                            <div class="modal-body pt0">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in">
                                        <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                                            <?=l('Add your email to your account to be notified if your Activity is stopped for any reason (reached limits or an error) so your account can grow without interruptions.');?>
                                        </p>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="email" class="form-control" placeholder="<?=l('Email')?>">
                                                <input type="hidden" name="account" class="form-control" value="<?=$row['account_id'];?>">
                                            </div>
                                        </div>
                                        <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                                            <?=l('You can add the same email to multiple accounts.');?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="text-align: left;">
                                <button type="button" class="btn new-blue waves-effect" data-dismiss="modal" style="text-transform: none !important;width: 100px;"><?=l('Set')?></button>
                                <a class="btn waves-effect" data-dismiss="modal" style="text-transform: none !important;color: #337ab7;"><?=l('Remove')?></a>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="navbar-header newtoggle">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <i class="fa fa-angle-down"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse menu_02" id="myNavbar">
                    <ul class="nav navbar-nav nav-group">
                        <li><a href="<?= PATH ?>" class="navbar-link m-r-15"><?= l('Activity') ?></a></li>
                        <li><a href="<?= PATH ?>" class="navbar-link m-r-15"><?= l('Stats') ?></a></li>
                        <li><a href="<?= PATH ?>" class="navbar-link m-r-15"><?= l('Schedule') ?></a></li>
                        <li><a href="<?= PATH ?>" class="navbar-link m-r-15"><?= l('Log') ?></a></li>
                        <li><a href="<?= PATH ?>" class="navbar-link m-r-15"><?= l('Profile') ?></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    var activity_speed = [
        {"repost":3,"like":20,"comment":4,"deletemedia":10,"follow":15,"like_follow":1,"followback":15,"unfollow":15,"delay":6},
        {"repost":6,"like":25,"comment":7,"deletemedia":20,"follow":20,"like_follow":1,"followback":20,"unfollow":20,"delay":4},
        {"repost":9,"like":30,"comment":10,"deletemedia":30,"follow":25,"like_follow":1,"followback":25,"unfollow":25,"delay":2}   ];
</script>

<div class="row rowadjust">

<form class="formSchedule" action="javascript:void(0);" data-type="all" data-action="<?=BASE?>index.php/schedules/ajax_add_multi_schedules" data-redirect="<?=PATH?>">
<input type="hidden" name="accounts[]" value="0">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<!--        <div class="card">-->
<div class="body pb0">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 activity-status-button margin-bottom-0" data-action="<?=BASE?>index.php/schedules/ajax_enable_activity">
            <div class="col-md-12 list-group-count m-t-15">
                <div class="row">
                    <div class="header uc">
                        <h2 style="padding-left: 16px; font-size: 35px;">
                            Activity                                    </h2>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-grey">
                        Status                                </div>
                    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6">
                        <span class="activity-status" style="padding: 15px; display: table;">Stopped</span>                                </div>
                </div>
            </div>
            <div class="m-t-15 m-b-10">
                <a href="<?= PATH.'register' ?>" target="_blank" class="btn btn-lg waves-effect btn-block btn-dashboard bg-dashboard-primary rounded-corner btnAddSchedules" style="width: 180px;">Start</a>
            </div>
            <a href="#" class="custom-help-block quickguide">Quick Start Guide</a>
<!--            <a href="#" class="custom-help-block">Quick Start Guide</a>-->
<!--            <a href="--><?//=BASE?><!--" class="custom-help-block">Dashboard</a>-->
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 activity-status-button margin-bottom-0">
            <div class="servic_text">Select what you want to do</div>

            <div class="todo-control" data-field="like">
                <label class="switch-label">
                    <input type="checkbox" name="todo_like" checked>
                                <span class="switch-slider round">
                                    <i class="fa fa-heart col-white font-20 disable" aria-hidden="true"></i>
                                    <i class="fa fa-heart col-white font-20 enable" aria-hidden="true"></i>
                                </span>
                </label>
                <label class="todo-label likes">
                    Likes                                <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title=""
									   data-original-title="">?</span>
                </label>
                <span class="todo-count">0</span>
            </div>

            <div class="todo-control" data-field="comment">
                <label class="switch-label">
                    <input type="checkbox" name="todo_comment" checked>
                                <span class="switch-slider round">
                                    <i class="fa fa-comment col-white font-20 disable" aria-hidden="true"></i>
                                    <i class="fa fa-comment col-white font-20 enable" aria-hidden="true"></i>
                                </span>
                </label>
                <label class="todo-label">
                    Comments                                <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-content="Turn this switch on (blue) to automate your Comments activity.<br/><br/>
									  	The counter shows how many photos and videos you've commented
										since your last activity start.
									  " data-original-title="Comments">?</span>
                </label>
                <span class="todo-count">0</span>
            </div>

            <div class="todo-control" data-field="follow">
                <label class="switch-label">
                    <input type="checkbox" name="todo_follow" checked>
                                <span class="switch-slider round">
                                    <i class="fa fa-user col-white font-20 disable" aria-hidden="true"></i>
                                    <i class="fa fa-user col-white font-20 enable" aria-hidden="true"></i>
                                </span>
                </label>
                <label class="todo-label">
                    Follows                                <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-content="Turn this switch on (blue) to automate your Follows activity.<br/><br/>
									  	The counter shows how many users you've followed
										since your last activity start.
									  " data-original-title="Follows">?</span>
                </label>
                <span class="todo-count">0</span>
            </div>

            <div class="todo-control" data-field="unfollow">
                <label class="switch-label">
                    <input type="checkbox" name="todo_unfollow" checked>
                                <span class="switch-slider round">
                                    <i class="fa fa-times col-white font-20 disable" aria-hidden="true"></i>
                                    <i class="fa fa-times col-white font-20 enable" aria-hidden="true"></i>
                                </span>
                </label>
                <label class="todo-label">
                    Unfollows                                <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-content="Turn this switch on (blue) to automate your Unfollows activity.<br/><br/>
									  	The counter shows how many users you've unfollowed
										since your last activity start.
									  " data-original-title="Unfollows">?</span>
                </label>
                <span class="todo-count">0</span>
            </div>
        </div>
        <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12 margin-bottom-0">
            <div class="row">
                <div class="embed-responsive-4by3">

                    <div class="video-warp">
                        <iframe src="https://player.vimeo.com/video/307399102?title=0&amp;byline=0&amp;portrait=0" frameborder="0"></iframe>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="card">
<div class="row m-b-30">
<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12 mb0">
<div class="btn-group hidden" role="group">
<div class="hidden">
<input type="checkbox" name="todo_like_follow" >
<input type="checkbox" name="todo_followback" >
<select name="todo_repost" class="form-control show-tick">
    <option value="">Default</option>
    <option value="1" >Hashtags</option>
    <option value="2" >Locations</option>
    <option value="3" selected>Usernames</option>
    <option value="4" >All</option>
</select>
<input type="checkbox" name="todo_deletemedia" >
<select name="repeat_like_follow" class="form-control show-tick repeat_like_follow">
    <option value="1" selected>1</option>
    <option value="2" >2</option>
    <option value="3" >3</option>
    <option value="4" >4</option>
    <option value="5" >5</option>
    <option value="6" >6</option>
    <option value="7" >7</option>
    <option value="8" >8</option>
    <option value="9" >9</option>
    <option value="10" >10</option>
    <option value="11" >11</option>
    <option value="12" >12</option>
    <option value="13" >13</option>
    <option value="14" >14</option>
    <option value="15" >15</option>
    <option value="16" >16</option>
    <option value="17" >17</option>
    <option value="18" >18</option>
    <option value="19" >19</option>
    <option value="20" >20</option>
    <option value="21" >21</option>
    <option value="22" >22</option>
    <option value="23" >23</option>
    <option value="24" >24</option>
    <option value="25" >25</option>
    <option value="26" >26</option>
    <option value="27" >27</option>
    <option value="28" >28</option>
    <option value="29" >29</option>
    <option value="30" >30</option>
    <option value="31" >31</option>
    <option value="32" >32</option>
    <option value="33" >33</option>
    <option value="34" >34</option>
    <option value="35" >35</option>
    <option value="36" >36</option>
    <option value="37" >37</option>
    <option value="38" >38</option>
    <option value="39" >39</option>
    <option value="40" >40</option>
    <option value="41" >41</option>
    <option value="42" >42</option>
    <option value="43" >43</option>
    <option value="44" >44</option>
    <option value="45" >45</option>
    <option value="46" >46</option>
    <option value="47" >47</option>
    <option value="48" >48</option>
    <option value="49" >49</option>
    <option value="50" >50</option>
    <option value="51" >51</option>
    <option value="52" >52</option>
    <option value="53" >53</option>
    <option value="54" >54</option>
    <option value="55" >55</option>
    <option value="56" >56</option>
    <option value="57" >57</option>
    <option value="58" >58</option>
    <option value="59" >59</option>
    <option value="60" >60</option>
</select>
<select name="repeat_deletemedia" class="form-control show-tick repeat_deletemedia">
    <option value="1" >1</option>
    <option value="2" >2</option>
    <option value="3" >3</option>
    <option value="4" >4</option>
    <option value="5" >5</option>
    <option value="6" >6</option>
    <option value="7" >7</option>
    <option value="8" >8</option>
    <option value="9" >9</option>
    <option value="10" selected>10</option>
    <option value="11" >11</option>
    <option value="12" >12</option>
    <option value="13" >13</option>
    <option value="14" >14</option>
    <option value="15" >15</option>
    <option value="16" >16</option>
    <option value="17" >17</option>
    <option value="18" >18</option>
    <option value="19" >19</option>
    <option value="20" >20</option>
    <option value="21" >21</option>
    <option value="22" >22</option>
    <option value="23" >23</option>
    <option value="24" >24</option>
    <option value="25" >25</option>
    <option value="26" >26</option>
    <option value="27" >27</option>
    <option value="28" >28</option>
    <option value="29" >29</option>
    <option value="30" >30</option>
    <option value="31" >31</option>
    <option value="32" >32</option>
    <option value="33" >33</option>
    <option value="34" >34</option>
    <option value="35" >35</option>
    <option value="36" >36</option>
    <option value="37" >37</option>
    <option value="38" >38</option>
    <option value="39" >39</option>
    <option value="40" >40</option>
    <option value="41" >41</option>
    <option value="42" >42</option>
    <option value="43" >43</option>
    <option value="44" >44</option>
    <option value="45" >45</option>
    <option value="46" >46</option>
    <option value="47" >47</option>
    <option value="48" >48</option>
    <option value="49" >49</option>
    <option value="50" >50</option>
    <option value="51" >51</option>
    <option value="52" >52</option>
    <option value="53" >53</option>
    <option value="54" >54</option>
    <option value="55" >55</option>
    <option value="56" >56</option>
    <option value="57" >57</option>
    <option value="58" >58</option>
    <option value="59" >59</option>
    <option value="60" >60</option>
</select>
<select name="repeat_followback" class="form-control show-tick repeat_followback">
    <option value="1" >1</option>
    <option value="2" >2</option>
    <option value="3" >3</option>
    <option value="4" >4</option>
    <option value="5" >5</option>
    <option value="6" >6</option>
    <option value="7" >7</option>
    <option value="8" >8</option>
    <option value="9" >9</option>
    <option value="10" >10</option>
    <option value="11" >11</option>
    <option value="12" >12</option>
    <option value="13" >13</option>
    <option value="14" >14</option>
    <option value="15" selected>15</option>
    <option value="16" >16</option>
    <option value="17" >17</option>
    <option value="18" >18</option>
    <option value="19" >19</option>
    <option value="20" >20</option>
    <option value="21" >21</option>
    <option value="22" >22</option>
    <option value="23" >23</option>
    <option value="24" >24</option>
    <option value="25" >25</option>
    <option value="26" >26</option>
    <option value="27" >27</option>
    <option value="28" >28</option>
    <option value="29" >29</option>
    <option value="30" >30</option>
    <option value="31" >31</option>
    <option value="32" >32</option>
    <option value="33" >33</option>
    <option value="34" >34</option>
    <option value="35" >35</option>
    <option value="36" >36</option>
    <option value="37" >37</option>
    <option value="38" >38</option>
    <option value="39" >39</option>
    <option value="40" >40</option>
    <option value="41" >41</option>
    <option value="42" >42</option>
    <option value="43" >43</option>
    <option value="44" >44</option>
    <option value="45" >45</option>
    <option value="46" >46</option>
    <option value="47" >47</option>
    <option value="48" >48</option>
    <option value="49" >49</option>
    <option value="50" >50</option>
    <option value="51" >51</option>
    <option value="52" >52</option>
    <option value="53" >53</option>
    <option value="54" >54</option>
    <option value="55" >55</option>
    <option value="56" >56</option>
    <option value="57" >57</option>
    <option value="58" >58</option>
    <option value="59" >59</option>
    <option value="60" >60</option>
</select>
<select name="repeat_repost" class="form-control show-tick repeat_repost">
    <option value="1" >1</option>
    <option value="2" >2</option>
    <option value="3" selected>3</option>
    <option value="4" >4</option>
    <option value="5" >5</option>
    <option value="6" >6</option>
    <option value="7" >7</option>
    <option value="8" >8</option>
    <option value="9" >9</option>
    <option value="10" >10</option>
    <option value="11" >11</option>
    <option value="12" >12</option>
    <option value="13" >13</option>
    <option value="14" >14</option>
    <option value="15" >15</option>
    <option value="16" >16</option>
    <option value="17" >17</option>
    <option value="18" >18</option>
    <option value="19" >19</option>
    <option value="20" >20</option>
    <option value="21" >21</option>
    <option value="22" >22</option>
    <option value="23" >23</option>
    <option value="24" >24</option>
    <option value="25" >25</option>
    <option value="26" >26</option>
    <option value="27" >27</option>
    <option value="28" >28</option>
    <option value="29" >29</option>
    <option value="30" >30</option>
    <option value="31" >31</option>
    <option value="32" >32</option>
    <option value="33" >33</option>
    <option value="34" >34</option>
    <option value="35" >35</option>
    <option value="36" >36</option>
    <option value="37" >37</option>
    <option value="38" >38</option>
    <option value="39" >39</option>
    <option value="40" >40</option>
    <option value="41" >41</option>
    <option value="42" >42</option>
    <option value="43" >43</option>
    <option value="44" >44</option>
    <option value="45" >45</option>
    <option value="46" >46</option>
    <option value="47" >47</option>
    <option value="48" >48</option>
    <option value="49" >49</option>
    <option value="50" >50</option>
    <option value="51" >51</option>
    <option value="52" >52</option>
    <option value="53" >53</option>
    <option value="54" >54</option>
    <option value="55" >55</option>
    <option value="56" >56</option>
    <option value="57" >57</option>
    <option value="58" >58</option>
    <option value="59" >59</option>
    <option value="60" >60</option>
</select>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12 mb0">
<div class="panel-group full-body" id="accordion_22" role="tablist" aria-multiselectable="true">

<div class="panel panel-settings mb20">
    <div class="panel-heading" role="tab" id="headingOne_19">
        <h4 class="panel-title">
            <a role="button" class="activity-settings-cat" data-toggle="collapse" href="#collapseOne_19" aria-expanded="true" aria-controls="collapseOne_19">
                <div class="general-icon general-icon-targeting"></div>
                <span>Targeting</span>
                <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
            </a>
        </h4>
    </div>
    <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19" aria-expanded="true">
        <div class="panel-body row mb0">
            <div class="row mb0">
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Hashtags                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Hashtags" data-content="Based on selected Activity Actions, you can like and/or comment
								  	on media posted under <b>Hashtags</b> added in your settings,
								  	and/or follow users who posted those media.<br/><br/>

								  	<span class='color-blue'>INFO:</span> This targeting source
								  	works independently of all other targeting sources that you
								  	can select.<br/><br/>

									<span class='color-warning'>IMPORTANT:</span> To use this source
									you should add at least 1 tag in the <b>Hashtags</b> list.">?</span>
                                                        <span class="badge bg-none">
                                                            <div>
                                                                <label>
                                                                    <input type="checkbox" class="chk-custom" name="enable_tag" >
                                                                    <span class="chk-custom"></span>
                                                            </div>
                                                        </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Locations                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Locations" data-content="Based on selected Activity Actions, you can like and/or comment
								  	on media posted under <b>Locations</b> added in your settings,
								  	and/or follow users who posted those media.<br/><br/>

								  	<span class='color-blue'>INFO:</span> This targeting source
								  	works independently of all other targeting sources that you
								  	can select.<br/><br/>

									<span class='color-warning'>IMPORTANT:</span> To use this source
									you should add at least 1 location in the <b>Locations</b> list.">?</span>
                                                        <span class="badge bg-none">
                                                            <div>
                                                                <label>
                                                                    <input type="checkbox" class="chk-custom" name="enable_location" >
                                                                    <span class="chk-custom"></span>
                                                                </label>
                                                            </div>
                                                        </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Followers                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Followers" data-content="Based on selected Activity Actions, you can follow users
								  	who follow <b>Usernames</b> added in your settings (Followers of Usernames),
								  	and/or like or comment on 1-3 most recent media posted by those users.<br/><br/>

								  	You can also target your own Followers (users who follow your account)
								  	by selecting <b>My Account</b> or <b>All</b>.<br/><br/>

								  	<span class='color-blue'>INFO:</span> This targeting source
								  	works independently of all other targeting sources that you
								  	can select.<br/><br/>

									<span class='color-warning'>IMPORTANT:</span> To use this source
									you may need to add at least 1 username in the <b>Usernames</b> list.">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="enable_followers" class="form-control show-tick">
                                                                <option value="">Default</option>
                                                                <option value="1" >Usernames</option>
                                                                <option value="2" >My Account</option>
                                                                <option value="3" >All</option>
                                                            </select>
                                                        </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Followings                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Followings" data-content="Based on selected Activity Actions, you can follow users
								  	followed by <b>Usernames</b> added in your settings (Followings of Usernames),
								  	and/or like or comment on 1-3 most recent media posted by those users.<br/><br/>

								  	You can also target your own Followings (users you follow)
								  	by selecting <b>My Feed</b> or <b>All</b>.<br/><br/>

								  	<span class='color-blue'>INFO:</span> This targeting source
								  	works independently of all other targeting sources that you
								  	can select.<br/><br/>

									<span class='color-warning'>IMPORTANT:</span> To use this source
									you may need to add at least 1 username in the <b>Usernames</b> list.">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="enable_followings" class="form-control show-tick">
                                                                <option value="">Default</option>
                                                                <option value="1" >Usernames</option>
                                                                <option value="2" >My Account</option>
                                                                <option value="3" >All</option>
                                                            </select>
                                                        </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Likers                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Likers" data-content="Based on selected Activity Actions, you can follow users
								  	who have liked the media posted by the <b>Usernames</b>
								  	added in your settings, and/or like or comment on 1-3 most
								  	recent media posted by those users.<br/><br/>

								  	You can also target your own Likers (users who have liked your media)
								  	by selecting <b>My posts</b> or <b>All</b>.<br/><br/>

								  	<span class='color-blue'>INFO:</span> This targeting source
								  	works independently of all other targeting sources that you
								  	can select.<br/><br/>

									<span class='color-warning'>IMPORTANT:</span> To use this source
									you may need to add at least 1 username in the <b>Usernames</b> list.">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="enable_likers" class="form-control show-tick">
                                                                <option value="">Default</option>
                                                                <option value="1" >Usernames Post</option>
                                                                <option value="2" >My Post</option>
                                                                <option value="3" >All</option>
                                                            </select>
                                                        </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Commenters                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Commenters" data-content="Based on selected Activity Actions, you can follow users
								  	who have commented on the media posted by <b>Usernames</b>
								  	added in your settings, and/or like or comment on 1-3 most
								  	recent media posted by those users.<br/><br/>

								  	You can also target your own Commenters (users who have commented on your media)
								  	by selecting <b>My posts</b> or <b>All</b>.<br/><br/>

								  	<span class='color-blue'>INFO:</span> This targeting source
								  	works independently of all other targeting sources that you
								  	can select.<br/><br/>

									<span class='color-warning'>IMPORTANT:</span> To use this source
									you may need to add at least 1 username in the <b>Usernames</b> list.">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="enable_commenters" class="form-control show-tick">
                                                                <option value="">Default</option>
                                                                <option value="1" >Usernames Post</option>
                                                                <option value="2" >My Post</option>
                                                                <option value="3" >All</option>
                                                            </select>
                                                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-settings mb20 adjust-space">
<div class="panel-heading" role="tab" id="headingThree_20">
    <h4 class="panel-title">
        <a class="activity-settings-cat" role="button" data-toggle="collapse" href="#collapseThree_20" aria-expanded="true" aria-controls="collapseThree_20">
<!--            <div class="general-icon general-icon-main"></div>-->
            <img src="<?=BASE?>assets/images/speedicon.svg" style="height: 30px;">
            <span style="margin-left: 10px !important;">Speed</span>
            <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
            <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
        </a>
    </h4>
</div>
<div id="collapseThree_20" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_20" aria-expanded="true">
<div class="panel-body row mb0">
<div class="row mb0">
<div class="col-md-4">
    <div class="list-group mb0">
        <div class="list-group-item">
            Activity speed                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Activity speed" data-content="<b>Slow</b> — safe speed to do about
									480 likes,
									96 comments,
									360 follows,
									360 unfollows per day
									(the best speed for the beginning).<br/><br/>
									<b>Normal</b> — smart speed to do about
									600 likes,
									168 comments,
									480 follows,
									480 unfollows per day.<br/><br/>
									<b>Fast</b> — supreme speed to do about
									720 likes,
									240 comments,
									600 follows,
									600 unfollows per day.<br/><br/>
									Try to use <b>Slow</b> speed for the beginning and then change it
									to <b>Normal</b> or <b>Fast</b> after several days.">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="speed" class="form-control show-tick activity_speed">
                                                                <option value="1" selected>Slow</option>
                                                                <option value="2" >Normal</option>
                                                                <option value="3" >Fast</option>
                                                            </select>
                                                        </span>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="list-group mb0">
        <div class="list-group-item">
            <div class="ribbon-container">
                <span class="badge custom-ribbon ribbon-bg-advanced">Advanced</span>
            </div>
            Likes / hour                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Likes / hour" data-content="Number of Like actions that your activity will try to post
									in an hour.<br/><br/>
									Recommended value: <b>25</b><br/>
									Allowed values: <b>1</b>-<b>60</b><br/><br/>
									<span class='color-danger'>Use with caution!</span>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="repeat_like" class="form-control show-tick repeat_like abcspeed">
                                                                <option value="1" >1</option>
                                                                <option value="2" >2</option>
                                                                <option value="3" >3</option>
                                                                <option value="4" >4</option>
                                                                <option value="5" >5</option>
                                                                <option value="6" >6</option>
                                                                <option value="7" >7</option>
                                                                <option value="8" >8</option>
                                                                <option value="9" >9</option>
                                                                <option value="10" >10</option>
                                                                <option value="11" >11</option>
                                                                <option value="12" >12</option>
                                                                <option value="13" >13</option>
                                                                <option value="14" >14</option>
                                                                <option value="15" >15</option>
                                                                <option value="16" >16</option>
                                                                <option value="17" >17</option>
                                                                <option value="18" >18</option>
                                                                <option value="19" >19</option>
                                                                <option value="20" selected>20</option>
                                                                <option value="21" >21</option>
                                                                <option value="22" >22</option>
                                                                <option value="23" >23</option>
                                                                <option value="24" >24</option>
                                                                <option value="25" >25</option>
                                                                <option value="26" >26</option>
                                                                <option value="27" >27</option>
                                                                <option value="28" >28</option>
                                                                <option value="29" >29</option>
                                                                <option value="30" >30</option>
                                                                <option value="31" >31</option>
                                                                <option value="32" >32</option>
                                                                <option value="33" >33</option>
                                                                <option value="34" >34</option>
                                                                <option value="35" >35</option>
                                                                <option value="36" >36</option>
                                                                <option value="37" >37</option>
                                                                <option value="38" >38</option>
                                                                <option value="39" >39</option>
                                                                <option value="40" >40</option>
                                                                <option value="41" >41</option>
                                                                <option value="42" >42</option>
                                                                <option value="43" >43</option>
                                                                <option value="44" >44</option>
                                                                <option value="45" >45</option>
                                                                <option value="46" >46</option>
                                                                <option value="47" >47</option>
                                                                <option value="48" >48</option>
                                                                <option value="49" >49</option>
                                                                <option value="50" >50</option>
                                                                <option value="51" >51</option>
                                                                <option value="52" >52</option>
                                                                <option value="53" >53</option>
                                                                <option value="54" >54</option>
                                                                <option value="55" >55</option>
                                                                <option value="56" >56</option>
                                                                <option value="57" >57</option>
                                                                <option value="58" >58</option>
                                                                <option value="59" >59</option>
                                                                <option value="60" >60</option>
                                                            </select>
                                                        </span>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="list-group mb0">
        <div class="list-group-item">
            <div class="ribbon-container">
                <span class="badge custom-ribbon ribbon-bg-advanced">Advanced</span>
            </div>
            Comments / hour                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Comments / hour" data-content="Number of Comment actions that your activity will try to post
									in an hour.<br/><br/>
									Recommended value: <b>7</b><br/>
									Allowed values: <b>1</b>-<b>20</b><br/><br/>
									<span class='color-danger'>Use with caution!</span>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="repeat_comment" class="form-control show-tick repeat_comment abcspeed">
                                                                <option value="1" >1</option>
                                                                <option value="2" >2</option>
                                                                <option value="3" >3</option>
                                                                <option value="4" selected>4</option>
                                                                <option value="5" >5</option>
                                                                <option value="6" >6</option>
                                                                <option value="7" >7</option>
                                                                <option value="8" >8</option>
                                                                <option value="9" >9</option>
                                                                <option value="10" >10</option>
                                                                <option value="11" >11</option>
                                                                <option value="12" >12</option>
                                                                <option value="13" >13</option>
                                                                <option value="14" >14</option>
                                                                <option value="15" >15</option>
                                                                <option value="16" >16</option>
                                                                <option value="17" >17</option>
                                                                <option value="18" >18</option>
                                                                <option value="19" >19</option>
                                                                <option value="20" >20</option>
                                                                <option value="21" >21</option>
                                                                <option value="22" >22</option>
                                                                <option value="23" >23</option>
                                                                <option value="24" >24</option>
                                                                <option value="25" >25</option>
                                                                <option value="26" >26</option>
                                                                <option value="27" >27</option>
                                                                <option value="28" >28</option>
                                                                <option value="29" >29</option>
                                                                <option value="30" >30</option>
                                                                <option value="31" >31</option>
                                                                <option value="32" >32</option>
                                                                <option value="33" >33</option>
                                                                <option value="34" >34</option>
                                                                <option value="35" >35</option>
                                                                <option value="36" >36</option>
                                                                <option value="37" >37</option>
                                                                <option value="38" >38</option>
                                                                <option value="39" >39</option>
                                                                <option value="40" >40</option>
                                                                <option value="41" >41</option>
                                                                <option value="42" >42</option>
                                                                <option value="43" >43</option>
                                                                <option value="44" >44</option>
                                                                <option value="45" >45</option>
                                                                <option value="46" >46</option>
                                                                <option value="47" >47</option>
                                                                <option value="48" >48</option>
                                                                <option value="49" >49</option>
                                                                <option value="50" >50</option>
                                                                <option value="51" >51</option>
                                                                <option value="52" >52</option>
                                                                <option value="53" >53</option>
                                                                <option value="54" >54</option>
                                                                <option value="55" >55</option>
                                                                <option value="56" >56</option>
                                                                <option value="57" >57</option>
                                                                <option value="58" >58</option>
                                                                <option value="59" >59</option>
                                                                <option value="60" >60</option>
                                                            </select>
                                                        </span>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="list-group mb0">
        <div class="list-group-item">
            <div class="ribbon-container">
                <span class="badge custom-ribbon ribbon-bg-advanced">Advanced</span>
            </div>
            Follows / hour                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Follows / hour" data-content="Number of Follow actions that your account will try to perform
									in an hour.<br/><br/>
									Recommended value: <b>20</b><br/>
									Allowed values: <b>1</b>-<b>50</b><br/><br/>
									<span class='color-danger'>Use with caution!</span>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="repeat_follow" class="form-control show-tick repeat_follow abcspeed">
                                                                <option value="1" >1</option>
                                                                <option value="2" >2</option>
                                                                <option value="3" >3</option>
                                                                <option value="4" >4</option>
                                                                <option value="5" >5</option>
                                                                <option value="6" >6</option>
                                                                <option value="7" >7</option>
                                                                <option value="8" >8</option>
                                                                <option value="9" >9</option>
                                                                <option value="10" >10</option>
                                                                <option value="11" >11</option>
                                                                <option value="12" >12</option>
                                                                <option value="13" >13</option>
                                                                <option value="14" >14</option>
                                                                <option value="15" selected>15</option>
                                                                <option value="16" >16</option>
                                                                <option value="17" >17</option>
                                                                <option value="18" >18</option>
                                                                <option value="19" >19</option>
                                                                <option value="20" >20</option>
                                                                <option value="21" >21</option>
                                                                <option value="22" >22</option>
                                                                <option value="23" >23</option>
                                                                <option value="24" >24</option>
                                                                <option value="25" >25</option>
                                                                <option value="26" >26</option>
                                                                <option value="27" >27</option>
                                                                <option value="28" >28</option>
                                                                <option value="29" >29</option>
                                                                <option value="30" >30</option>
                                                                <option value="31" >31</option>
                                                                <option value="32" >32</option>
                                                                <option value="33" >33</option>
                                                                <option value="34" >34</option>
                                                                <option value="35" >35</option>
                                                                <option value="36" >36</option>
                                                                <option value="37" >37</option>
                                                                <option value="38" >38</option>
                                                                <option value="39" >39</option>
                                                                <option value="40" >40</option>
                                                                <option value="41" >41</option>
                                                                <option value="42" >42</option>
                                                                <option value="43" >43</option>
                                                                <option value="44" >44</option>
                                                                <option value="45" >45</option>
                                                                <option value="46" >46</option>
                                                                <option value="47" >47</option>
                                                                <option value="48" >48</option>
                                                                <option value="49" >49</option>
                                                                <option value="50" >50</option>
                                                                <option value="51" >51</option>
                                                                <option value="52" >52</option>
                                                                <option value="53" >53</option>
                                                                <option value="54" >54</option>
                                                                <option value="55" >55</option>
                                                                <option value="56" >56</option>
                                                                <option value="57" >57</option>
                                                                <option value="58" >58</option>
                                                                <option value="59" >59</option>
                                                                <option value="60" >60</option>
                                                            </select>
                                                        </span>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="list-group mb0">
        <div class="list-group-item">
            <div class="ribbon-container">
                <span class="badge custom-ribbon ribbon-bg-advanced">Advanced</span>
            </div>
            Unfollows / hour                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Unfollows / hour" data-content="Number of Unfollow actions that your account will try to perform
									in an hour.<br/><br/>
									Recommended value: <b>20</b><br/>
									Allowed values: <b>1</b>-<b>50</b><br/><br/>
									<span class='color-danger'>Use with caution!</span>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="repeat_unfollow" class="form-control show-tick repeat_unfollow abcspeed">
                                                                <option value="1" >1</option>
                                                                <option value="2" >2</option>
                                                                <option value="3" >3</option>
                                                                <option value="4" >4</option>
                                                                <option value="5" >5</option>
                                                                <option value="6" >6</option>
                                                                <option value="7" >7</option>
                                                                <option value="8" >8</option>
                                                                <option value="9" >9</option>
                                                                <option value="10" >10</option>
                                                                <option value="11" >11</option>
                                                                <option value="12" >12</option>
                                                                <option value="13" >13</option>
                                                                <option value="14" >14</option>
                                                                <option value="15" selected>15</option>
                                                                <option value="16" >16</option>
                                                                <option value="17" >17</option>
                                                                <option value="18" >18</option>
                                                                <option value="19" >19</option>
                                                                <option value="20" >20</option>
                                                                <option value="21" >21</option>
                                                                <option value="22" >22</option>
                                                                <option value="23" >23</option>
                                                                <option value="24" >24</option>
                                                                <option value="25" >25</option>
                                                                <option value="26" >26</option>
                                                                <option value="27" >27</option>
                                                                <option value="28" >28</option>
                                                                <option value="29" >29</option>
                                                                <option value="30" >30</option>
                                                                <option value="31" >31</option>
                                                                <option value="32" >32</option>
                                                                <option value="33" >33</option>
                                                                <option value="34" >34</option>
                                                                <option value="35" >35</option>
                                                                <option value="36" >36</option>
                                                                <option value="37" >37</option>
                                                                <option value="38" >38</option>
                                                                <option value="39" >39</option>
                                                                <option value="40" >40</option>
                                                                <option value="41" >41</option>
                                                                <option value="42" >42</option>
                                                                <option value="43" >43</option>
                                                                <option value="44" >44</option>
                                                                <option value="45" >45</option>
                                                                <option value="46" >46</option>
                                                                <option value="47" >47</option>
                                                                <option value="48" >48</option>
                                                                <option value="49" >49</option>
                                                                <option value="50" >50</option>
                                                                <option value="51" >51</option>
                                                                <option value="52" >52</option>
                                                                <option value="53" >53</option>
                                                                <option value="54" >54</option>
                                                                <option value="55" >55</option>
                                                                <option value="56" >56</option>
                                                                <option value="57" >57</option>
                                                                <option value="58" >58</option>
                                                                <option value="59" >59</option>
                                                                <option value="60" >60</option>
                                                            </select>
                                                        </span>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="list-group mb0">
        <div class="list-group-item">
            <div class="ribbon-container">
                <span class="badge custom-ribbon ribbon-bg-beta">Beta</span>
                <span class="badge custom-ribbon ribbon-bg-advanced">Advanced</span>
            </div>
            Delay range / minutes                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Delay range / minutes')?>" data-content="<?=l("This option controls delay interval between sequential actions.<br/><br/>
								  	The setting is in minutes, so however many minutes you set is what the delay will be for each action.</br></br>
								  	Recommended value: <b>6 minutes</b><br/>
									Allowed values: <b>2</b>-<b>10 minutes</b><br/><br/>
									<span class='color-danger'>Use with caution!</span>")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="delay" class="form-control show-tick repeat_delay abcspeed">
                                                                <option value="1" >1</option>
                                                                <option value="2" >2</option>
                                                                <option value="3" >3</option>
                                                                <option value="4" >4</option>
                                                                <option value="5" >5</option>
                                                                <option value="6" selected>6</option>
                                                                <option value="7" >7</option>
                                                                <option value="8" >8</option>
                                                                <option value="9" >9</option>
                                                                <option value="10" >10</option>
                                                                <option value="11" >11</option>
                                                                <option value="12" >12</option>
                                                                <option value="13" >13</option>
                                                                <option value="14" >14</option>
                                                                <option value="15" >15</option>
                                                                <option value="16" >16</option>
                                                                <option value="17" >17</option>
                                                                <option value="18" >18</option>
                                                                <option value="19" >19</option>
                                                                <option value="20" >20</option>
                                                                <option value="21" >21</option>
                                                                <option value="22" >22</option>
                                                                <option value="23" >23</option>
                                                                <option value="24" >24</option>
                                                                <option value="25" >25</option>
                                                                <option value="26" >26</option>
                                                                <option value="27" >27</option>
                                                                <option value="28" >28</option>
                                                                <option value="29" >29</option>
                                                                <option value="30" >30</option>
                                                                <option value="31" >31</option>
                                                                <option value="32" >32</option>
                                                                <option value="33" >33</option>
                                                                <option value="34" >34</option>
                                                                <option value="35" >35</option>
                                                                <option value="36" >36</option>
                                                                <option value="37" >37</option>
                                                                <option value="38" >38</option>
                                                                <option value="39" >39</option>
                                                                <option value="40" >40</option>
                                                                <option value="41" >41</option>
                                                                <option value="42" >42</option>
                                                                <option value="43" >43</option>
                                                                <option value="44" >44</option>
                                                                <option value="45" >45</option>
                                                                <option value="46" >46</option>
                                                                <option value="47" >47</option>
                                                                <option value="48" >48</option>
                                                                <option value="49" >49</option>
                                                                <option value="50" >50</option>
                                                                <option value="51" >51</option>
                                                                <option value="52" >52</option>
                                                                <option value="53" >53</option>
                                                                <option value="54" >54</option>
                                                                <option value="55" >55</option>
                                                                <option value="56" >56</option>
                                                                <option value="57" >57</option>
                                                                <option value="58" >58</option>
                                                                <option value="59" >59</option>
                                                                <option value="60" >60</option>
                                                            </select>
                                                        </span>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

<div class="panel panel-settings mb20 adjust-space">
    <div class="panel-heading" role="tab" id="headingThree_filter">
        <h4 class="panel-title">
            <a class="activity-settings-cat" role="button" data-toggle="collapse" href="#collapseThree_filter" aria-expanded="true" aria-controls="collapseThree_filter">
                <div class="general-icon general-icon-filters"></div>
                <span>Filters</span>
                <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
            </a>
        </h4>
    </div>
    <div id="collapseThree_filter" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_filter" aria-expanded="true">
        <div class="panel-body row mb0">
            <div class="row mb0">
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Media age                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Media age" data-content="This setting will help you choose the age of media you want to interact with. From the newest one to the oldest.<br/><br/> For example: select <b>1 Day</b> if you want to interact only with media that's not older than one day.<br/><br/>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="filter_media_age" class="form-control">
                                                                <option value="new" >Newest</option>
                                                                <option value="1h" >1 Hour</option>
                                                                <option value="12h" >12 Hours</option>
                                                                <option value="1d" >1 Day</option>
                                                                <option value="3d" selected>3 Days</option>
                                                                <option value="1w" >1 Week</option>
                                                                <option value="2w" >2 Weeks</option>
                                                                <option value="1M" >1 Month</option>
<!--                                                                <option value="" selected>Any</option>-->
                                                            </select>
                                                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Media type                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Media type" data-content="This setting lets you interact only with specific media type: <b>Photos</b> or <b>Videos</b>. Also, you can choose <b>Any</b> to interact with any media type.">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="filter_media_type" class="form-control">
                                                                <option value="" selected>Any</option>
                                                                <option value="image" >Photos</option>
                                                                <option value="video" >Videos</option>
                                                            </select>
                                                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Min. likes filter                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Min. likes filter" data-content="Interact only with media that have minimum set number of amount likes.<br/><br/> Use it along with <b>Max. likes filter</b> to set desired range of media popularity.<br/><br/> Recommended value: 0.<br/><br/> Set to zero to disable this filter.">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_min_likes" value="0">
                                                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Max. likes filter                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Max. likes filter" data-content="Interact only with media that have maximum set number of likes.<br/><br/>Use it along with <b>Min. likes filter</b> to set desired range of media popularity.<br/><br/>Recommended values: 50-100.<br/><br/>Set to zero to disable this filter.">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_max_likes" value="400">
                                                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Min. comments filter                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Min. comments filter" data-content="Interact only with media that have minimum set number of comments.<br/><br/>Use it along with <b>Max. comments filter</b> to set desired range of media popularity.<br/><br/>Recommended value: 0.<br/><br/>Set to zero to disable this filter.">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_min_comments" value="0">
                                                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Max. comments filter                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Max. comments filter" data-content="Interact only with media that have maximum set number of comments.<br/><br/>Use it along with <b>Min. comments filter</b> to set desired range of media popularity.<br/><br/>Recommended values: 20-50.<br/><br/>Set to zero to disable this filter.">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_max_comments" value="25">
                                                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            User relation filter                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="User relation filter" data-content="This filter will help you exclude your own followers/followings from Liking, Commenting and Following activity:<br/><br/><b>Off</b> - Filter is turned off.<br/><br/><b>Followers</b> - You will not interact with your followers and their media.<br/><br/><b>Followings</b> - You will not interact with your followings and their media.<br/><br/><b>Both</b> - You will not interact with your followers and followings and their media.">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="filter_user_relation" class="form-control">
                                                                <option value="" selected>Off</option>
                                                                <option value="followers" >Followers</option>
                                                                <option value="followings" >Followings</option>
                                                                <option value="both" >Both</option>
                                                            </select>
                                                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            User profile filter                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Media age" data-content="This filter will help you avoid inappropriate and unwanted users and their media during your activity:<br/><br/><b>Off</b> - Filter is turned off.<br/><br/><b>Low</b> - Excludes users who have no avatar or have no posted media.<br/><br/><b>Medium</b> - Excludes users who have no avatar, have less than 10 posted media or have no name in the profile.<br/><br/><b>High</b> - Excludes users who have no avatar, have less than 30 posted media, have no name in the profile or have no bio.">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="filter_user_profile" class="form-control">
                                                                <option value="" selected>Off</option>
                                                                <option value="low" >Low</option>
                                                                <option value="medium" >Medium</option>
                                                                <option value="height" >High</option>
                                                            </select>
                                                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Min. followers filter                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Min. followers filter" data-content="Interact only with users that have minimum set number of followers.<br/><br/>Use it along with <b>Max. followers filter</b> to set desired range of users popularity.<br/><br/>Recommended values: 0-50.<br/><br/>Set to zero to disable this filter.">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_min_followers" value="0">
                                                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Max. followers filter                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Max. followers filter" data-content="Interact only with users that have maximum set number of followers.<br/><br/>Use it along with <b>Min. followers filter</b> to set desired range of users popularity.<br/><br/>Recommended values: 500-1000.<br/><br/>Set to zero to disable this filter.">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_max_followers" value="0">
                                                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Min. followings filter                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Min. followings filter" data-content="Interact only with users that have minimum set number of followings.<br/><br/>Use it along with <b>Max. followings filter</b> to set desired range of users popularity.<br/><br/>Recommended values: 50-100.<br/><br/>Set to zero to disable this filter.">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_min_followings" value="0">
                                                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            Max. followings filter                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Max. followings filter" data-content="Interact only with users that have maximum set number of followings.<br/><br/>Use it along with <b>Min. followings filter</b> to set desired range of users popularity.<br/><br/>Recommended values: 300-500.<br/><br/>Set to zero to disable this filter.">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_max_followings" value="0">
                                                        </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            <div class="ribbon-container">
                                <span class="badge custom-ribbon ribbon-bg-beta">Beta</span>
                                <span class="badge custom-ribbon ribbon-bg-advanced">Advanced</span>
                            </div>
                            Gender filter                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Media age" data-content="<b>Off</b> - Filter is turned off.<br/><br/><b>Female</b> - Interact only with users and their media whose gender has been determined as female.<br/><br/><b>Male</b> - Interact only with users and their media whose gender has been determined as male.<br/><br/><span class='col-blue'>INFO:</span> This filter analyzes full names of the user profiles and cannot guarantee 100% accuracy.<br/><br/><span class='col-orange'>WARNING:</span> This filter can slow down or completely stop your activity if the system will not be able to find accounts based on the selected option.">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="filter_gender" class="form-control pull-right">
                                                                <option value="" selected>Off</option>
                                                                <option value="f" >Female</option>
                                                                <option value="m" >Male</option>
                                                            </select>
                                                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-settings mb20 adjust-space">
    <div class="panel-heading" role="tab" id="headingThree_comment">
        <h4 class="panel-title">
            <a class="activity-settings-cat" role="button" data-toggle="collapse" href="#collapseThree_comment" aria-expanded="false" aria-controls="collapseThree_comment">
                <div class="general-icon general-icon-comment"></div>
                <span>Comment</span>
                <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
            </a>
        </h4>
    </div>

    <div id="collapseThree_comment" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_comment" aria-expanded="true">
        <div class="panel-body row mb0">
            <div class="vttags list-comments">
                <label style="padding-right: 1.5em;">
                    Comments <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Comments" data-content="Add at least one comment
								  	if you have <b>Comments</b> turned on in Activity section.<br/><br/>

									For each post a new comment will be randomly selected from this list.
									IGplan will not comment on same media more than once.<br/><br/>

									We recommend using at least 10 different
									neutral comments like: Nice, Like it, Beautiful, etc.<br/><br/>

									<ul><li> The total length of the comment cannot exceed 300 characters.</li>
									<li>Enter variety of comments, so they are all different.</li></ul>

									You can add up to 100 comments.">?</span>
                </label>
                <div id="comments">
                    <div class="item" data-tag=" Made my day">
                        Made my day                                                        <input type="hidden" name="comments[]" value=" Made my day">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="Totally rocks!">
                        Totally rocks!                                                        <input type="hidden" name="comments[]" value="Totally rocks!">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="Very nice">
                        Very nice                                                        <input type="hidden" name="comments[]" value="Very nice">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="Very sweet :)">
                        Very sweet :)                                                        <input type="hidden" name="comments[]" value="Very sweet :)">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="This is great">
                        This is great                                                        <input type="hidden" name="comments[]" value="This is great">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="So cool">
                        So cool                                                        <input type="hidden" name="comments[]" value="So cool">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="Fascinating one">
                        Fascinating one                                                        <input type="hidden" name="comments[]" value="Fascinating one">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="Neat-o!">
                        Neat-o!                                                        <input type="hidden" name="comments[]" value="Neat-o!">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="Gorgeous! Love it!">
                        Gorgeous! Love it!                                                        <input type="hidden" name="comments[]" value="Gorgeous! Love it!">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="The cutest :grinning:">
                        The cutest :grinning:                                                        <input type="hidden" name="comments[]" value="The cutest :grinning:">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="Breathtaking one">
                        Breathtaking one                                                        <input type="hidden" name="comments[]" value="Breathtaking one">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="This is awesome :)">
                        This is awesome :)                                                        <input type="hidden" name="comments[]" value="This is awesome :)">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="Outstanding one!">
                        Outstanding one!                                                        <input type="hidden" name="comments[]" value="Outstanding one!">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="Whoopee!">
                        Whoopee!                                                        <input type="hidden" name="comments[]" value="Whoopee!">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="My Goodness!">
                        My Goodness!                                                        <input type="hidden" name="comments[]" value="My Goodness!">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="This is awesome!">
                        This is awesome!                                                        <input type="hidden" name="comments[]" value="This is awesome!">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                </div>
                <div class="btn-group m-b-20 actionAddComments" role="group">
                    <button type="button" class="tags-btn btn-plain btnOpenAddComments">Add</button>
                    <button type="button" class="tags-btn btn-plain dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem">Delete all</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-settings mb20">
    <div class="panel-heading" role="tab" id="headingOne_unfollow">
        <h4 class="panel-title">
            <a class="activity-settings-cat" role="button" data-toggle="collapse" href="#collapseOne_unfollow" aria-expanded="true" aria-controls="collapseOne_unfollow">
                <div class="general-icon general-icon-unfollow"></div>
                <span>Unfollow</span>
                <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
            </a>
        </h4>
    </div>
    <div id="collapseOne_unfollow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19" aria-expanded="true">
        <div class="panel-body row mb0">
            <div class="row mb0">
                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            <i  aria-hidden="true"></i> Unfollow source                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Unfollow source" data-content="Which users to unfollow?<br/><br/> <b>IGplan</b> - select this option if you want to unfollow only users that were followed by our service. This option should be used in most cases, especially if you use Follow and Unfollow actions at the same time.<br/><br/> <b>All</b> - select this option if you want to unfollow all users that you follow.">?
                                                        </span>

                                                        <span class="badge bg-none">
                                                            <select name="enable_unfollow_source" class="form-control show-tick">
                                                                <option value="1" selected>All</option>
                                                                <option value="2" >IGplan
                                                                </option>

                                                            </select>
                                                        </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="list-group mb0">
                        <div class="list-group-item">
                            <i  aria-hidden="true"></i> Timer                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Timer" data-content="This function will help you unfollow your activity automatically for specified period of time. <br/><br/>For example, If you select <b>24 hours</b> and <b>IGPlan</b> from <b>Unfollow source</b>, the software will unfollow people software followed after <b>24 hours </b>of following.">?
                                                        </span>

                                                        <span class="badge bg-none">
                                                            <select name="unfollow_follow_age" class="form-control">
                                                                <option value="0" selected>Default</option>
                                                                <option value="43200" >12 Hours</option>
                                                                <option value="86400" >24 Hours</option>
                                                                <option value="172800" >48 Hours</option>
                                                                <option value="259200" >72 Hours</option>
                                                            </select>
                                                        </span>
                        </div>
                    </div>
                </div>
                <!--
                    <div class="col-md-4">
                        <div class="list-group mb0">
                            <div class="list-group-item" style="position: relative;z-index: 1;">
                                <i  aria-hidden="true"></i> Don't unfollow my followers															<span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Don't unfollow my followers" data-content="When turning on this box you will not unfollow users who follow you back.">?
                                </span>
                                <span class="badge bg-none">
                                    <div>
                                        <label>
                                            <input type="checkbox" class="chk-custom" name="enable_unfollow_followers" >
                                            <span class="chk-custom"></span>
                                        </label>
                                    </div>
                                </span>

                            </div>
                        </div>
                    </div>-->
            </div>
        </div>
    </div>
</div>

<div class="panel panel-settings mb20 adjust-space">
    <div class="panel-heading" role="tab" id="headingThree_19">
        <h4 class="panel-title">
            <a class="activity-settings-cat" role="button" data-toggle="collapse" href="#collapseThree_19" aria-expanded="false" aria-controls="collapseThree_19">
<!--                <div class="general-icon general-icon-tags"></div>-->
<!--                <i class="fa fa-hashtag" style="font-size: 30px;"></i>-->
                <img src="<?=BASE?>assets/images/hashicon.svg" style="height: 30px;">
                <span style="margin-left: 10px !important;">Hashtags</span>
                <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
            </a>
        </h4>
    </div>
    <div id="collapseThree_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_19" aria-expanded="true">
        <div class="panel-body row mb0">
            <div class="vttags list-tags">
                <label style="padding-right: 1.5em;">
                    Hashtags <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Hashtags" data-content="Add at least one tag to get media from,
								  	if you are using <b>Hashtags</b> as your Media source.<br/><br/>

								  	You can search tags or you can add multiple tags by clicking Add Multi Hashtags link.<br/><br/>

								  	You can add up to 1000 tags.">?</span>
                </label>
                <div id="NewTags">
                    <div class="item" data-tag="author">
                        author                                                    <input type="hidden" name="tags[]" value="author">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="vacation">
                        vacation                                                    <input type="hidden" name="tags[]" value="vacation">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="instaart">
                        instaart                                                    <input type="hidden" name="tags[]" value="instaart">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="nature">
                        nature                                                    <input type="hidden" name="tags[]" value="nature">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="tasty">
                        tasty                                                    <input type="hidden" name="tags[]" value="tasty">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="masterpiece">
                        masterpiece                                                    <input type="hidden" name="tags[]" value="masterpiece">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="creative">
                        creative                                                    <input type="hidden" name="tags[]" value="creative">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="bestoftheday">
                        bestoftheday                                                    <input type="hidden" name="tags[]" value="bestoftheday">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="pretty">
                        pretty                                                    <input type="hidden" name="tags[]" value="pretty">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="siblings">
                        siblings                                                    <input type="hidden" name="tags[]" value="siblings">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="clouds">
                        clouds                                                    <input type="hidden" name="tags[]" value="clouds">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="page">
                        page                                                    <input type="hidden" name="tags[]" value="page">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="throwbackthursday">
                        throwbackthursday                                                    <input type="hidden" name="tags[]" value="throwbackthursday">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="cuddle">
                        cuddle                                                    <input type="hidden" name="tags[]" value="cuddle">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="instafollow">
                        instafollow                                                    <input type="hidden" name="tags[]" value="instafollow">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="lovely">
                        lovely                                                    <input type="hidden" name="tags[]" value="lovely">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="shoutout">
                        shoutout                                                    <input type="hidden" name="tags[]" value="shoutout">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="cute">
                        cute                                                    <input type="hidden" name="tags[]" value="cute">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                    <div class="item" data-tag="draw">
                        draw                                                    <input type="hidden" name="tags[]" value="draw">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                </div>
                <div class="btn-group m-b-20 actionAddTags" role="group">
                    <button type="button" class="tags-btn btn-plain btnOpenAddTags" data-id="18">Add</button>
                    <button type="button" class="tags-btn btn-plain dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem">Delete all</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-settings mb20">
    <div class="panel-heading" role="tab" id="headingThree_11">
        <h4 class="panel-title">
            <a class="activity-settings-cat" role="button" data-toggle="collapse" href="#collapseThree_11" aria-expanded="false" aria-controls="collapseThree_11">
                <div class="general-icon general-icon-locations"></div>
                <span>Locations</span>
                <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
            </a>
        </h4>
    </div>
    <div id="collapseThree_11" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_11" aria-expanded="true">
        <div class="panel-body row mb0">
            <div class="vttags list-locations">
                <label style="padding-right: 1.5em;">
                    Locations <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Locations" data-content="Add at least one location to get media from
									if you are using <b>Locations</b> as your Media source.<br/><br/>

									You can like and comment on media posted in that place
									or follow people who post media in that location. Please
									note that sharing your geolocation must be enabled in
									your browser to use this feature.<br/><br/>

									You can add up to 100 locations.">?</span>
                </label>
                <div class="btn-group m-b-20 actionAddLocations" role="group">
                    <button type="button" class="tags-btn btn-plain btnOpenAddLocations">Add</button>
                    <button type="button" class="tags-btn btn-plain dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem">Delete all locations</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-settings mb20">
    <div class="panel-heading" role="tab" id="headingThree_33">
        <h4 class="panel-title">
            <a class="activity-settings-cat" role="button" data-toggle="collapse" href="#collapseThree_33" aria-expanded="false" aria-controls="collapseThree_33">
                <div class="general-icon general-icon-usernames"></div>
                <span>Usernames</span>
                <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
            </a>
        </h4>
    </div>
    <div id="collapseThree_33" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_33" aria-expanded="true">
        <div class="panel-body row mb0">
            <div class="vttags list-usernames">
                <label style="padding-right: 1.5em;">
                    Usernames <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Usernames" data-content="
									Add at least one username
									if you are using <b>Followers/Followings of usernames</b>
									as your Media or Follow source.<br/><br/>

									IGplan will use followers or followings of those usernames
									to follow them and/or choose up to 5 recently posted media from
									each account for automatic likes and comments.<br/><br/>

									You can add up to 100 usernames.
								  ">?</span>
                </label>
                <div class="btn-group m-b-20 actionAddUsernames" role="group">
                    <button type="button" class="tags-btn btn-plain btnOpenAddUsernames">Add</button>
                    <button type="button" class="tags-btn btn-plain dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem">Delete all usernames</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-settings mb20">
    <div class="panel-heading" role="tab" id="headingThree_message">
        <h4 class="panel-title">
            <a class="activity-settings-cat custom-icon-manage" role="button" data-toggle="collapse" href="#collapseThree_message" aria-expanded="true" aria-controls="collapseThree_message">
                <i class="fa fa-envelope-o font-32 m-r--35" aria-hidden="true"></i>
                <!--                                            <div class="general-icon general-icon-blacklists"></div>-->
                <span>Message DM</span>
                <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
            </a>
        </h4>
    </div>
    <div id="collapseThree_message" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_message" aria-expanded="true">
        <div class="panel-body row mb0">
            <div class="vttags list-messages">
                <label style="padding-right: 1.5em;">
                    Message <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Welcome DM" data-content="Please have at least one of the following settings selected for your Welcome DM to work properly: Likes, Comments or Follows.">?</span>
                </label>
                <div id="Messages">
                    <div class="item" data-tag="draw">
                        Thank you for following me:)                                                    <input type="hidden" name="messages[]" value="Thank you for following me:)">
                        <div class="icon-remove btnRemoveTag">x</div>
                        <div class="icon-tag"></div>
                    </div>
                </div>
                <div class="btn-group m-b-20 actionAddMessages" role="group">
                    <button type="button" class="tags-btn btn-plain btnOpenAddMessages">Add</button>
                    <button type="button" class="tags-btn btn-plain dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem">Delete all</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-settings mb20">
    <div class="panel-heading" role="tab" id="headingThree_blacklists">
        <h4 class="panel-title">
            <a class="activity-settings-cat"  role="button" data-toggle="collapse" href="#collapseThree_blacklists" aria-expanded="true" aria-controls="collapseThree_blacklists">
                <div class="general-icon general-icon-blacklists"></div>
                <span>Blacklists</span>
                <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
            </a>
        </h4>
    </div>
    <div id="collapseThree_blacklists" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_blacklists" aria-expanded="true">
        <!-- tags -->
        <div class="panel-body row mb0">
            <div class="vttags blacklist-tags">
                <label style="padding-right: 1.5em;">
                    Hashtags blacklist <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Hashtags blacklist" data-content="Add some tags to this list if you want to skip liking and/or commenting on media containing those tags in bio or caption.<br/><br/> You can add up to 3000 tags in this list.">?</span>
                </label>
                                            <span class="tags-row" id="BlackTags">
<!--                                                                                                <div class="item" data-blacklist_tags="sex">-->
<!--                                                                                                    sex                                                    <input type="hidden" name="blacklist_tags[]" value="sex">-->
<!--                                                                                                    <div class="icon-remove btnRemoveTag">x</div>-->
<!--                                                                                                </div>-->
<!--                                                                                                <div class="item" data-blacklist_tags="xxx">-->
<!--                                                                                                    xxx                                                    <input type="hidden" name="blacklist_tags[]" value="xxx">-->
<!--                                                                                                    <div class="icon-remove btnRemoveTag">x</div>-->
<!--                                                                                                </div>-->
<!--                                                                                                <div class="item" data-blacklist_tags="fuckyou">-->
<!--                                                                                                    fuckyou                                                    <input type="hidden" name="blacklist_tags[]" value="fuckyou">-->
<!--                                                                                                    <div class="icon-remove btnRemoveTag">x</div>-->
<!--                                                                                                </div>-->
<!--                                                                                                <div class="item" data-blacklist_tags="videoxxx">-->
<!--                                                                                                    videoxxx                                                    <input type="hidden" name="blacklist_tags[]" value="videoxxx">-->
<!--                                                                                                    <div class="icon-remove btnRemoveTag">x</div>-->
<!--                                                                                                </div>-->
<!--                                                                                                <div class="item" data-blacklist_tags="nude">-->
<!--                                                                                                    nude                                                    <input type="hidden" name="blacklist_tags[]" value="nude">-->
<!--                                                                                                    <div class="icon-remove btnRemoveTag">x</div>-->
<!--                                                                                                </div>-->
                                                                                            </span>

                <div class="btn-group m-b-20 actionAddBlacklistTags" role="group">
                    <button type="button" class="tags-btn btn-plain btnOpenAddBlacklistTags">Add</button>
                    <button type="button" class="tags-btn btn-plain dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem">Delete all</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- usernames -->
        <div class="panel-body row mb0">
            <div class="vttags blacklist-usernames">
                <label style="padding-right: 1.5em;">
                    <i  aria-hidden="true"></i> Usernames blacklist <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Usernames blacklist" data-content="Add some usernames to this list if you want to skip following followers of these profiles, and liking and/or commenting on media from these profiles.<br/><br/> You can add up to 3000 usernames in this list.">?</span>
                </label>
                <div id="BlackUser"></div>
                <div class="btn-group m-b-20 actionAddBlacklistUsernames" role="group">
                    <button type="button" class="tags-btn btn-plain btnOpenAddBlacklistUsernames">Add</button>
                    <button type="button" class="tags-btn btn-plain dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem">Delete all</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- keyword -->
        <div class="panel-body row mb0">
            <div class="vttags blacklist-keywords">
                <label style="padding-right: 1.5em;">
                    <i  aria-hidden="true"></i> Keywords blacklist <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Keywords blacklist" data-content="Add some keywords to this list that you don't want to interact with. This filter will search for stop keywords in media (tags and caption) and in user (username, full name, bio and website).<br/><br/>&quot;For example&quot; add playboy keyword to exclude all content that contains any words that start with playboy.<br/><br/>You can add up to 3000 keywords in this list.">?</span>
                </label>
                <div id="BlackKey">
<!--                    <div class="item" data-blacklist_keywords="nude">-->
<!--                        nude                                                    <input type="hidden" name="blacklist_keywords[]" value="nude">-->
<!--                        <div class="icon-remove btnRemoveTag">x</div>-->
<!--                        <div class="icon-tag"></div>-->
<!--                    </div>-->
<!--                    <div class="item" data-blacklist_keywords="sex">-->
<!--                        sex                                                    <input type="hidden" name="blacklist_keywords[]" value="sex">-->
<!--                        <div class="icon-remove btnRemoveTag">x</div>-->
<!--                        <div class="icon-tag"></div>-->
<!--                    </div>-->
<!--                    <div class="item" data-blacklist_keywords="fuck now">-->
<!--                        fuck now                                                    <input type="hidden" name="blacklist_keywords[]" value="fuck now">-->
<!--                        <div class="icon-remove btnRemoveTag">x</div>-->
<!--                        <div class="icon-tag"></div>-->
<!--                    </div>-->
                </div>
                <div class="btn-group m-b-20 actionAddBlacklistKeywords" role="group">
                    <button type="button" class="tags-btn btn-plain btnOpenAddBlacklistKeywords">Add</button>
                    <button type="button" class="tags-btn btn-plain waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem">Delete all</a></li>
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
</form>
</div>

<script type="text/javascript">
    /*$(function(){
     hash = window.location.hash;
     if(hash != undefined && hash == "#openvideo"){
     $( "#modal-how-to-use" ).modal('show').find(".modal-body").html('<iframe width="100%" height="315" src="https://player.vimeo.com/video/213740386?rel=0&autoplay=1&showinfo=0&controls=0" frameborder="0" allowfullscreen style="display: block;"></iframe>');
     }


     $(".btnCloseModelHowToUse,.close").click(function(){
     $('#modal-how-to-use').modal('toggle');
     $('iframe').remove();
     window.location.hash = "";
     });

     });*/
</script>
</div>
</section>
<!--<div class="footer">-->
<!--    <div class="container wide">-->
<!--        <div class="row">-->
<!--            <div class="col-md-9 coptright">--><?//=l('2017 © Software. All rights reserved.')?><!--</div>-->
<!--            <div class="col-md-3 text-right social">-->
<!--            --><!--              <a href="--><?//=FACEBOOK_PAGE?><!--">-->
<!--                <img src="--><?//=BASE?><!--assets/images/facebook.png" alt="Share this with Facebook" class="social-icons">-->
<!--              </a>-->
<!--              <a href="--><?//=TWITTER_PAGE?><!--">-->
<!--                <img src="--><?//=BASE?><!--assets/images/twitter.png" alt="Share this with Twitter" class="social-icons"> -->
<!--              </a>-->
<!--              <a href="--><?//=PINTEREST_PAGE?><!--">-->
<!--                <img src="--><?//=BASE?><!--assets/images/pinterest.png" alt="Share this with Pinterest" class="social-icons">-->
<!--              </a>-->
<!--              <a href="--><?//=INSTAGRAM_PAGE?><!--">-->
<!--                <img src="--><?//=BASE?><!--assets/images/instagram.png" alt="Share this with Instagram" class="social-icons">-->
<!--              </a>-->
<!--            --><!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--<section class="footer_bg">-->
<!--<div class="container-fluid" style="background: #000;">-->
<!--    <div class="container-fluid">-->
<!--        <p style="font-size:14px; color:#fff; display:block;">© 2018  All rights reserved. </p>-->
<!--        <ul class="footer_link">-->
<!--            <li><a href="#">About Us</a></li>-->
<!--            <li><a href="#">Terms</a></li>-->
<!--            <li><a href="#">Privacy</a></li>-->
<!--        </ul>-->
<!--        <div>-->
<!-- </div>-->
<!--        </section>-->
<!-- Add new account -->
<div class="modal fade" id="modal-add-account" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="card">
                <div class="body account-pop-up custom-popup">
                    <div class="row">
                        <div class="col-sm-12 mb0">
                            <h3>Account Connect</h3>
                        </div>
                        <div class="col-sm-12 mb0">
                            <div class="bootstrap-alert bootstrap-alert-success" role="alert">
                                <strong>Your account security is very important to us!</strong><br />
                                We will not store your password after this connection process.<br />
                                The password is required to establish a connection with Instagram. Please visit our <a href="#" class="alert-link">Help Center</a> before you start.
                            </div>
                            <div class="bootstrap-alert bootstrap-alert-pending verification-code-alert hidden" role="alert">
                            </div>
                            <form action="<?=BASE?>index.php/instagram_accounts/ajax_update" data-redirect="<?=BASE?>index.php/activity/">
                                <div class="form-group username-input">
                                    <div class="form-line">
                                        <input type="hidden" class="form-control" name="id" value="18">
                                        <input type="hidden" name="proxy" value="0">
                                        <input type="text" class="form-control" name="username" placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group password-input">
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group verification-code-input hidden">
                                    <div class="form-line input-group">

                                        <input type="password" name="code" id="verification-code" placeholder="Security code" class="form-control">
                                    <span class="input-group-addon">
										<i data-original-title="Show Password" data-placement="bottom" data-container="body" class="fa fa-key tooltips" onmouseover="mouseoverPass('verification-code');" onmouseout="mouseoutPass('verification-code');"></i>
									</span>
                                    </div>
                                </div>

                                <!--                            <b>--><?//=l('Code')?><!--</b>-->
                                <!--                            <div class="form-group">-->
                                <!--                                <div class="form-line">-->
                                <!--                                    <input type="text" class="form-control" name="code" placeholder="verification code">-->
                                <!--                                </div>-->
                                <!--                            </div>-->

                                <!--                            <button type="submit" id="addaccountbtn" class="btn bg-red waves-effect btnIGAccountUpdate">--><?//=l('Submit')?><!--</button>-->
                                <button type="submit" id="addaccountbtn" class="btn btn-dashboard bg-dashboard-success-new rounded-corner btnIGAccountUpdate text-transform-none m-t-5">Connect</button>

                            </form>
                            <div class="m-t-15 m-b-15">
                                Unable to connect an account? <a href="javascript:void(0);" class="alert-link dotted-underline" data-toggle="modal" data-target="#modal-connect-help">Account connect help</a> <span class="label label-warning-custom">New</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<!-- Connect help -->
<div class="modal fade" id="modal-connect-help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="background-color: #0009;">
    <div class="modal-dialog account-connect-help" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="body account-pop-up custom-popup">
                    <div class="row">
                        <div class="col-sm-12 mb0">
                            <h3>Account Connect Help</h3>
                            <a href="#" class="btn-close-x" data-dismiss="modal" aria-label="Close"></a>
                        </div>
                        <div class="col-sm-12 mb0">
                            <div class="mb20">
                                <p>Find the specific error you're receiving and learn how to fix it.</p>

                                <ul class="nice-list">
                                    <li>
                                        <p><strong>Incorrect username</strong></p>
                                        <p>You have entered the incorrect Instagram username.</p>
                                        <p>
                                            Remember, do not enter your My Secret Bot login email here, but
                                            your Instagram username.
                                        </p>
                                        <p>Try looking up the username on Instagram to ensure it exists.</p>
                                    </li>
                                    <li>
                                        <p><strong>Incorrect password for &lt;username&gt;</strong></p>
                                        <p>You have entered the incorrect Instagram password.</p>
                                        <p>
                                            Please note:
                                        </p><ul>
                                            <li>This field is case sensitive;</li>
                                            <li>
                                                Some devices automatically make the first letter uppercase, even in
                                                the password field;
                                            </li>
                                            <li>
                                                Make sure you’re not accidentally copy and pasting a space or
                                                a line break.
                                            </li>
                                        </ul>
                                        <p></p>
                                        <p>Try logging in to Instagram to see if the password is correct.</p>
                                    </li>
                                    <li>
                                        <p><strong>Verify your account</strong> <span class="label label-warning-custom">New</span></p>
                                        <p>
                                            Instagram is trying to protect your account, so there’s no need to worry.
                                            You simply need to complete this verification step.
                                        </p>
                                        <p>
                                            Instagram will send you a security code to the email address or mobile
                                            phone number associated with your Instagram account (not your My Secret Bot email).
                                        </p>
                                        <p>
                                            You need to enter the code to complete the verification step. Please enter the
                                            code as soon as you receive it, as it will expire in a short period of time.
                                        </p>
                                    </li>
                                    <li>
                                        <p><strong>Verification loop</strong> <span class="label label-warning-custom">New</span></p>
                                        <p>
                                            If you tried to verify your account and were returned to the login stage again,
                                            you may be stuck in a verification loop from Instagram. Note: This is not
                                            an error from My Secret Bot.
                                        </p>
                                        <p>
                                            Here’s what you can do to try to resolve the issue:
                                        </p><ol>
                                            <li>First, use the Force Connection Reset option, and try to verify again;</li>
                                            <li>
                                                If you’re still returned to the login stage, try to reset your
                                                Instagram password.
                                            </li>
                                        </ol>
                                        <p></p>
                                        <p>
                                            If you’re still stuck in the loop after trying these fixes, please wait
                                            1-2 days before you try again.
                                        </p>
                                    </li>
                                    <li>
                                        <p><strong>Two-factor authentication</strong></p>
                                        <p>
                                            You have two-factor authentication enabled on your Instagram account.
                                            Instagram will send you a security code to the mobile phone number
                                            associated with your Instagram account. If you’ve forgotten your
                                            mobile number associated with your Instagram account, just check
                                            your settings on the Instagram app.
                                        </p>
                                        <p>
                                            You need to enter the code to complete the second authentication step.
                                            Please enter the code as soon as you receive it, as it will expire in
                                            a short period of time.
                                        </p>
                                    </li>
                                    <li>
                                        <p><strong>Other errors</strong></p>
                                        <p><b>Password reset</b></p>
                                        <p>
                                            Instagram may sometimes reset your password when you're trying to
                                            login on third-party websites.  Go to your email (associated with
                                            your Instagram account) and check your inbox/spam folders for a
                                            message from Instagram with a password reset link.
                                        </p>
                                        <p>
                                            Note: This link may expire after some time, so please use it as soon
                                            as possible. If the link is sent more than once, make sure you use
                                            the last link that was sent (and not the old one).
                                        </p>
                                        <p><b>Connection Error &amp; Request Failed</b></p>
                                        <p>
                                            The proxy used for your account is momentarily not working. Our
                                            system will automatically fix these errors, but it may take some time.
                                        </p>
                                        <p>
                                            Here’s what you can do:
                                        </p><ol>
                                            <li>Wait 1-2 hours for the proxy to repair on its own;</li>
                                            <li>Try the Force Connection Reset option.</li>
                                        </ol>
                                        <p></p>
                                        <p><b>Unexpected login error</b> <span class="label label-warning-custom">New</span></p>
                                        <p>
                                            This type of errors is a rare one, but sometimes you may see it for some
                                            accounts. If you face this error, then there are two possible issues:
                                        </p><ol>
                                            <li>It's Instagram temporarily down and you just need to repeat after a while;</li>
                                            <li>
                                                It's something wrong with the account itself and you need to try
                                                to login directly on Instagram website to find what is going on.
                                                In most cases it's Instagram requires some special sort of
                                                additional verification.
                                            </li>
                                        </ol>
                                        <p></p>
                                    </li>
                                </ul>

                                <p>
                                    Please
                                    <a href="javscript:void(0);" class="alert-link dotted-underline">contact&nbsp;us</a>
                                    if any of these errors persists for more than 24 hours.
                                </p>
                            </div>
                            <div class="text-align-center">
                                <button data-dismiss="modal" aria-label="Close" class="btn btn-dashboard bg-dashboard-default rounded-corner text-transform-none m-t-5">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Save-->
<div class="modal fade" id="modal-how-to-use" style="background-color: #0009;" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">How to use</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-red btnCloseModelHowToUse">I understand and close it</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Save-->
<div class="modal fade" id="modal-save" style="background-color: #0009;" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Title</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control save_title"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-modal-save"><i class="fa fa-floppy-o" aria-hidden="true"></i> save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" style="background-color: #0009;" id="modal-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Title</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control category_title"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-modal-add-category"><i class="fa fa-floppy-o" aria-hidden="true"></i> Add new</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" style="background-color: #0009;" id="PopupAddComments" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="defaultModalLabel">Add Comments</h4>
            </div>
            <div class="modal-body pt0">
                <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                    Add multiple comments at the same time by using comma as delimiter.
                </p>
                <div class="form-group">
                    <div class="form-line box_popup_comments p15">
                        <textarea rows="4" class="form-control no-resize popup_list_comments" placeholder="Comments"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn new-blue waves-effect btnAddComnents" style="display:none;text-transform: none !important;">Add Comments</button>
                <button type="button" class="btn bg-grey waves-effect closebtn2" data-dismiss="modal" style="text-transform: none !important;">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".popup_list_comments").emojioneArea({
            hideSource: true,
            useSprite: false,
            pickerPosition    : "bottom",
            filtersPosition   : "bottom"
        });
    });
</script>


<div class="modal fade" style="background-color: #0009;" id="PopupAddTags" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="defaultModalLabel">Add Hashtags</h4>
            </div>
            <div class="modal-body pt0">
                <!-- Nav tabs -->
<!--                <ul class="nav nav-tabs tab-nav-right" role="tablist">-->
<!--                    <li role="presentation" class="active"><a href="#home" data-toggle="tab" aria-expanded="false">Search Hashtag </a></li>-->
<!--                    <li role="presentation" class=""><a href="#profile" data-toggle="tab" aria-expanded="true">Add Multi Hashtags</a></li>-->
<!--                </ul>-->

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="home">
                        <div class="input-group mb0 formSearchPopup">
<!--                            <span class="input-group-btn">-->
<!--                              <select name="account" class="form-control account" style="min-width: 120px;">-->
<!--                                  <option value="1">username</option>-->
<!--                              </select>-->
<!--                            </span>-->
                            <div class="form-line newinput">
                                <input type="text" name="popup_tag" class="form-control popup_tag" placeholder="Hashtag">
                            </div>
                            <span class="input-group-btn">
                              <a class="btn bg-dashboard-primary waves-effect btnSearchTags newbutton">Search</a>
                            </span>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="ajax_dataSearchTag">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" align="center" style="margin-top: 20px;">
                                <!--                                <a href="#home" data-toggle="tab" aria-expanded="false">--><?//=l('Search Hashtag')?><!-- </a>-->
                                <a href="#profile" data-toggle="tab" aria-expanded="true" style="border-bottom: 1px dashed;"><?=l('Add Multi Hashtags')?>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile">
                        <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                            Add multiple hashtags at the same time by using comma as delimiter.
                        </p>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="4" class="form-control no-resize popup_list_tags" placeholder="Hashtags"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" align="center" style="margin-top: 20px;">
                                <a href="#home" data-toggle="tab" aria-expanded="false" style="border-bottom: 1px dashed;"><?=l('Search Hashtag')?> </a>
                                <!--                                <a href="#profile" data-toggle="tab" aria-expanded="true">--><?//=l('Add Multi Hashtags')?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn new-blue waves-effect btnAddTags" style="display: none;text-transform: none !important;">Add Hashtags</button>
                <button type="button" class="btn bg-grey waves-effect closebtn1" data-dismiss="modal" style="text-transform: none !important;">Close</button>
            </div>
        </div>
    </div>
</div>

<!--<div class="modal fade" id="PopupAddTags" tabindex="-1" role="dialog">-->
<!--<div class="modal-dialog" role="document">-->
<!--<div class="modal-content">-->
<!--<div class="modal-header bg-grey">-->
<!--<h4 class="modal-title" id="defaultModalLabel">Add Usernames</h4>-->
<!--</div>-->
<!--<div class="modal-body pt0">-->
<!--<div class="tab-content">-->
<!--<div role="tabpanel" class="tab-pane fade active in" id="profile">-->
<!--<div class="form-group">-->
<!--<div class="form-line">-->
<!--<textarea rows="4" class="form-control no-resize popup_list_tags" placeholder="usernameA,usernameB,usernameC,..."></textarea>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--<div class="modal-footer" style="background: #F5F5F5;">-->
<!--<button type="button" class="btn new-blue waves-effect btnAddUsernames">Add Usernames</button>-->
<!--<button type="button" class="btn bg-grey waves-effect" data-dismiss="modal">Close</button>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->

<div class="modal fade" style="background-color: #0009;" id="PopupAddLocations" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form class="location">
            <div class="modal-content">
                <div class="modal-header new-grey">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="defaultModalLabel">Add Locations</h4>
                </div>
                <div class="modal-body pt0">
                    <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                        Find locations by name, address, city, state or country and get the most popular places nearby. Or just click on the map to start exploring locations on the current map position.
                    </p>

                    <div class="input-group mb15 formSearchPopup">
<!--                        <span class="input-group-btn">-->
<!--                          <select name="account" class="form-control account" style="min-width: 120px;">-->
<!---->
<!--                              <option value="1">username</option>-->
<!---->
<!--                          </select>-->
<!--                        </span>-->
                        <div class="form-line newinput">
                            <input type="text" id="pac-input" name="popup_location" class="form-control popup_location" placeholder="Enter location name">
                        </div>
                        <span class="input-group-btn">
                          <a class="btn bg-dashboard-primary waves-effect btnSearchLocations newbutton" >Search</a>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="map_canvas" style="width: 100%; height: 250px;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input name="formatted_address" type="hidden" value="">
                            <input name="lat" type="hidden" value="">
                            <input name="lng" type="hidden" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ajax_dataSearchLocation">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn new-blue waves-effect btnAddLocations" style="display: none;text-transform: none !important;">Add Locations</button>
                    <button type="button" class="btn bg-grey waves-effect closebtn" data-dismiss="modal" style="text-transform: none !important;">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        var options = {
            details: "form.location",
            map: ".map_canvas"
        };

        setTimeout(function(){
            $(".popup_location").geocomplete(options).bind("geocode:result", function(event, result){});
        },1000);

        $(".btnSearchLocations").click(function(){
            $("#geocomplete").trigger("geocode");
            $(window).resize();
        });
    });
</script>

<div class="modal fade" style="background-color: #0009;" id="PopupAddUsernames" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="defaultModalLabel">Add Usernames</h4>
            </div>
            <div class="modal-body pt0">
                <div class="input-group mb0 formSearchPopup">
<!--                    <span class="input-group-btn">-->
<!--                      <select name="account" class="form-control account" style="min-width: 120px;">-->
<!---->
<!--                          <option value="1">username</option>-->
<!---->
<!--                      </select>-->
<!--                    </span>-->
                    <div class="form-line newinput">
                        <input type="text" name="popup_username" class="form-control popup_username" placeholder="Username">
                    </div>
                    <span class="input-group-btn">
                      <a class="btn bg-dashboard-primary waves-effect btnSearchUsernames newbutton">Search</a>
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="ajax_dataSearchUsername">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn new-blue waves-effect btnAddUsernames" style="display: none;text-transform: none !important;">Add Usernames</button>
                <button type="button" class="btn bg-grey waves-effect closebtn" data-dismiss="modal" style="text-transform: none !important;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" style="background-color: #0009;" id="PopupAddMessages" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="defaultModalLabel">Add Messages</h4>
            </div>
            <div class="modal-body pt0">
                <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                    Add multiple messages at the same time by using semicolon as delimiter.
                </p>
                <div class="form-group">
                    <div class="form-line box_popup_comments p15">
                        <textarea rows="4" class="form-control no-resize popup_list_messages" placeholder="Messages"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn new-blue waves-effect btnAddMessages" style="display: none;text-transform: none !important;">Add Messages</button>
                <button type="button" class="btn bg-grey waves-effect closebtn3" data-dismiss="modal" style="text-transform: none !important;">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".popup_list_messages").emojioneArea({
            hideSource: true,
            useSprite: false,
            pickerPosition    : "bottom",
            filtersPosition   : "bottom"
        });
    });
</script>

<div class="modal fade" style="background-color: #0009;" id="PopupAddBlacklistTags" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="defaultModalLabel">Add Hashtags</h4>
            </div>
            <div class="modal-body pt0">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="profile">
                        <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                            Add multiple hashtags at the same time by using comma as delimiter.
                        </p>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="4" class="form-control no-resize popup_list_blacktags" placeholder="Hashtags"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn new-blue waves-effect btnAddBlacklistTags" style="display: none;text-transform: none !important;">Add Hashtags</button>
                <button type="button" class="btn bg-grey waves-effect closebtn5" data-dismiss="modal" style="text-transform: none !important;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" style="background-color: #0009;" id="PopupAddBlacklistUsernames" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="defaultModalLabel">Add Usernames</h4>
            </div>
            <div class="modal-body pt0">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="profile">
                        <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                            Add multiple usernames at the same time by using comma as delimiter.
                        </p>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="4" class="form-control no-resize popup_list_blackuser" placeholder="Usernames"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn new-blue waves-effect btnAddBlacklistUsernames" style="display: none;text-transform: none !important;">Add Usernames</button>
                <button type="button" class="btn bg-grey waves-effect closebtn6" data-dismiss="modal" style="text-transform: none !important;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" style="background-color: #0009;" id="PopupAddKeywords" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="defaultModalLabel">Add Keywords</h4>
            </div>
            <div class="modal-body pt0">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="profile">
                        <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                            Add multiple keywords at the same time by using comma as delimiter.
                        </p>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="4" class="form-control no-resize popup_list_blackkey" placeholder="Keywords"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn new-blue waves-effect btnAddBlacklistKeywords" style="display: none;text-transform: none !important;">Add Keywords</button>
                <button type="button" class="btn bg-grey waves-effect closebtn4" data-dismiss="modal" style="text-transform: none !important;">Close</button>
            </div>
        </div>
    </div>
</div>

<!--<div class="modal fade" style="background-color: #0009;" id="getstartguide" role="dialog">-->
<!--    <div class="modal-dialog modal-lg">-->
<!---->
        <!-- Modal content-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header" style="border-bottom:0px;">-->
<!--                <button type="button" id="quickclose" class="close" data-dismiss="modal">&times;</button>-->
<!--                <h2 style="text-transform: none;">How to Start?</h2>-->
<!--            </div>-->
<!--            <div class="popup_contant">-->
<!---->
<!--                <p>If you want to get a lot of new likes, comments, and followers, you should-->
<!--                    be doing the same for others. We help you to be more active!</p>-->
<!--                <div class="col-sm-6">-->
<!--                    <p><strong>1.</strong> Select what do you want to do: like, comment, follow or unfollow. To do-->
<!--                        this, press on the button next to each action, so its color changes to blue.</p>-->
<!--                </div>-->
<!--                <div class="col-sm-6">-->
<!--                    <img class="pull-right" style="padding-bottom:30px;width: 100%;" src="--><?//=BASE?><!--assets/images/option.svg" >-->
<!--                </div>-->
<!---->
<!--                <div class="col-sm-6">-->
<!--                    <img style="width:100%;" src="--><?//=BASE?><!--assets/images/select.png">-->
<!--                </div>-->
<!--                <div class="col-sm-6">-->
<!--                    <p><strong>2.</strong> Our settings will help you to control your activity depends on your-->
<!--                        needs.</p>-->
<!--                </div>-->
<!--                <div class="col-sm-12">-->
<!--                    <p class="paragraf_bg">You may hover your mouse over the question mark next-->
<!--                        to each setting to learn more about it: <img style="height: 22px;" src="--><?//=BASE?><!--assets/images/question.png"></p>-->
<!--                </div>-->
<!---->
<!--                <div class="col-sm-6">-->
<!--                    <p><strong>3.</strong> We have already added some hashtags and comments for easy start. Just-->
<!--                        push the blue button! Find more information about all our settings in our Guide!</p>-->
<!--                </div>-->
<!--                <div class="col-sm-6">-->
<!--                    <img style="padding-top:30px; width:100%;" class="pull-right" src="--><?//=BASE?><!--assets/images/btn.png">-->
<!--                </div>-->
<!---->
<!--                <p class="bottom_p">Find more information about all our settings in our <a href="#">Guide</a>!</p>-->
<!---->
<!--                <button type="button" class="btn bottom_btn waves-effect" data-dismiss="modal" style="text-transform: none !important;">--><?//=l("Let's go")?><!--</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="modal fade" id="getstartguide" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="text-align: center;" class="modal-title" id="defaultModalLabel"><?=l('Quick Start Guide')?></h4>
            </div>
            <div class="modal-body pt0">
                <div id="myCarousel" class="carousel slide" data-ride="carousel" style="height: 310px;">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                        <li data-target="#myCarousel" data-slide-to="4"></li>
                        <li data-target="#myCarousel" data-slide-to="5"></li>

                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">

                        <div class="item active">
                            <div style="width:35%; margin: 0 auto;">
                                <img src="<?=BASE?>assets/images/slide/g1.png" style="width:100%;">
                            </div>
                            <h2 style="padding-bottom:10px;"><?=l('Recommended actions');?></h2>
                            <p><?=l('Do not use all of the actions at the same time as a beginner. It is safer to use only the Like action on Slow speed for your first few days on IGplan.');?></p>
                        </div>

                        <div class="item">
                            <div style="width:35%; margin: 0 auto;">
                                <img src="<?=BASE?>assets/images/slide/g2.png" style="width:100%;">
                            </div>
                            <h2 style="padding-bottom:10px;"><?=l('Recommended speed');?></h2>
                            <p><?=l('Start using IGplan on the Slow speed to ensure your account is safe. You can increase the speed to Normal or Fast after a few days of using IGplan.');?></p>
                        </div>

                        <div class="item">
                            <div style="width:35%; margin: 0 auto;">
                                <img src="<?=BASE?>assets/images/slide/g3.png" style="width:100%;">
                            </div>
                            <h2 style="padding-bottom:10px;"><?=l('Adjust your settings');?></h2>
                            <p><?=l('IGplan offers a wide variety of activity settings for the most effective interaction with your target audience.');?></p>
                        </div>
                        <div class="item">
                            <div style="width:35%; margin: 0 auto;">
                                <img src="<?=BASE?>assets/images/slide/g4.png" style="width:100%;">
                            </div>
                            <h2 style="padding-bottom:10px;"><?=l('Instagram content');?></h2>
                            <p><?=l("It's important that your Instagram account doesn't look fake or spammy. It is better to have an actively maintained account with at least 15 photos/videos posted.");?></p>
                        </div>

                        <div class="item">
                            <div style="width:35%; margin: 0 auto;">
                                <img src="<?=BASE?>assets/images/slide/g5.png" style="width:100%;">
                            </div>
                            <h2 style="padding-bottom:10px;"><?=l('Important information');?></h2>
                            <p><?=l("Feel free to post pictures when IGplan is started but make sure you don't Like, Comment, Follow, or Unfollow manually. Manual activity can lead to password resets.");?></p>
                        </div>

                        <div class="item">
                            <div style="width:35%; margin: 0 auto;">
                                <img src="<?=BASE?>assets/images/slide/g6.png" style="width:100%;">
                            </div>
                            <h2 style="padding-bottom:10px;"><?=l('Now you are ready!');?></h2>
                            <p><?=l("It's time to customize your settings and start your activity.");?></p>
                            <a href="javascript:void(0);" class="slider_go close" data-dismiss="modal">Let's Go</a>
                        </div>

                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

<script>

    $(document).ready(function(){

        $('#myCarousel').carousel({
            interval: false
        });


//        $('.likes').click(function(){
//
//            alert(this.val());
//
//
//        }});


//        var v = '';
//         v+= 'Turn this switch on (blue) to automate your Likes activity.'+ '<br/><br>'+ 'The counter shows how many photos and videos you have liked since your last activity start.';

    $('.likes').tooltip({title: "Tooltip", trigger: "click"});


//        $('#getstartguide').modal('show');

//        if($(".carousel-indicators > li:first-child").attr('class') == 'active'){
//            $('.left').addClass('hide');
//        }
//
//        if($(".carousel-indicators > li:last-child").attr('class') == 'active'){
//            $('.right').addClass('hide');
//        }
//
//        $('.left').click(function(){
////alert(1);
//            if($(".carousel-indicators > li:first-child").attr('class') == 'active'){
//                $('.left').addClass('hide');
//            }else{
//                $('.left').removeClass('hide');
//            }
//
//            if($(".carousel-indicators > li:last-child").attr('class') == 'active'){
//                $('.right').addClass('hide');
//            }else{
//                $('.right').removeClass('hide');
//            }
//
//        });
//
//        $('.right').click(function(){
////            alert(2);
//            if($(".carousel-indicators > li:last-child").attr('class') == 'active'){
//                $('.right').addClass('hide');
//            }else{
//                $('.right').removeClass('hide');
//            }
//
//            if($(".carousel-indicators > li:first-child").attr('class') == 'active'){
//                $('.left').addClass('hide');
//            }else{
//                $('.left').removeClass('hide');
//            }
//
//        });



    });

    $('#quickclose').click(function(){
//            alert(123);
        $("#getstartguide").modal('hide');
    });

    $('.abcspeed').change(function(){
            if($("select[name=speed] option").length <= 3){
                var opt = '<option value="3" disabled="" selected="">Custom</option>';
                $(":input[name='speed']").append(opt);
            }

    });

    $(":input[name='speed']").change(function(){
        var newspeed = $(":input[name='speed']").val();
        if(newspeed == 1){

            $(":input[name='repeat_like']").val(20);
            $(":input[name='repeat_comment']").val(4);
            $(":input[name='repeat_follow']").val(15);
            $(":input[name='repeat_unfollow']").val(15);
            $(":input[name='delay']").val(6);

        }else if(newspeed == 2){

            $(":input[name='repeat_like']").val(25);
            $(":input[name='repeat_comment']").val(7);
            $(":input[name='repeat_follow']").val(20);
            $(":input[name='repeat_unfollow']").val(20);
            $(":input[name='delay']").val(4);

        }else if(newspeed == 3){

            $(":input[name='repeat_like']").val(30);
            $(":input[name='repeat_comment']").val(10);
            $(":input[name='repeat_follow']").val(25);
            $(":input[name='repeat_unfollow']").val(25);
            $(":input[name='delay']").val(2);

        }

        if($("select[name=speed] option").length > 3){
            $("select[name=speed] option:last").remove();
        }


    });

    $(document).on("keyup", ".popup_list_tags", function(){
//          alert(54654);
        $('.btnAddTags').css('display',"block");
        $('.btnAddTags').css('margin',"0 auto");
        $('.closebtn1').css('display',"none");

    });

    $(document).on("keyup", ".popup_list_comments", function(){
//          alert(54654);
        $('.btnAddComnents').css('display',"block");
        $('.btnAddComnents').css('margin',"0 auto");
        $('.closebtn2').css('display',"none");

    });

    $(document).on("keyup", ".popup_list_messages", function(){
//          alert(54654);
        $('.btnAddMessages').css('display',"block");
        $('.btnAddMessages').css('margin',"0 auto");
        $('.closebtn3').css('display',"none");

    });

    $(document).on("keyup", ".popup_list_blackkey", function(){
//          alert(54654);
        $('.btnAddBlacklistKeywords').css('display',"block");
        $('.btnAddBlacklistKeywords').css('margin',"0 auto");
        $('.closebtn4').css('display',"none");

    });

    $(document).on("keyup", ".popup_list_blacktags", function(){
//          alert(54654);
        $('.btnAddBlacklistTags').css('display',"block");
        $('.btnAddBlacklistTags').css('margin',"0 auto");
        $('.closebtn5').css('display',"none");

    });

    $(document).on("keyup", ".popup_list_blackuser", function(){
//          alert(54654);
        $('.btnAddBlacklistUsernames').css('display',"block");
        $('.btnAddBlacklistUsernames').css('margin',"0 auto");
        $('.closebtn6').css('display',"none");

    });
</script>



