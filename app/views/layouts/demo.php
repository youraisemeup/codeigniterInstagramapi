<?php $version = random_string()?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?=TITLE." | ".$template['title']?></title>
    <meta name="description" content="<?=DESCRIPTION?>"/>
    <meta name="keywords" content="<?=KEYWORDS?>"/>

    <!-- Facebook open graph tags -->
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="IGplan"/>
    <meta property="og:url" content="<?=current_url()?>"/>
    <meta property="og:title" content="<?=$template['title']." - ".TITLE?>"/>
    <meta property="og:description" content="<?=DESCRIPTION?>"/>

    <!-- Twitter card tags -->
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@igplan"/>
    <meta name="twitter:title" content="<?=$template['title']." - ".TITLE?>"/>
    <meta name="twitter:description" content="<?=DESCRIPTION?>"/>
    <!-- Favicon-->
    <!--    <link rel="icon" href="--><?php //=BASE?><!--assets/images/favicon.ico" type="image/x-icon">-->
    <link rel="icon" href="<?=BASE?>assets/images/fab.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="<?=BASE?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?=BASE?>assets/css/fonts.css" rel="stylesheet">
    <link href="<?=BASE?>assets/plugins/node-waves/waves.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/plugins/jquery.ui/smoothness/jquery-ui-1.10.1.custom.css" rel="stylesheet" >
    <link href="<?=BASE?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?=BASE?>assets/plugins/jquery-datatable/extensions/responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="<?=BASE?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/plugins/elfinder/css/elfinder.min.css" rel="stylesheet" >
    <link href="<?=BASE?>assets/plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/plugins/emojionearea/emojionearea.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?=BASE?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/css/style.css" rel="stylesheet">
    <link href="<?=BASE?>assets/css/themes/all-themes.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/css/custom.css?v=1.4" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /*.popup_contant{overflow: hidden; padding: 20px 60px 50px;}*/
        /*.popup_contant h2{font-size: 32px; color: #000000; font-weight: bold;}*/
        /*.popup_contant p{*/
            /*font-size: 14px;*/
            /*color: #000;*/
            /*padding: 5px 0px;*/
            /*line-height: 22px;*/
        /*}*/
        /*.paragraf_bg{background: #f8f8f8; padding: 12px 10px !important; margin: 20px 0px;  border-radius: 15px;}*/
        /*.bottom_p{clear: both;}*/
        /*.bottom_btn {*/
            /*font-size: 22px;*/
            /*font-weight: bold;*/
            /*color: #000;*/
            /*background: #f8f8f8;*/
            /*padding: 15px 30px;*/
            /*margin: 0 auto;*/
            /*display: table;*/
        /*}*/
    </style>
    <script src="<?=BASE?>assets/plugins/jquery/jquery.min.js"></script>

    <script type="text/javascript">
        var PATH       = '<?=PATH?>';
        var BASE       = '<?=BASE?>';
        var IS_ADMIN   = '<?=IS_ADMIN?>';
        var CURRENT_URL= '<?=current_url()?>';
        var list_chart = [];
        var token      = '<?=$this->security->get_csrf_hash();?>';
        var module     = '<?=$this->router->fetch_class()?>';
        var Lang = {};
        Lang["yes"]     = '<?=l('Yes')?>';
        Lang["deleted"] = '<?=l('Deleted')?>';
        Lang["done"] = '<?=l('Done')?>';
        Lang["selectoneitem"] = '<?=l('Select at least one item')?>';
        Lang["selectonemedia"] = '<?=l('Select at least one Instagram account')?>';
        Lang["emptyTable"] = '<?=l('No data available in table')?>';
        Lang["processing"] = '<?=l('Processing')?>';
        Lang["Anonymous"] = '<?=l('Anonymous')?>';
        Lang["subscribePlan"] = '<?=l('Subscribe Plan')?>';
        Lang["verified"] = '<?=l('Verified')?>';
        var flashError    = '<?=$this->session->flashdata('error')?>';
        var flashSuccess  = '<?=$this->session->flashdata('success')?>';
    </script>
