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
    <meta property="og:title" content="<?=$template['title']?>"/>
    <meta property="og:description" content="<?=DESCRIPTION?>"/>

    <!-- Twitter card tags -->
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@igplan"/>
    <meta name="twitter:title" content="<?=$template['title']?>"/>
    <meta name="twitter:description" content="<?=DESCRIPTION?>"/>
    <style>
	body { 
		background-color: #fff;
		-moz-transition: all 0.5s;
		-o-transition: all 0.5s;
		-webkit-transition: all 0.5s;
		transition: all 0.5s;
		font-family: 'Roboto', Arial, Tahoma, sans-serif;
		position: relative;
		margin: 0;
		padding-bottom: 6rem;
		min-height: 100%;
	}

	body {
		font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
		font-size: 14px;
		line-height: 1.42857143;
		color: #333;
		background-color: #fff;
	}
	.page-loader-action {
		z-index: 12;
		position: fixed;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		width: 100%;
		height: 100%;
		display: none;
		background: rgba(255,255,255,0.6);
		overflow: hidden;
		text-align: center;
	}
	.page-loader-action .loader {
		position: relative;
		top: calc(50% - 30px);
	}
	.md-preloader.pl-size-md {
		width: 50px;
	}

	.md-preloader {
		font-size: 0;
		display: inline-block;
	}
	.md-preloader svg {
		-webkit-animation: inner 1320ms linear infinite;
		animation: inner 1320ms linear infinite;
	}

	svg:not(:root) {
		overflow: hidden;
	}
	.md-preloader .pl-red {
		stroke: #F44336;
	}

	.md-preloader svg circle {
		fill: none;
		stroke: #448aff;
		stroke-linecap: square;
		-webkit-animation: arc 1320ms cubic-bezier(.8, 0, .4, .8) infinite;
		animation: arc 1320ms cubic-bezier(.8, 0, .4, .8) infinite;
	}
	.overlay {
		position: fixed;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: rgba(0, 0, 0, 0.5);
		display: none;
		z-index: 10;
	}
	.box-login {
		text-align: center;
		width: 400px;
		/* margin: 100px auto 0; */
		margin: 50px auto 100px;
	}
	.login-form {
		width: 400px;
		background: #fff;
		margin: 100px auto 0;
		padding: 0 0 30px;
		border-radius: 6px;
	}

	.login-form form {
		/* padding: 30px 30px 0; */
		background: #ffffff;
		/* box-shadow: 1px 11px 21px 2px #0000002b; */
		padding: 30px 20px;
		border-radius: 8px;
	}
	img {
		vertical-align: middle;
	}
	.input-group {
		width: 100%;
		/* margin-bottom: 20px; */
		margin-bottom: 8px;
	}

	.input-group {
		position: relative;
		display: table;
		border-collapse: separate;
	}
	.input-group .form-line {
		display: block;
		height: 44px;
		border-radius: 4px;
		padding: 6px 10px;
		border: 1px solid #9da3a6;
		position: relative;
	}

	.input-group .form-line {
		display: inline-block;
		width: 100%;
		padding: 0 5px;
		border: 1px solid #ddd;
		position: relative;
	}
	.input-group * {
		border-radius: none!important;
		padding: 5px !important;
	}
	.input-group .form-control:last-child, .input-group-addon:last-child, .input-group-btn:last-child > .btn, .input-group-btn:last-child > .btn-group > .btn, .input-group-btn:last-child > .dropdown-toggle, .input-group-btn:first-child > .btn:not(:first-child), .input-group-btn:first-child > .btn-group:not(:first-child) > .btn {
		border-top-left-radius: 0;
		border-bottom-left-radius: 0;
	}
	.input-group .form-control:first-child, .input-group-addon:first-child, .input-group-btn:first-child > .btn, .input-group-btn:first-child > .btn-group > .btn, .input-group-btn:first-child > .dropdown-toggle, .input-group-btn:last-child > .btn:not(:last-child):not(.dropdown-toggle), .input-group-btn:last-child > .btn-group:not(:last-child) > .btn {
		border-top-right-radius: 0;
		border-bottom-right-radius: 0;
	}
	.input-group input[type="text"], .input-group .form-control {
		box-shadow: none!important;
		border-radius: 0!important;
		/* padding-left: 0; */
		padding: 10px 9px !important;
		top: 0px !important;
		position: absolute;
		height: 42px;
		right: 0px;
		left: 0px;
	}
	.form-line .form-control {
		border: none;
	}
	.input-group .form-control {
		background: transparent;
	}
	.input-group-addon, .input-group-btn, .input-group .form-control {
		display: table-cell;
	}
	.input-group .form-control {
		position: relative;
		z-index: 2;
		float: left;
		width: 100%;
		margin-bottom: 0;
	}
	.form-control {
		color: #120705;
	}
	.form-control {
		border-radius: 5px !important;
		box-shadow: none!important;
		outline: none!important;
		border: 1px solid #ddd !important;
	}

	.input-group * {
		border-radius: none!important;
		padding: 5px !important;
	}
	.form-control {
		display: block;
		width: 100%;
		height: 34px;
		padding: 6px 12px;
		font-size: 14px;
		line-height: 1.42857143;
		color: #555;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
		-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
		-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
		transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
	}
	.another_action {
		margin-top: 10px;
	}
	.login-social fieldset {
		text-align: center;
		/* border-top: 1px solid #8B2; */
		border-top: 1px solid #ccc;
	}

	fieldset {
		min-width: 0;
		padding: 0;
		margin: 0;
		border: 0;
	}
	fieldset {
		padding: .35em .625em .75em;
		margin: 0 2px;
		border: 1px solid #c0c0c0;
	}
	.login-social fieldset legend {
		width: auto;
		/* color: #8B2; */
		font-size: 16px;
		border-bottom: none;
		color: #696969;
		margin-left: 165px;
		margin-top: 21px;
	}

	legend {
		display: block;
		width: 100%;
		padding: 0;
		margin-bottom: 20px;
		font-size: 21px;
		line-height: inherit;
		color: #333;
		border: 0;
		border-bottom: 1px solid #e5e5e5;
	}
	legend {
		padding: 0;
		border: 0;
	}
	.login-social fieldset legend span {
		display: inline-block;
		padding: 0 5px;
	}
	.btn:not(.btn-link):not(.btn-circle) {
		-webkit-border-radius: 2px;
		-moz-border-radius: 2px;
		-ms-border-radius: 2px;
		border-radius: 2px;
		border: none;
		font-size: 16px;
		outline: none;
	}
	.new-bg-grey {
		background-color: #E1E7EB !important;
		color: #000;
	}
	.right {
		float: right;
	}
	.btn {
		display: inline-block;
		padding: 6px 12px;
		margin-bottom: 0;
		font-size: 14px;
		font-weight: normal;
		line-height: 1.42857143;
		text-align: center;
		white-space: nowrap;
		vertical-align: middle;
		-ms-touch-action: manipulation;
		touch-action: manipulation;
		cursor: pointer;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		background-image: none;
		border: 1px solid transparent;
		border-radius: 4px;
	}
	button, input, select, a {
		outline: none !important;
	}
	a {
		color: #337ab7;
		text-decoration: none;
	}

	a {
		background-color: transparent;
	}
	#mk-footer, #mk-footer p {
		font-size: 16px;
		color: #000000;
		font-weight: 400;
	}

	#mk-footer {
		display: table;
		z-index: 10;
	}
	#mk-footer {
		width: 100%;
		position: absolute;
		padding: 20px 0 0;
		/* position: fixed; */
		right: 0;
		bottom: 0;
		left: 0;
	}
	#mk-footer {
		background-color: #f7f8fc;
	}
	#mk-footer, #mk-footer p {
		font-size: 14px;
		color: #000000;
		font-weight: 400;
	}
	#mk-footer .footer-wrapper {
		position: relative;
	}

	#mk-footer .footer-wrapper {
		padding: 30px 0;
	}
	.mk-grid {
		width: 100%;
		margin: 0 auto;
	}
	.mk-grid {
		max-width: 1140px;
	}
	#mk-footer .mk-padding-wrapper {
		padding: 0 20px;

	}
	@media (min-width: 992px){
	.col-md-4 {
		width: 33.33333333%;
	}
	}
	@media (min-width: 992px){
	.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
		float: left;
	}
	}
	@media (min-width: 768px){
	.col-sm-12 {
		width: 100%;
	}
	}
	@media (min-width: 768px){
	.col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
		float: left;
	}
	}
	.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
		position: relative;
		min-height: 1px;
		padding-right: 15px;
		padding-left: 15px;
	}
	.waves-effect {
		position: relative;
		cursor: pointer;
		display: inline-block;
		overflow: hidden;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		-webkit-tap-highlight-color: transparent;
	}
	#mk-footer .widget {
		margin-bottom: 20px;
	}

	#mk-footer .widget {
		margin-bottom: 20px;
	}
	.widget {
		margin-bottom: 20px;
	}
	#mk-footer p {
		margin: 0px !important;
	}

	#mk-footer, #mk-footer p {
		font-size: 16px;
		color: #000000;
		font-weight: 400;
	}
	#mk-footer, #mk-footer p {
		font-size: 14px;
		color: #000000;
		font-weight: 400;
	}
	@media only screen and (min-width: 1200px){
	.box-login {
		/* min-height: 342px !important; */
		min-height: 412px !important;
		/* min-height: 486px !important; */
		/* min-height: 501px; */
	}
	}
	@media only screen and (min-width: 1280px){
	.box-login {
		min-height: 342px !important;
		/* min-height: 501px; */
	} 
	} 
    </style>
    <!-- Favicon-->
