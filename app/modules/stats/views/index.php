<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />-->
<!--    <title>MySecretBot</title>-->
    <!-- Favicon-->
<!--    <link href="--><?//= BASE ?><!--assets/stats/css/bootstrap.min.css" type="text/css" rel="stylesheet" />-->
    <link href="<?= BASE ?>assets/stats/css/style.css" type="text/css" rel="stylesheet" />
    <link href="<?= BASE ?>assets/stats/css/responsive.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Morris Css -->
    <link href="<?= BASE ?>assets/stats/plugins/morrisjs/morris.css" rel="stylesheet" />
    <!--    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>-->
    <!--    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>-->

    <!-- Loader Css -->
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">-->
    <link href="<?= BASE ?>assets/stats/css/loader.css" type="text/css" rel="stylesheet" />

    <style>
        .graph {
            width: 100%;
            height: 250px;
            margin: 20px auto 0 auto;
        }
    </style>

<!--</head>-->

<!--<body>-->
<section id="loader" class="search_section">
    <div class="cube-wrapper">
        <div class="cube-folding">
            <span class="leaf1"></span>
            <span class="leaf2"></span>
            <span class="leaf3"></span>
            <span class="leaf4"></span>
        </div>
        <span class="loading" data-name="Loading">Loading</span>
    </div>
</section>
<section id="error" hidden="" class="search_section">
    <div class="container">
        <div class="alert alert-danger">
            <strong>UH OH!</strong> We couldn't find the username that you were looking for. Please <a href="<?= base_url(); ?>" style="color: #1846e3;">try again!</a>
        </div>
    </div>
</section>
<section id="private" hidden="" class="search_section">
    <div class="container">
        <div class="alert alert-danger">
            <strong>UH OH!</strong> It looks like this is a private account. We are not able to gather data from private accounts. Please <a href="<?= base_url(); ?>" style="color: #1846e3;">try again!</a>
        </div>
    </div>
</section>

<section id="upprofile" hidden="" class="search_section">
    <!--<section id="profile" hidden="" class="search_section">-->
    <section id="newuser" hidden="">
        <div class="container">
            <div class="alert alert-success">
                <strong>Awesome!</strong> This account was just added to our database. Since the account is new, some data will not be available, please check back in a few days for more.
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-b-15 statadjust">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 instabottom">
<!--                            <div id="new-details"></div>-->
                            <!--<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-add-email" style="color: #000;font-size: 20px;"><i class="fa fa-at"></i></a>-->

                            <?php

                            $CI = &get_instance();
                            $CI->db->select("*");
                            $CI->db->from(EMAIL_ALERT);
                            $CI->db->where("account_id",get('id'));
                            $query = $CI->db->get();
                            $result2 = $query->result();