</head>

<body class="theme-<?=THEME?>">
<!-- Page Loader -->
<div class="page-loader-action">
    <div class="loader">
        <div class="md-preloader pl-size-md">
            <svg viewbox="0 0 75 75">
                <circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" />
            </svg>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
<!--            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>-->
            <a href="javascript:void(0);" class="collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
<!--                <i class="fa fa-bars newdrop" style="float: right;font-size: 30px;margin-top: 10px;margin-right: 20px;color: #595959;"></i>-->
                <p style="float: right;font-size: 17px;margin-top: 10px;margin-right: 20px;color: #000;font-weight: bold;">Menu</p>
            </a>
            <a href="javascript:void(0);" class="bars hidden"></a>
            <a class="navbar-brand text-center" href="<?= PATH ?>">
                <img src="<?=LOGO?>" title="" alt="">
                <!--                --><?//=config_item('app_name')?>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav nav-group">
                <li><a href="https://www.igplan.com/about/">About</a></li>
                <li><a href="https://www.igplan.com/blog/">Blog</a></li>
                <!--                    <li><a href="--><?//=url("payments")?><!--">--><?//=l('Plans')?><!--</a></li>-->
                <li><a href="https://www.igplan.com/prices/">Prices</a></li>
                <!--                <li><a href="#">--><?//=l('Training')?><!--</a></li>-->
                <!--                <li><a href="#">--><?//=l('Refer')?><!--</a></li>-->

                <li class="">
                    <a type="button" class="onlyAlert" data-action="confirm" data-confirm="You are not eligible for our affiliate program. Subscribe any one of our premium plans to get access and earn money.">
                        <span>Refer</span>                            </a>
                </li>
                <li><a href="https://www.igplan.com/support/">Support</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user mr5"></i>Hi, User <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="">
                            <a href="<?= PATH ?>" class=" waves-effect waves-block">
                                <i class="material-icons">account_box</i>
                                Update                            </a>
                        </li>
                        <li>
                            <a href="<?= PATH ?>" class=" waves-effect waves-block">
                                <i class="material-icons">dashboard</i>
                                <?=l('Dashboard')?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= PATH ?>" class=" waves-effect waves-block">
                                <i class="material-icons">lock_open</i>
                                Logout                            </a>
                        </li>
                    </ul>
                </li>


                <li>
                </li>
            </ul>

            <!--            <ul class="nav navbar-nav top-menu right mr0">-->
            <!--            </ul>-->
        </div>
    </div>
</nav>
<?//=modules::run("blocks/sidebar")?>
    <!-- #END# Overlay For Sidebars -->
<!--    --><?//=modules::run("blocks/header")?>
    <?=$template['body']?>
    <?=modules::run("blocks/footer")?>

<script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.
    var map, infoWindow;
    function initMap() {
//        map = new google.maps.Map(document.getElementById('map'), {
        map = new google.maps.Map(document.getElementsByClassName('map_canvas')[0], {
            center: {lat: -34.397, lng: 150.644},
            zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                infoWindow.open(map);
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }
</script>


<script>
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initMap() {
//        var map = new google.maps.Map(document.getElementById('map'), {
        var map = new google.maps.Map(document.getElementsByClassName('map_canvas')[0], {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        });

        var infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                infoWindow.open(map);
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }




//        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
//        var types = document.getElementById('type-selector');
//        var strictBounds = document.getElementById('strict-bounds-selector');

//        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindowContent.children['place-icon'].src = place.icon;
            infowindowContent.children['place-name'].textContent = place.name;
            infowindowContent.children['place-address'].textContent = address;
            infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
//        function setupClickListener(id, types) {
//            var radioButton = document.getElementById(id);
//            radioButton.addEventListener('click', function() {
//                autocomplete.setTypes(types);
//            });
//        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
//            .addEventListener('click', function() {
//                console.log('Checkbox clicked! New state=' + this.checked);
//                autocomplete.setOptions({strictBounds: this.checked});
//            });
    }


    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }


</script>