<!--    <link rel="icon" href="--><?php //=BASE?><!--assets/images/favicon.ico" type="image/x-icon">-->
    <link rel="icon" href="<?=BASE?>assets/images/fab.png" type="image/x-icon">
    <link  href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css"> 
    <link async="async" href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link async="async" href="<?=BASE?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link async="async" href="<?=BASE?>assets/css/fonts.css" rel="stylesheet">

    <link async="async" href="<?=BASE?>assets/plugins/node-waves/waves.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/css/style.css" rel="stylesheet">
 
    <link async="async" href="<?=BASE?>assets/css/resp.css" rel="stylesheet">
    <link async="async" href="<?=BASE?>assets/css/themes/all-themes.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/css/custom.css?v=1.4" rel="stylesheet">
    <script  src="<?=BASE?>assets/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        var PATH       = '<?=PATH?>';
        var BASE       = '<?=BASE?>';
        var list_chart = [];
        var token      = '<?=$this->security->get_csrf_hash();?>';
        var module     = '<?=$this->router->fetch_class();?>';
        var Lang = {};
        Lang["yes"]     = '<?=l('Yes')?>';
        Lang["deleted"] = '<?=l('Deleted')?>';
        Lang["selectoneitem"] = '<?=l('Select at least one item')?>';
        Lang["selectonemedia"] = '<?=l('Select at least one Instagram account')?>';
        Lang["emptyTable"] = '<?=l('No data available in table')?>';
        Lang["processing"] = '<?=l('Processing')?>';
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
            <p><?=l('Please wait...')?></p>
        </div>
    </div>
    <?php //var_dump(IS_ADMIN); ?>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