//                            print_r($result2);

                            ?>
                            <div class="modal fade" id="modal-add-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header new-grey">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" id="defaultModalLabel"><?=l('Add Your Email')?></h4>
                                        </div>
                                        <div class="modal-body pt0">
                                            <div class="tab-content" style="display: block;">
                                                <div role="tabpanel" class="tab-pane fade active in" id="profile">
                                                    <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                                                        <?=l('Add your email to your account to be notified if your Activity is stopped for any reason (reached limits or an error) so your account can grow without interruptions.');?>
                                                    </p>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input style="border: 1px solid #ddd !important;" type="text" name="email" class="form-control" placeholder="<?=l('Email')?>" value="<?=$result2[0]->email!=''?$result2[0]->email:'';?>">
                                                            <input type="hidden" name="account" class="form-control" value="<?=get('id');?>">
                                                        </div>
                                                    </div>
                                                    <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                                                        <?=l('You can add the same email to multiple accounts.');?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="text-align: left;">
                                            <button type="button" class="btn new-blue waves-effect btnAddEmail" style="text-transform: none !important;width: 100px;padding: 5px 10px;background: #0D509F !important;float: left;"><?=l('Set')?></button>
                                            <a class="btn waves-effect btnDeleteEmail" style="text-transform: none !important;color: #337ab7;float: left;width: 100px;vertical-align: middle;padding: 4px 0px;"><?=l('Remove')?></a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="collapse navbar-collapse menu_02" id="myNavbar">
                                <ul class="nav navbar-nav nav-group" id="link">
                                    <li><a href="<?= PATH . "activity/auto_activity?id=" . $act_id ?>" class="navbar-link m-r-15 <?= ($this->uri->segment(2) == 'auto_activity' ? 'active' : '') ?>"><?= l('Activity') ?></a></li>
                                    <li><a href="<?= PATH . "stats?id=" . get('id') ?>" class="navbar-link m-r-15 <?= ($this->uri->segment(1) == 'stats' ? 'active' : '') ?>"><?= l('Stats') ?></a></li>
                                    <li><a href="<?= PATH . "post?account=" . get('id') ?>" class="navbar-link m-r-15 <?= ($this->uri->segment(1) == 'post' ? 'active' : '') ?>"><?= l('Schedule') ?></a></li>
                                    <li><a href="<?= PATH . "logs?account=" . get('id') ?>" class="navbar-link m-r-15 <?= ($this->uri->segment(1) == 'logs' ? 'active' : '') ?>"><?= l('Log') ?></a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="profile_data">
                    <div class="profile_img" id="profileimage" style="display:none;"></div>
                    <h2 class="usr_name" id="fullname" style="display:none;"></h2>
                    <div class="user_id" id="username" style="display:none;"></div>
                    <p class="user_p" id="biography" style="display:none;"></p>
                    <div id="viewprofile" style="display:none;"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_spc">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="profile_box">
                        <div  class="box_icon"><span class="fa fa-users"></span></div>
                        <div class="box_number" id="followers"></div>
                        <div class="follow">Followers</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="profile_box">
                        <div  class="box_icon"><span class="fa fa-address-book"></span></div>
                        <div class="box_number" id="following"></div>
                        <div class="follow">Following</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="profile_box">
                        <div  class="box_icon"><span class="fa fa-camera"></span></div>
                        <div class="box_number" id="posts"></div>
                        <div class="follow">Posts</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h2 class="main_heding" style="padding-bottom: 45px;">Statistics Table</h2>
                    <div class="tab_container">


                        <input id="tab1" type="radio" name="tabs" checked>
                        <label for="tab1" class="tabshadow"><span>Last 7 Days</span></label>


                        <input id="tab2" type="radio" name="tabs">
                        <label for="tab2" class="tabshadow"  style="margin-right:0px !important;"><span>Last 30 Days</span></label>



                        <section id="content1" class="tab-content">
                            <div class="table_supprt table-responsive" id="sevenrecent">
                            </div>
                        </section>


                        <section id="content2" class="tab-content">
                            <div class="table_supprt table-responsive" id="thirtyrecent">
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_spc">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="profile_box">
                        <h3 class="gains_hding"><strong>Follower</strong> Gains</h3>
                        <ul class="gains">
                            <li>
                                <div class="text-muted">Today</div>
                                <div class="m-b-0" id="followerstodaygain"></div>
                            </li>
                            <li>
                                <div class="text-muted">Last 7</div>
                                <div class="m-b-0" id="sevenfollowersgain"></div>
                            </li>
                            <li>
                                <div class="text-muted">Last 30</div>
                                <div class="m-b-0" id="thirtyfollowersgain"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="profile_box">
                        <h3 class="gains_hding"><strong>Following</strong> Gains</h3>
                        <ul class="gains">
                            <li>
                                <div class="text-muted">Today</div>
                                <div class="m-b-0" id="followingtodaygain"></div>
                            </li>
                            <li>
                                <div class="text-muted">Last 7</div>
                                <div class="m-b-0" id="sevenfollowinggain"></div>
                            </li>
                            <li>
                                <div class="text-muted">Last 30</div>
                                <div class="m-b-0" id="thirtyfollowinggain"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="profile_box">
                        <h3 class="gains_hding"><strong>Post</strong> Gains</h3>
                        <ul class="gains">
                            <li>
                                <div class="text-muted">Today</div>
                                <div class="m-b-0" id="poststodaygain"></div>
                            </li>
                            <li>
                                <div class="text-muted">Last 7</div>
                                <div class="m-b-0" id="sevenpostsgain"></div>
                            </li>
                            <li>
                                <div class="text-muted">Last 30</div>
                                <div class="m-b-0" id="thirtypostsgain"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<section id="prograph">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="main_heding" id="graphname" hidden="">Graph</h2>
                <div class="table_supprt post_table">
                    <div id="area_chart" class="graph">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="lowprofile" hidden="" class="search_section">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12 ">
                    <h2 class="main_heding">Recent Posts</h2>

                    <div class="table_supprt post_table table-responsive" id="instapost">
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="profile_box left_spc">
                        <h3 class="gains_hding">Average Likes</h3>
                        <div class="average" id="avglikes"></div>
                        <div class="average per">Per Post</div>
                    </div>
                    <div class="profile_box left_spc">
                        <h3 class="gains_hding">Average Comments</h3>
                        <div class="average" id="avgcomments"></div>
                        <div class="average per">Per Post</div>
                    </div>
                    <div class="profile_box left_spc">
                        <h3 class="gains_hding">Engagement Rate</h3>
                        <div class="average" id="engagementrate"></div>
                        <!--                        <div class="average per">Per Post</div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>