<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAreGAq90jcymt3ZFI4B4k3Iz7SuU9f4Gg&callback=initMap&libraries=places">
</script>

<!--<script src="--><?//=BASE?><!--assets/plugins/gmaps/gmaps.js"></script>-->
<!--<script src="--><?//=BASE?><!--assets/plugins/geocomplete/jquery.geocomplete.js"></script>-->

<!--<script src="https://maps.googleapis.com/maps/api/js?key=--><?//=GOOGLE_API_KEY?><!--&sensor=false&libraries=places" type="text/javascript"></script>-->
<!--<script src="--><?//=BASE?><!--assets/plugins/geocomplete/jquery.geocomplete.js"></script>-->
<script src="<?=BASE?>assets/plugins/bootstrap/js/bootstrap.js"></script>
<script src="<?=BASE?>assets/plugins/jquery.ui/jquery.ui.min.js"></script>
<!--<script src="--><?//=BASE?><!--assets/plugins/momentjs/moment.js"></script>-->
<!--<script src="--><?//=BASE?><!--assets/plugins/geocomplete/jquery.geocomplete.js"></script>-->
<!--<script src="--><?//=BASE?><!--assets/plugins/gmaps/gmaps.js"></script>-->
<script src="<?=BASE?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<!--<script src="--><?//=BASE?><!--assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>-->

<script src="<?=BASE?>assets/plugins/highcharts/highcharts.js"></script>
<script src="<?=BASE?>assets/plugins/countid/jquery.countdown.min.js"></script>
<script src="<?=BASE?>assets/plugins/elfinder/js/elfinder.full.js"></script>
<script src="<?=BASE?>assets/plugins/elfinder/js/jquery.dialogelfinder.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-datatable/extensions/responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?=BASE?>assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script src="<?=BASE?>assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
<script src="<?=BASE?>assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?=BASE?>assets/plugins/node-waves/waves.js"></script>
<script src="<?=BASE?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?=BASE?>assets/plugins/emojionearea/emojionearea.min.js"></script>