<!--    --><?//=modules::run("blocks/header")?>
    <?=$template['body']?>
    <?=modules::run("blocks/footer")?>
    <?php
    //Setting cookie if user has come with referral link
    if ($this->input->get('aff')) {
        $this->input->set_cookie('aff',$this->input->get('aff'), 259200); //3 days cookie
//            set_cookie('aff', $this->input->get('aff'), 259200);
    }
    ?>

    <script src="<?=BASE?>assets/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="<?=BASE?>assets/plugins/momentjs/moment.js"></script>
    <script src="<?=BASE?>assets/plugins/geocomplete/jquery.geocomplete.js"></script>
    <script src="<?=BASE?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="<?=BASE?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="<?=BASE?>assets/plugins/gmaps/gmaps.js"></script>
    <script src="<?=BASE?>assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
    <script src="<?=BASE?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?=BASE?>assets/plugins/node-waves/waves.js"></script>
    <script src="<?=BASE?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Js -->
    <script src="<?=BASE?>assets/js/admin.js"></script>
    <script src="<?=BASE?>assets/js/script.js"></script>

    <script>
        $(document).ready(function(){
            //Disable cut copy paste
            $('body').bind('cut copy', function (e) {
                e.preventDefault();
            });

            //Disable mouse right click
            $("body").on("contextmenu",function(e){
                return false;
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
            mf.type = "text/javascript"; mf.async=true;
            mf.src = "//cdn.mouseflow.com/projects/6752dee8-83e2-46a5-a08d-60aaa2e55a89.js";
            document.getElementsByTagName("head")[0].appendChild(mf);
        })();
    </script>

</body>

</html>