</section>

<!--<div id="ResultPath" hidden="">https://getigdata.com/Api/</div>-->
<div id="ResultPath" hidden=""><?= base_url('stats/getdata'); ?></div>

<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>-->

<!-- Morris Plugin Js -->
<script src="<?= BASE ?>assets/stats/plugins/raphael/raphael.min.js"></script>
<script src="<?= BASE ?>assets/stats/plugins/morrisjs/morris.js"></script>

<!-- Custom Js -->
<!--<script src="--><?//= base_url('assets/js/morris.js'); ?><!--"></script>-->
<!--<script src="--><?//= BASE ?><!--assets/js/core.js"></script>-->
<script>

$(document).ready(function(){
    getuser('<?= $result[0]['username'] ?>');
});

String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};


function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}


function getuser(Index){
    //$("#midprofile").hide();
    var username = Index;
//    var gopath = $('#ResultPath').text();

    $.ajax({
        type: 'GET',
//        url: gopath,
        url: '<?= PATH ?>stats/getdata',
        dataType : 'json',
//        cache: false,
//        async: false,
//        crossDomain: true,
        data: { username : username },
        success: function (data) {
//            console.log(data);
//                alert(data);
            data = JSON.parse(data);

            if(data.status == 1){

                var profileimage = '<img class="image_contrast" src="' + data.insta_account[0].profilepicture + '" alt="' + data.insta_account[0].username + '"/>';
                $('#profileimage').empty().append(profileimage);



                if(data.insta_account[0].is_verified == 1){

                    //var username = '@' + data.insta_account[0].username + '';
                    //$('#username').empty().text(username);

                    var fullname = decodeURIComponent(data.insta_account[0].fullname).replaceAll("+", " ");
                    $('#fullname').empty().append(fullname + ' <span class="fa fa-check-circle" style="color: #239aff;font-size: 22px;"></span>');

                }else{

                    var fullname = decodeURIComponent(data.insta_account[0].fullname).replaceAll("+", " ");
                    $('#fullname').empty().text(fullname);

                }

                var new_data = '<a href="https://instagram.com/'+ data.insta_account[0].username +'" target="_blank">';
                new_data += '<img class="instagram-avatar" src="' + data.insta_account[0].profilepicture + '" alt="Instagram avatar"></a>';
                new_data += '<a href="https://instagram.com/'+ data.insta_account[0].username +'" target="_blank" class="instagram-username">';
                new_data += data.insta_account[0].username +'</a>';
                new_data += '<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-add-email" style="color: #000 !important;font-size: 20px;margin-right: 3px;"><i class="fa fa-at" style="vertical-align: middle;"></i></a><a href="<?= PATH . "dashboard";?>" style="color: #000 !important;font-size: 20px;margin-right: 3px;"><i class="material-icons" style="vertical-align: middle;">dashboard</i></a>';
                new_data += '<div class="navbar-header newtoggle">';
                new_data += '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">';
                new_data += '<i class="fa fa-angle-down"></i></button></div>';
//                $('#new-details').empty().append(new_data);
//                $(new_data).prependTo('#instabottom');
                $('.instabottom').prepend(new_data);

                var link = '<li><a href="https://instagram.com/'+ data.insta_account[0].username +'" target="_blank" class="navbar-link m-r-15">Profile</a></li>';
                $('#link').append(link);

                var username = "@" + data.insta_account[0].username;
                $('#username').empty().text(username);

                var biography = decodeURIComponent(data.insta_account[0].biography).replaceAll("+", " ");
                $('#biography').empty().text(biography);

                var viewprofile = '<a href="https://www.instagram.com/'+ data.insta_account[0].username +'" target="_blank" class="view_btn">VIEW PROFILE</a>';
                $('#viewprofile').empty().append(viewprofile);

                var followers = formatNumber(data.insta_account[0].followers);
                $('#followers').empty().text(followers);

                var following = formatNumber(data.insta_account[0].following);
                $('#following').empty().text(following);

                var posts = formatNumber(data.insta_account[0].posts);
                $('#posts').empty().text(posts);

                var sevenrecent = '';
                sevenrecent += '<table class="table">';
                sevenrecent += '<thead>';
                sevenrecent += '<tr>';
                sevenrecent += '<th class="th_border_top">Date</th>';
                sevenrecent += '<th class="th_border_top">Followers</th>';
                sevenrecent += '<th class="th_border_top">Following</th>';
                sevenrecent += '<th class="th_border_top">Posts</th>';
                sevenrecent += '</tr>';
                sevenrecent += '</thead>';
                sevenrecent += '<tbody>';

                if(data.sevenrecent.length < 7){

                    var count = data.sevenrecent.length;

                }else{

                    var count = 7;

                }


                var sevenfollowersgain = 0;
                var sevenfollowinggain = 0;
                var sevenpostsgain = 0;

                for(var i= (count - 1); i >= 0; i--){

                    if(i == (count - 1)){

                        var followers = '--';
                        var following = '--';
                        var posts = '--';

                    }else{

                        var followers = checktotal(data.sevenrecent[i].followers,data.sevenrecent[i+1].followers);

                        var following = checktotal(data.sevenrecent[i].following,data.sevenrecent[i+1].following);

                        var posts = checktotal(data.sevenrecent[i].posts,data.sevenrecent[i+1].posts);

                    }

                    sevenrecent += '<tr>';
                    sevenrecent += '<td>'+ data.sevenrecent[i].date.split(' ')[0] +'</td>';
                    sevenrecent += '<td>'+ formatNumber(followers) +'<br>('+ formatNumber(data.sevenrecent[i].followers) +')</td>';
                    sevenrecent += '<td>'+ formatNumber(following) +'<br>('+ formatNumber(data.sevenrecent[i].following) +')</td>';
                    sevenrecent += '<td>'+ formatNumber(posts) +'<br>('+ formatNumber(data.sevenrecent[i].posts) +')</td>';
                    sevenrecent += '</tr>';


                    if(followers == '--'){
                        var countfollowers = 0;
                    }else{
                        var countfollowers = checknewtotal(data.sevenrecent[i].followers,data.sevenrecent[i+1].followers);
                    }

                    sevenfollowersgain += +countfollowers;

                    if(following == '--'){
                        var countfollowing = 0;
                    }else{
                        var countfollowing = checknewtotal(data.sevenrecent[i].following,data.sevenrecent[i+1].following);
                    }

                    sevenfollowinggain += +countfollowing;

                    if(posts == '--'){
                        var countposts = 0;
                    }else{
                        var countposts = checknewtotal(data.sevenrecent[i].posts,data.sevenrecent[i+1].posts);
                    }

                    sevenpostsgain += +countposts;
                }

                sevenrecent += '</tbody>';
                sevenrecent += '</table>';

                $('#sevenrecent').empty().append(sevenrecent);

                var newsevenfollowersgain = checkcolor(sevenfollowersgain);
                $('#sevenfollowersgain').empty().append(formatNumber(newsevenfollowersgain));

                var newsevenfollowinggain = checkcolor(sevenfollowinggain);
                $('#sevenfollowinggain').empty().append(formatNumber(newsevenfollowinggain));

                var newsevenpostsgain = checkcolor(sevenpostsgain);
                $('#sevenpostsgain').empty().append(formatNumber(newsevenpostsgain));

                var thirtyrecent = '';
                thirtyrecent += '<table class="table">';
                thirtyrecent += '<thead>';
                thirtyrecent += '<tr>';
                thirtyrecent += '<th class="th_border_top">Date</th>';
                thirtyrecent += '<th class="th_border_top">Followers</th>';
                thirtyrecent += '<th class="th_border_top">Following</th>';
                thirtyrecent += '<th class="th_border_top">Posts</th>';
                thirtyrecent += '</tr>';
                thirtyrecent += '</thead>';
                thirtyrecent += '<tbody>';

                if(data.thirtyrecent.length < 30){

                    var thirtycount = data.thirtyrecent.length;

                }else{

                    var thirtycount = 30;

                }

                var thirtyfollowersgain = 0;
                var thirtyfollowinggain = 0;
                var thirtypostsgain = 0;

                for(var i= (thirtycount - 1); i >= 0; i--){

                    if(i == (thirtycount - 1)){

                        var followers = '--';
                        var following = '--';
                        var posts = '--';

                    }else{

                        var followers = checktotal(data.thirtyrecent[i].followers,data.thirtyrecent[i+1].followers);

                        var following = checktotal(data.thirtyrecent[i].following,data.thirtyrecent[i+1].following);

                        var posts = checktotal(data.thirtyrecent[i].posts,data.thirtyrecent[i+1].posts);

                    }

                    thirtyrecent += '<tr>';
                    thirtyrecent += '<td>'+ data.thirtyrecent[i].date.split(' ')[0] +'</td>';
                    thirtyrecent += '<td>'+ formatNumber(followers) +'<br>('+ formatNumber(data.thirtyrecent[i].followers) +')</td>';
                    thirtyrecent += '<td>'+ formatNumber(following) +'<br>('+ formatNumber(data.thirtyrecent[i].following) +')</td>';
                    thirtyrecent += '<td>'+ formatNumber(posts) +'<br>('+ formatNumber(data.thirtyrecent[i].posts) +')</td>';
                    thirtyrecent += '</tr>';


                    if(followers == '--'){
                        var countfollowers = 0;
                    }else{
                        var countfollowers = checknewtotal(data.thirtyrecent[i].followers,data.thirtyrecent[i+1].followers);
                    }

                    thirtyfollowersgain += +countfollowers;

                    if(following == '--'){
                        var countfollowing = 0;
                    }else{
                        var countfollowing = checknewtotal(data.thirtyrecent[i].following,data.thirtyrecent[i+1].following);
                    }

                    thirtyfollowinggain += +countfollowing;

                    if(posts == '--'){
                        var countposts = 0;
                    }else{
                        var countposts = checknewtotal(data.thirtyrecent[i].posts,data.thirtyrecent[i+1].posts);
                    }

                    thirtypostsgain += +countposts;

                }

                thirtyrecent += '</tbody>';
                thirtyrecent += '</table>';

                $('#thirtyrecent').empty().append(thirtyrecent);

                var newthirtyfollowersgain = checkcolor(thirtyfollowersgain);
                $('#thirtyfollowersgain').empty().append(formatNumber(newthirtyfollowersgain));

                var newthirtyfollowinggain = checkcolor(thirtyfollowinggain);
                $('#thirtyfollowinggain').empty().append(formatNumber(newthirtyfollowinggain));

                var newthirtypostsgain = checkcolor(thirtypostsgain);
                $('#thirtypostsgain').empty().append(formatNumber(newthirtypostsgain));


                if(data.sevenrecent.length == 1){

                    var followers = 0;
                    var following = 0;
                    var posts = 0;

                }else{

                    var followers = checktotal(data.sevenrecent[0].followers,data.sevenrecent[1].followers);
                    var following = checktotal(data.sevenrecent[0].following,data.sevenrecent[1].following);
                    var posts = checktotal(data.sevenrecent[0].posts,data.sevenrecent[1].posts);

                }

                $('#followerstodaygain').empty().append(formatNumber(followers));
                $('#followingtodaygain').empty().append(formatNumber(following));
                $('#poststodaygain').empty().append(formatNumber(posts));


                var instapost = '';
                instapost += '<table class="table recent">';
                instapost += '<thead>';
                instapost += '<tr>';
                instapost += '<th class="th_border_top">Date</th>';
                instapost += '<th class="th_border_top">Likes</th>';
                instapost += '<th class="th_border_top">Comments</th>';
                instapost += '<th class="th_border_top">Type</th>';
                instapost += '<th class="th_border_top">Link to Post</th>';
                instapost += '</tr>';
                instapost += '</thead>';
                instapost += '<tbody>';
                if(data.post!= '' && data.post.length > 0){
                    if(data.post.length < 7){

                        var postcount = data.post.length;

                    }else{

                        var postcount = 7;

                    }

                    for(var k=0; k < postcount; k++) {

                        instapost += '<tr>';
                        instapost += '<td>' + data.post[k].post_date.split(' ')[0] + '</td>';
                        instapost += '<td>' + formatNumber(data.post[k].likes) + '</td>';
                        instapost += '<td>' + formatNumber(data.post[k].comments) + '</td>';
                        instapost += '<td>' + data.post[k].type + '</td>';
                        instapost += '<td><a href="' + data.post[k].post_path + '" target="_blank" class="view_table">View Post</a></td>';
                        instapost += '</tr>';

                    }
                }else{
                    instapost += '<tr>';
                    instapost += '<td colspan="5">No Post Found</td>';
                    instapost += '</tr>';
                }

                instapost += '</tbody>';
                instapost += '</table>';

                $('#instapost').empty().append(instapost);

                var averagelikes = 0;
                var averagecomments = 0;

                if(data.post!= '' && data.post.length > 0){

                    for(var l=0; l < data.post.length; l++) {
                        averagelikes += +data.post[l].likes;
                        averagecomments += +data.post[l].comments;
                    }

                    var totalaveragelikes = averagelikes / data.post.length;
                    $('#avglikes').empty().append(formatNumber(totalaveragelikes.toFixed(0)));

                    var totalaveragecomments = averagecomments / data.post.length;
                    $('#avgcomments').empty().append(formatNumber(totalaveragecomments.toFixed(0)));

                    var newlike = totalaveragelikes.toFixed(0);
                    var newcomment = totalaveragecomments.toFixed(0);
                    //var likesAndComments = parseInt(averagelikes) + parseInt(averagecomments);
                    var likesAndComments = parseInt(newlike) + parseInt(newcomment);
                    var EngagementRatio = likesAndComments / data.insta_account[0].followers * 100;
                    var ertotal = EngagementRatio.toFixed(2) + '%';
                    $('#engagementrate').empty().append(ertotal);

                }else{

                    $('#avglikes').empty().append(averagelikes);
                    $('#avgcomments').empty().append(averagecomments);
                    $('#engagementrate').empty().append('0%');

                }


                /*graph*/
                var graphcount='';
                var graphdata = [];

                if(data.thirtyrecent.length < 12){

                    graphcount = data.thirtyrecent.length;

                }else{

                    graphcount = 12;

                }
                for(var m = (graphcount-1); m >= 0; m--) {

                    graphdata.push({
                        period: data.thirtyrecent[m].date.split(' ')[0],
                        followers: data.thirtyrecent[m].followers,
                        following: data.thirtyrecent[m].following,
                        posts: data.thirtyrecent[m].posts
                    });

                }

                Morris.Area({
                    element: 'area_chart',
                    //data: [
                    //    {
                    //        period: data.thirtyrecent[1].date.split(' ')[0],
                    //        followers: data.thirtyrecent[1].followers,
                    //        following: data.thirtyrecent[1].following,
                    //        posts: data.thirtyrecent[1].posts
                    //    },
                    //    {
                    //        period: data.thirtyrecent[0].date.split(' ')[0],
                    //        followers: data.thirtyrecent[0].followers,
                    //        following: data.thirtyrecent[0].following,
                    //        posts: data.thirtyrecent[0].posts
                    //    }
                    //],
                    data: graphdata,
                    xkey: 'period',
                    ykeys: ['followers', 'following', 'posts'],
                    labels: ['Followers', 'Following', 'Posts'],
                    pointSize: 4,
                    hideHover: 'auto',
                    lineColors: ['rgb(154,154,154)', 'rgb(177, 175, 175)','rgb(192,192,192)'],
//                    lineColors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(0, 150, 136)'],
                    behaveLikeLine: true

                });

                $("#loader").attr("hidden","");
                $("#graphname").removeAttr("hidden");
                $("#upprofile").removeAttr("hidden");
                //$("#profile").removeAttr("hidden");
                //$(".uniprofile").removeAttr("hidden");
                //$("#midprofile").removeAttr("hidden");
                //$("#midprofile").show();
                $("#lowprofile").removeAttr("hidden");

                if(data.newuser == 1){
                    $("#newuser").removeAttr("hidden");
                }

            }
            else if(data.status == 2){

                $("#loader").attr("hidden","");
                $("#prograph").attr("hidden","");

                $("#private").removeAttr("hidden");


            }else{

                $("#loader").attr("hidden","");
                $("#prograph").attr("hidden","");

                $("#error").removeAttr("hidden");

            }

        },
        error: function(data) {
            alert('Something went wrong.');
        }

    });

}


function checktotal(final,next){

    if(final < next){

        var value = parseInt(final) - parseInt(next);
        var data = '<font class="text-danger">' + value + '</font>';

    }else if(final > next){

        var value = parseInt(final) - parseInt(next);
        var data = '<font class="text-success">+' + value + '</font>';

    }else{

        var data = '<font class="text-default">0</font>';

    }

    return data;
}

function checknewtotal(final,next){

    if(final < next){

        var value = parseInt(final) - parseInt(next);
        var data = value ;

    }else if(final > next){

        var value = parseInt(final) - parseInt(next);
        var data = value ;

    }else{

        var data = 0;

    }

    return data;
}

function checkcolor(data){

    if(data.toString().split('')[0] == '-'){

        var value = '<font class="text-danger">' + data + '</font>';

    }else if(data.toString().split('')[0] == '0'){

        var value = '<font class="text-default">' + data + '</font>';

    }else{

        var value = '<font class="text-success">+' + data + '</font>';

    }
    return value;
}

function decode_utf8(s) {
    return decodeURIComponent(escape(s));
}

</script>
<!--</body>-->
<!--</html>-->