<!-- Custom Js -->
<!--<script src="https://mysecretbot.com/assets/js/admin.js"></script>-->
<!--<script src="https://mysecretbot.com/assets/js/analytics.js"></script>-->
<!--<script src="https://mysecretbot.com/assets/js/script.js"></script>-->
<script>
    $(document).ready(function() {

        //Disable cut copy paste
        $('body').bind('cut copy', function (e) {
            e.preventDefault();
        });

        //Disable mouse right click
        $("body").on("contextmenu",function(e){
            return false;
        });



        $('[data-toggle="tooltip"]').tooltip();
        $("[data-toggle=popover]").popover();
        // For the Second level Dropdown menu, highlight the parent
        $( ".dropdown-menu" )
            .mouseenter(function() {
                $(this).parent('li').addClass('active');
            })
            .mouseleave(function() {
                $(this).parent('li').removeClass('active');
            });
        $('.btnOpenAddComments').click(function(){
//            alert(123);
            $("#PopupAddComments").modal('show');
        });

        $('.btnOpenAddTags').click(function(){
//            alert(123);
            $("#PopupAddTags").modal('show');
        });

        $('.btnOpenAddLocations').click(function(){
//            alert(123);
            $("#PopupAddLocations").modal('show');
        });

        $('.btnOpenAddUsernames').click(function(){
//            alert(123);
            $("#PopupAddUsernames").modal('show');
        });

        $('.btnOpenAddMessages').click(function(){
//            alert(123);
            $("#PopupAddMessages").modal('show');
        });

        $('.btnOpenAddBlacklistTags').click(function(){
//            alert(123);
            $("#PopupAddBlacklistTags").modal('show');
        });

        $('.btnOpenAddBlacklistUsernames').click(function(){
//            alert(123);
            $("#PopupAddBlacklistUsernames").modal('show');
        });

        $('.btnOpenAddBlacklistKeywords').click(function(){
//            alert(123);
            $("#PopupAddKeywords").modal('show');
        });

        $('.quickguide').click(function(){
//            alert(123);
            $("#getstartguide").modal('show');
        });

        $('.btnAddComnents').click(function(){
//            alert(123);
            var data = $(".popup_list_comments").val();

            var indata = data.split(",");
            var inner = '';
            for(var i=0;i < indata.length;i++){

                inner += '<div class="item" data-tag="'+indata[i]+'">'+indata[i]+'<div class="icon-remove btnRemoveTag">x</div><div class="icon-tag"></div></div>';
            }
            $('#comments').append(inner);
            $("#PopupAddComments").modal('hide');


        });


        $('.btnAddTags').click(function(){
//            alert(123);
            var data = $(".popup_list_tags").val();

            var indata = data.split(",");
            var inner = '';
            for(var i=0;i < indata.length;i++){

                inner += '<div class="item" data-tag="'+indata[i]+'">'+indata[i]+'<div class="icon-remove btnRemoveTag">x</div><div class="icon-tag"></div></div>';
            }
            $('#NewTags').append(inner);
            $("#PopupAddTags").modal('hide');


        });

        $('.btnAddMessages').click(function(){
//            alert(123);
            var data = $(".popup_list_messages").val();

            var indata = data.split(";");
            var inner = '';
            for(var i=0;i < indata.length;i++){

                inner += '<div class="item" data-tag="'+indata[i]+'">'+indata[i]+'<div class="icon-remove btnRemoveTag">x</div><div class="icon-tag"></div></div>';
            }
            $('#Messages').append(inner);
            $("#PopupAddMessages").modal('hide');


        });

        $('.btnAddBlacklistTags').click(function(){
//            alert(123);
            var data = $(".popup_list_blacktags").val();

            var indata = data.split(",");
            var inner = '';
            for(var i=0;i < indata.length;i++){

                inner += '<div class="item" data-tag="'+indata[i]+'">'+indata[i]+'<div class="icon-remove btnRemoveTag">x</div><div class="icon-tag"></div></div>';
            }
            $('#BlackTags').append(inner);
            $("#PopupAddBlacklistTags").modal('hide');


        });

        $('.btnAddBlacklistUsernames').click(function(){
//            alert(123);
            var data = $(".popup_list_blackuser").val();

            var indata = data.split(",");
            var inner = '';
            for(var i=0;i < indata.length;i++){

                inner += '<div class="item" data-tag="'+indata[i]+'">'+indata[i]+'<div class="icon-remove btnRemoveTag">x</div><div class="icon-tag"></div></div>';
            }
            $('#BlackUser').append(inner);
            $("#PopupAddBlacklistUsernames").modal('hide');


        });

        $('.btnAddBlacklistKeywords').click(function(){
//            alert(123);
            var data = $(".popup_list_blackkey").val();

            var indata = data.split(",");
            var inner = '';
            for(var i=0;i < indata.length;i++){

                inner += '<div class="item" data-tag="'+indata[i]+'">'+indata[i]+'<div class="icon-remove btnRemoveTag">x</div><div class="icon-tag"></div></div>';
            }
            $('#BlackKey').append(inner);
            $("#PopupAddKeywords").modal('hide');

        });

//        if($(document).hasClass('popover-title') !== null){

        $(document).click(function(){

            var isMobileVersion = document.getElementsByClassName('popover-title');
            if (isMobileVersion.length > 0) {

                setTimeout(function(){
                    $("[data-toggle=popover]").popover('hide');
                },5000);

            }

        });



    });

</script>


<script>
    window.intercomSettings = {
        app_id: "o8hzmmih"
    };
</script>
<script>(function(){var w=window;varic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/o8hzmmih';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>

<script type="text/javascript">
    window._mfq = window._mfq || [];
    (function() {
        var mf = document.createElement("script");
        mf.type = "text/javascript"; mf.async = true;
        mf.src = "//cdn.mouseflow.com/projects/6752dee8-83e2-46a5-a08d-60aaa2e55a89.js";
        document.getElementsByTagName("head")[0].appendChild(mf);
    })();
</script>

</body>

</html>