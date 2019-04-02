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
    <link async="async" href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link async="async"="async="async"" href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
 


    <?php if($this->uri->segment(1) != 'post' && $this->uri->segment(1) != 'calendar'){ ?>

    <link async="async" href="<?=BASE?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <link async="async" href="<?=BASE?>assets/css/fonts.css" rel="stylesheet">
    <link async="async" href="<?=BASE?>assets/plugins/node-waves/waves.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/plugins/jquery.ui/smoothness/jquery-ui-1.10.1.custom.css" rel="stylesheet" >
    <link async="async" href="<?=BASE?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <link async="async" href="<?=BASE?>assets/plugins/jquery-datatable/extensions/responsive/css/dataTables.responsive.css" rel="stylesheet"> 
    <link async="async" href="<?=BASE?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/plugins/elfinder/css/elfinder.min.css" rel="stylesheet" >
    <link async="async" href="<?=BASE?>assets/plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/plugins/emojionearea/emojionearea.css" media="screen" rel="stylesheet" type="text/css" />
    <link async="async" href="<?=BASE?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />



        <script  src="<?=BASE?>assets/plugins/jquery/jquery.min.js"></script>
<?php } ?>


    <link async="async" href="<?=BASE?>assets/css/style.css" rel="stylesheet">
    <link async="async" href="<?=BASE?>assets/css/themes/all-themes.css" rel="stylesheet" />
    <link async="async" href="<?=BASE?>assets/css/custom.css?v=1.4" rel="stylesheet">

    <?php if($this->uri->segment(1) == 'post'){ ?>

        <link async="async" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.7.94/css/materialdesignicons.css"/>

        <link async="async" type="text/css" rel="stylesheet" href="<?=BASE?>assets/schedule/new_res/css/newstyle.css" media="all" />
        <link async="async" type="text/css" rel="stylesheet" href="<?=BASE?>assets/schedule/new_res/css/responsive.css" media="all" />

        <link async="async" rel="stylesheet" type="text/css" href="<?=BASE?>assets/schedule/css/plugins.css">
        <link async="async" rel="stylesheet" type="text/css" href="<?=BASE?>assets/schedule/css/filemanager.css">
        <link async="async" rel="stylesheet" type="text/css" href="<?=BASE?>assets/schedule/css/core.css">


        <link async="async" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link async="async" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!--    New Template Css-->
        <link async="async" type="text/css" rel="stylesheet" href="<?=BASE?>assets/schedule/css/style.css" media="all" />
        <script src="<?=BASE?>assets/plugins/jquery/jquery.min.js"></script>
    <?php } ?>

    <?php if($this->uri->segment(1) == 'calendar'){ ?> 

        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.7.94/css/materialdesignicons.css"/>

        <link type="text/css" rel="stylesheet" href="<?=BASE?>assets/schedule/new_res/css/newstyle.css" media="all" />
        <link type="text/css" rel="stylesheet" href="<?=BASE?>assets/schedule/new_res/css/responsive.css" media="all" />

        <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/schedule/css/plugins.css">
        <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/schedule/css/filemanager.css">
        <link rel="stylesheet" type="text/css" href="<?=BASE?>assets/schedule/css/core.css">


        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!--    New Template Css-->
        <link type="text/css" rel="stylesheet" href="<?=BASE?>assets/schedule/css/style.css" media="all" />
<!--        <link href="--><?//=BASE?><!--assets/css/resp.css" rel="stylesheet">-->
        <script src="<?=BASE?>assets/plugins/jquery/jquery.min.js"></script>
    <?php } ?>



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
            <p><?=l('Please wait...')?></p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <?=modules::run("blocks/header")?>
    <?//=modules::run("blocks/sidebar")?>

    <section class="content">
<!--        <div class="container-fluid">-->
        <div class="container">
            <?php if(!check_expiration()  && IS_ADMIN != 1){?>
                <?php if($this->uri->segment(1) != 'payments'){ ?>
            <div class="alert alert-danger">
<!--                <strong>--><?//=l('Notice:')?><!--</strong>--><?//=l('Out of date! System auto stop all activity on your instagram accounts.')?>
                <strong><?=l('Notice: ')?></strong><?=l('Your session has expired. <a href="'.PATH.'payments" style="color: #fff; text-decoration:underline;">CLICK HERE</a> to keep growing your Instagram following on autopilot.')?>
            </div>
            <?php }} ?>
            <?php 
			/* $assignProxy = $this->common_model->assign_available_proxy(session('uid'), true);
                if (!is_bool($assignProxy)) {
                    echo $assignProxy;
                }*/
            ?>
            <?=$template['body']?>
        </div>
    </section>
    <?=modules::run("blocks/footer")?>
    <!-- Add new account -->
    <div class="modal fade" id="modal-add-account" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <?=modules::run("instagram_accounts/add_account")?>
            </div>
        </div>
    </div>


<!--    <div class="modal fade" id="modal-reconnect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">-->
<!--        <div class="modal-dialog" role="document">-->
<!--            <div class="modal-content">-->
<!--                --><?//=modules::run("instagram_accounts/reconnect")?>
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <!-- Connect help -->
    <div class="modal fade" id="modal-connect-help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog account-connect-help" role="document" style="margin: 30px auto;">
            <div class="modal-content">
                <?=modules::run("home/connect_help")?>
            </div>
        </div>
    </div>

    <!-- Modal Save-->
    <div class="modal fade" id="modal-how-to-use" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header bg-<?=THEME?>">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?=l('How to use')?></h4>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-red btnCloseModelHowToUse"><?=l('I understand and close it')?></button>
                    </div>
            </div>
        </div>
    </div>

    <!-- Modal Save-->
    <div class="modal fade" id="modal-save" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-blue-grey">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?=l('title')?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control save_title"/>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-modal-save"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?=l('save')?></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-blue-grey">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?=l('title')?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control category_title"/>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-modal-add-category"><i class="fa fa-floppy-o" aria-hidden="true"></i> <?=l('Add new')?></button>
                </div>
            </div>
        </div>
    </div>

    <?php if($this->uri->segment(2) == 'auto_activity'){ ?>
 
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

//
//                    var locname = place.name;
                    var locname = $('#pac-input').val();
                    var lat = place.geometry.location.lat();
// get lng
                    var lng = place.geometry.location.lng();

                    $(":input[name='formatted_address']").val(locname);
                    $(":input[name='lat']").val(lat);
                    $(":input[name='lng']").val(lng);

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

                /*setupClickListener('changetype-all', []);
                setupClickListener('changetype-address', ['address']);
                setupClickListener('changetype-establishment', ['establishment']);
                setupClickListener('changetype-geocode', ['geocode']);

                document.getElementById('use-strict-bounds').addEventListener('click', function() {
//                console.log('Checkbox clicked! New state=' + this.checked);
					autocomplete.setOptions({strictBounds: this.checked});
				});*/
            }


            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);
            }


        </script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_API_KEY ?>&callback=initMap&libraries=places"></script>
    <?php } ?>



       
       




    <?php if($this->uri->segment(1) != 'post' && $this->uri->segment(1) != 'calendar') { ?>

        <!--    <script src="--><? //=BASE?><!--assets/plugins/geocomplete/jquery.geocomplete.js"></script>-->
        <script src="<?= BASE ?>assets/plugins/bootstrap/js/bootstrap.js"></script>

        <script src="<?= BASE ?>assets/plugins/jquery.ui/jquery.ui.min.js"></script>
        <script src="<?= BASE ?>assets/plugins/momentjs/moment.js"></script>
        <!--    <script src="--><? //=BASE?><!--assets/plugins/geocomplete/jquery.geocomplete.js"></script>-->
        <script src="<?= BASE ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script
            src="<?= BASE ?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
        <!--    <script src="--><? //=BASE?><!--assets/plugins/gmaps/gmaps.js"></script>-->
        <script src="<?= BASE ?>assets/plugins/highcharts/highcharts.js"></script>
        <script src="<?= BASE ?>assets/plugins/countid/jquery.countdown.min.js"></script>
        <script src="<?= BASE ?>assets/plugins/elfinder/js/elfinder.full.js"></script>
        <script src="<?= BASE ?>assets/plugins/elfinder/js/jquery.dialogelfinder.js"></script>
        <script src="<?= BASE ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script
            src="<?= BASE ?>assets/plugins/jquery-datatable/extensions/responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= BASE ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="<?= BASE ?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="<?= BASE ?>assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="<?= BASE ?>assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="<?= BASE ?>assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="<?= BASE ?>assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="<?= BASE ?>assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="<?= BASE ?>assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script src="<?= BASE ?>assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
        <script src="<?= BASE ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
        <script src="<?= BASE ?>assets/plugins/node-waves/waves.js"></script>
        <script src="<?= BASE ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src="<?= BASE ?>assets/plugins/emojionearea/emojionearea.min.js"></script>


        <!-- Custom Js -->
        <script src="<?=BASE?>assets/js/admin.js"></script>
        <script src="<?=BASE?>assets/js/analytics.js"></script>
        <script src="<?=BASE?>assets/js/script.js"></script>

        <script>
            $(document).ready(function(){
                $('#hideshow').click(function(){

                    var newpassword = $(":input[name='password']").attr('type');
                    if(newpassword == 'text'){
                        $(":input[name='password']").prop("type", "password");
                        $("#hideshow").html('<i class="fa fa-eye"></i> SHOW');
                    }else{
                        $(":input[name='password']").prop("type", "text");
                        $("#hideshow").html('<i class="fa fa-eye-slash"></i> HIDE');
                    }

                });

                $('#hideshowcode').click(function(){

                    var newpassword = $(":input[name='code']").attr('type');
                    if(newpassword == 'text'){
                        $(":input[name='code']").prop("type", "password");
                        $("#hideshowcode").html('<i class="fa fa-eye"></i> SHOW');
                    }else{
                        $(":input[name='code']").prop("type", "text");
                        $("#hideshowcode").html('<i class="fa fa-eye-slash"></i> HIDE');
                    }

                });

            });
        </script>


    <?php } ?>

    <?php  if($this->uri->segment(1) == 'calendar'){ ?>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


        <script src="<?=BASE?>assets/schedule/js/plugins.js"></script>
        <script src="<?=BASE?>assets/schedule/js/filemanager.js"></script>

    <?php
    /**
     * This is a temporary function used just in this file
     * It's being used to escape quotes for JS strings
     * @param  string $string
     * @return string
     */
    function js_str_format($string)
    {
        return str_replace("'", "\'", $string);
    }
    ?>
    <script type="text/javascript" charset="utf-8">
        var __ = function(msgid)
        {
            return window.i18n[msgid] || msgid;
        };

        window.i18n = {
            'Are you sure?': '<?= js_str_format(l('Are you sure?')) ?>',
            'It is not possible to get back removed data!': '<?= js_str_format(l("It is not possible to get back removed data!")) ?>',
            'Yes, Delete': '<?= js_str_format(l("Yes, Delete")) ?>',
            'Cancel': '<?= js_str_format(l("Cancel")) ?>',
            'Fill required fields': '<?= js_str_format(l("Fill required fields.")) ?>',
            'Please select at least 2 media album post.': '<?= js_str_format(l("Please select at least 2 media album post.")) ?>',
            'Please select one media for story post.': '<?= js_str_format(l("Please select one media for story post.")) ?>',
            'Please select one media for post.': '<?= js_str_format(l("Please select one media for post.")) ?>',
            'Please select at least one Instagram account.': '<?= js_str_format(l("Please select at least one Instagram account.")) ?>',
            'Oops! An error occured. Please try again later!': '<?= js_str_format(l("Oops! An error occured. Please try again later!")) ?>',
            'Use the TAB key to insert emoji faster': '<?= js_str_format(l('Use the TAB key to insert emoji faster')) ?>',
            'Total Posts': '<?= js_str_format(l("Total Posts")) ?>',
            'Followers': '<?= js_str_format(l("Followers")) ?>',
            'Following': '<?= js_str_format(l("Following")) ?>',
            'Uploading...': '<?= js_str_format(l("Uploading...")) ?>',
            'Do you really want to cancel automatic payments?': '<?= js_str_format(l("Do you really want to cancel automatic payments?")) ?>',
            'Yes, cancel automatic payments': '<?= js_str_format(l("Yes, cancel automatic payments")) ?>',
            'No': '<?= js_str_format(l("No")) ?>',
            'Verification': '<?= js_str_format(l("Verification")) ?>'
        };

        $.fn.datepicker.language['en-US'] = {
            days: ['<?= js_str_format(l("Sunday")) ?>', '<?= js_str_format(l("Monday")) ?>', '<?= js_str_format(l("Tuesday")) ?>', '<?= js_str_format(l("Wednesday")) ?>', '<?= js_str_format(l("Thursday")) ?>', '<?= js_str_format(l("Friday")) ?>', '<?= js_str_format(l("Saturday")) ?>'],
            daysShort: ['<?= js_str_format(l('Sun')) ?>', '<?= js_str_format(l('Mon')) ?>', '<?= js_str_format(l('Tue')) ?>', '<?= js_str_format(l('Wed')) ?>', '<?= js_str_format(l('Thu')) ?>', '<?= js_str_format(l('Fri')) ?>', '<?= js_str_format(l('Sat')) ?>'],
            daysMin: ['<?= js_str_format(l('Su')) ?>', '<?= js_str_format(l('Mo')) ?>', '<?= js_str_format(l('Tu')) ?>', '<?= js_str_format(l('We')) ?>', '<?= js_str_format(l('Th')) ?>', '<?= js_str_format(l('Fr')) ?>', '<?= js_str_format(l('Sa')) ?>'],
            months: ['<?= js_str_format(l('January')) ?>','<?= js_str_format(l('February')) ?>','<?= js_str_format(l('March')) ?>','<?= js_str_format(l('April')) ?>','<?= js_str_format(l('May')) ?>','<?= js_str_format(l('June')) ?>', '<?= js_str_format(l('July')) ?>','<?= js_str_format(l('August')) ?>','<?= js_str_format(l('September')) ?>','<?= js_str_format(l('October')) ?>','<?= js_str_format(l('November')) ?>','<?= js_str_format(l('December')) ?>'],
            monthsShort: ['<?= js_str_format(l('Jan')) ?>', '<?= js_str_format(l('Feb')) ?>', '<?= js_str_format(l('Mar')) ?>', '<?= js_str_format(l('Apr')) ?>', '<?= js_str_format(l('May')) ?>', '<?= js_str_format(l('Jun')) ?>', '<?= js_str_format(l('Jul')) ?>', '<?= js_str_format(l('Aug')) ?>', '<?= js_str_format(l('Sep')) ?>', '<?= js_str_format(l('Oct')) ?>', '<?= js_str_format(l('Nov')) ?>', '<?= js_str_format(l('Dec')) ?>'],
            today: '<?= js_str_format(l('Today')) ?>',
            clear: '<?= js_str_format(l('Clear')) ?>',
            dateFormat: 'mm/dd/yyyy',
            timeFormat: 'hh:ii aa',
            firstDay: 1
        };

        if (typeof $.fn.oneFileManager !== 'undefined') {
            $.fn.oneFileManager.i18n['en-US'] = {
                selectFiles: '<?= js_str_format(l("Select files")) ?>',
                loadMoreFiles: '<?= js_str_format(l("Load more")) ?>',
                viewFile: '<?= js_str_format(l("View")) ?>',
                deleteFile: '<?= js_str_format(l("Delete")) ?>',
                urlInputPlaceholder: '<?= js_str_format(l("Paste your link here...")) ?>',

                emptyVolume: '<?= js_str_format(l("Your media volume is empty. <br /> Drag some files here.")) ?>',
                dropFilesHere: '<?= js_str_format(l("Drop files here to upload")) ?>',
                deleteFileConfirm: '<?= js_str_format(l("This file and all uncompleted posts which this file is assigned to will be removed. This process cannot be undone. Do you want to proceed?")) ?>',
                bigFileSizeError: '<?= js_str_format(l("File size exceeds max allowed file size.")) ?>',
                fileTypeError: '<?= js_str_format(l("File type is not allowed.")) ?>',
                noEnoughVolumeError: '<?= js_str_format(l("There is not enough storage to upload this file")) ?>',
                queueSizeLimit: '<?= js_str_format(l("There are so many files in upload queue. Please try again after current upload queue finishes.")) ?>',
            };
        }
    </script>


        <script src="<?=BASE?>assets/schedule/js/core.js"></script>
        <script src="<?=BASE?>assets/schedule/js/post.js"></script>

        <script>
            $('#account').change(function(){

                var form = $('#account').closest("form");
                var url = form.attr('action');
//                alert(url);
                var acc = $('#account').val();
//
                window.location.href = url +"&account=" + acc;
            });

        </script>

    <?php } ?>

    <?php  if($this->uri->segment(1) == 'post'){ ?>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <div hidden="" id="hashpath"><?= PATH."post/captions" ?></div>
        <div hidden="" id="userid"><?= session("uid"); ?></div>
        <div hidden="" id="locpath"><?= PATH."post/location" ?></div>
        <!--<div hidden="" id="longitude"></div>-->
        <input id="longitude" type="hidden">
        <input id="latitude" type="hidden">
        <!--<div hidden="" id="latitude"></div>-->

        <script src="<?=BASE?>assets/schedule/js/plugins.js"></script>
        <script src="<?=BASE?>assets/schedule/js/filemanager.js"></script>

        <?php
        /**
         * This is a temporary function used just in this file
         * It's being used to escape quotes for JS strings
         * @param  string $string
         * @return string
         */
        function js_str_format($string)
        {
            return str_replace("'", "\'", $string);
        }
        ?>
        <script type="text/javascript" charset="utf-8">
            var __ = function(msgid)
            {
                return window.i18n[msgid] || msgid;
            };

            window.i18n = {
                'Are you sure?': '<?= js_str_format(l('Are you sure?')) ?>',
                'It is not possible to get back removed data!': '<?= js_str_format(l("It is not possible to get back removed data!")) ?>',
                'Yes, Delete': '<?= js_str_format(l("Yes, Delete")) ?>',
                'Cancel': '<?= js_str_format(l("Cancel")) ?>',
                'Fill required fields': '<?= js_str_format(l("Fill required fields.")) ?>',
                'Please select at least 2 media album post.': '<?= js_str_format(l("Please select at least 2 media album post.")) ?>',
                'Please select one media for story post.': '<?= js_str_format(l("Please select one media for story post.")) ?>',
                'Please select one media for post.': '<?= js_str_format(l("Please select one media for post.")) ?>',
                'Please select at least one Instagram account.': '<?= js_str_format(l("Please select at least one Instagram account.")) ?>',
                'Oops! An error occured. Please try again later!': '<?= js_str_format(l("Oops! An error occured. Please try again later!")) ?>',
                'Use the TAB key to insert emoji faster': '<?= js_str_format(l('Use the TAB key to insert emoji faster')) ?>',
                'Total Posts': '<?= js_str_format(l("Total Posts")) ?>',
                'Followers': '<?= js_str_format(l("Followers")) ?>',
                'Following': '<?= js_str_format(l("Following")) ?>',
                'Uploading...': '<?= js_str_format(l("Uploading...")) ?>',
                'Do you really want to cancel automatic payments?': '<?= js_str_format(l("Do you really want to cancel automatic payments?")) ?>',
                'Yes, cancel automatic payments': '<?= js_str_format(l("Yes, cancel automatic payments")) ?>',
                'No': '<?= js_str_format(l("No")) ?>',
                'Verification': '<?= js_str_format(l("Verification")) ?>'
            };

            $.fn.datepicker.language['en-US'] = {
                days: ['<?= js_str_format(l("Sunday")) ?>', '<?= js_str_format(l("Monday")) ?>', '<?= js_str_format(l("Tuesday")) ?>', '<?= js_str_format(l("Wednesday")) ?>', '<?= js_str_format(l("Thursday")) ?>', '<?= js_str_format(l("Friday")) ?>', '<?= js_str_format(l("Saturday")) ?>'],
                daysShort: ['<?= js_str_format(l('Sun')) ?>', '<?= js_str_format(l('Mon')) ?>', '<?= js_str_format(l('Tue')) ?>', '<?= js_str_format(l('Wed')) ?>', '<?= js_str_format(l('Thu')) ?>', '<?= js_str_format(l('Fri')) ?>', '<?= js_str_format(l('Sat')) ?>'],
                daysMin: ['<?= js_str_format(l('Su')) ?>', '<?= js_str_format(l('Mo')) ?>', '<?= js_str_format(l('Tu')) ?>', '<?= js_str_format(l('We')) ?>', '<?= js_str_format(l('Th')) ?>', '<?= js_str_format(l('Fr')) ?>', '<?= js_str_format(l('Sa')) ?>'],
                months: ['<?= js_str_format(l('January')) ?>','<?= js_str_format(l('February')) ?>','<?= js_str_format(l('March')) ?>','<?= js_str_format(l('April')) ?>','<?= js_str_format(l('May')) ?>','<?= js_str_format(l('June')) ?>', '<?= js_str_format(l('July')) ?>','<?= js_str_format(l('August')) ?>','<?= js_str_format(l('September')) ?>','<?= js_str_format(l('October')) ?>','<?= js_str_format(l('November')) ?>','<?= js_str_format(l('December')) ?>'],
                monthsShort: ['<?= js_str_format(l('Jan')) ?>', '<?= js_str_format(l('Feb')) ?>', '<?= js_str_format(l('Mar')) ?>', '<?= js_str_format(l('Apr')) ?>', '<?= js_str_format(l('May')) ?>', '<?= js_str_format(l('Jun')) ?>', '<?= js_str_format(l('Jul')) ?>', '<?= js_str_format(l('Aug')) ?>', '<?= js_str_format(l('Sep')) ?>', '<?= js_str_format(l('Oct')) ?>', '<?= js_str_format(l('Nov')) ?>', '<?= js_str_format(l('Dec')) ?>'],
                today: '<?= js_str_format(l('Today')) ?>',
                clear: '<?= js_str_format(l('Clear')) ?>',
                dateFormat: 'mm/dd/yyyy',
                timeFormat: 'hh:ii aa',
                firstDay: 1
            };

            if (typeof $.fn.oneFileManager !== 'undefined') {
                $.fn.oneFileManager.i18n['en-US'] = {
                    selectFiles: '<?= js_str_format(l("Select files")) ?>',
                    loadMoreFiles: '<?= js_str_format(l("Load more")) ?>',
                    viewFile: '<?= js_str_format(l("View")) ?>',
                    deleteFile: '<?= js_str_format(l("Delete")) ?>',
                    urlInputPlaceholder: '<?= js_str_format(l("Paste your link here...")) ?>',

                    emptyVolume: '<?= js_str_format(l("Your media volume is empty. <br /> Drag some files here.")) ?>',
                    dropFilesHere: '<?= js_str_format(l("Drop files here to upload")) ?>',
                    deleteFileConfirm: '<?= js_str_format(l("This file and all uncompleted posts which this file is assigned to will be removed. This process cannot be undone. Do you want to proceed?")) ?>',
                    bigFileSizeError: '<?= js_str_format(l("File size exceeds max allowed file size.")) ?>',
                    fileTypeError: '<?= js_str_format(l("File type is not allowed.")) ?>',
                    noEnoughVolumeError: '<?= js_str_format(l("There is not enough storage to upload this file")) ?>',
                    queueSizeLimit: '<?= js_str_format(l("There are so many files in upload queue. Please try again after current upload queue finishes.")) ?>',
                };
            }
        </script>

        <script src="<?=BASE?>assets/schedule/js/core.js"></script>
        <script src="<?=BASE?>assets/schedule/js/post.js"></script>
        <script type="text/javascript" charset="utf-8">
            $(function(){
                NextPost.Post();
            });
        </script>


        <script>

        $(document).mouseup(function(e)
        {
            var container = $("#locationlist");

            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0)
            {
                container.hide();
            }
        });
        $(document).ready(function(){

            $("#locationlist").hide();
            $('#location').hide();

            <?php if ($Post == '') { ?>

            $("#pac-input").prop('readonly', true);
            $("#pac-input").css("background-color", "#f0f0f0");

            <?php } ?>

            <?php if ($placename == '') { ?>

            $("#pac-input").prop('readonly', true);
            $("#pac-input").css("background-color", "#f0f0f0");

            <?php } ?>


            $(".single").addClass("orange");

            $("#single").click(function(){
                $(".single").addClass("orange");
                $(".multiple").removeClass("orange");
                $(".story").removeClass("orange");
            });

            $("#multiple").click(function(){
                $(".multiple").addClass("orange");
                $(".single").removeClass("orange");
                $(".story").removeClass("orange");
            });

            $("#story").click(function(){
                $(".story").addClass("orange");
                $(".multiple").removeClass("orange");
                $(".single").removeClass("orange");
            });


//        $("#pac-input").click(function(){
            $("#pac-input").on('click touchstart', function () {

//            $("#pac-input").val('');
                $("#pac-input").attr('readonly', false);
                $("#pac-input").css("background-color", "#fff");
//            $("#location").off('change');

                GetLocationOnClick();
            });

//        $("#pac-input").keyup(function(){
//        $("#pac-input").keyup(function(){
            $('#pac-input').on('keyup', function(e) {
//                GetLocationOnClick();
                var loc = $("#pac-input").val();

                var textdata = loc.length;
                if(textdata <= 3){
                    return false;
                }else{
                    GetLocationOnClick();
                }

            });

        });


        function GetLocationOnClick(){
            var loc = $("#pac-input").val();
//    var loc = " ";
            if($("#latitude").val() != ''){
                var lat = $("#latitude").val();
            }else{
                var lat = '43';
            }

            if($("#longitude").val() != ''){

                var lng =  $("#longitude").val();

            }else{
                var lng =  '-75';
            }


//            var lat = $("#lat").val();
//            var lng = $("#long").val();
            var locpath = $("#locpath").text();
            var userid = $('#userid').text();
            $.post(locpath,
                {
//                        'loc': location,
                    'id': userid,
                    'lat': lat,
                    'long': lng,
                    'action': "path",
                    'place' :loc
                },function(data){
                    data = JSON.parse(data);

                    if($("#lat").val() != '' && $("#long").val() != ''){
                        return false;
                    }
//                alert(data);
                    var innerhtml = '';
                    if(data.result == 1){
                        for(var i = 0 ; i < data.msg.length; i++){

                            innerhtml += "<a style='color:#000;font-size:14px;font-weight:600;' class='abc' href='javascript:void(0);' onclick='setlocation(\""+ data.msg[i].name +"\",\""+ data.msg[i].lat +"\",\""+ data.msg[i].lng +"\");' id='locid"+ i +"'><div class='col-md-12' style='border-bottom: 1px solid #f1f1f1; padding:10px;'>" + data.msg[i].name;
//                            innerhtml += "<a style='color:#000;font-size:14px;font-weight:600;' class='abc' href='javascript:void(0);' onclick='setlocation(\""+ data.msg[i].name +"\");' id='locid"+ i +"'><div class='col-md-12' style='border-bottom: 1px solid #f1f1f1; padding:10px;'>" + data.msg[i].name;
                            innerhtml += '</div></a>';
                        }

                    }else{
                        innerhtml += '<div class="col-md-12"><p>No result Found</p>';
                        innerhtml += '</div>';
                    }
                    $("#locationlist").empty();
                    $("#locationlist").append(innerhtml);
                    $("#locationlist").show();

//                $(".abc").click(function(){
//
//                    var count = $(this).attr('id');
//
//                });

                });
        }


        function setlocation(name,lat,lng){
//    function setlocation(name){
            var name = name;
            var lat = lat;
            var lng = lng;
//        alert(name + '--' +lat + '--' +lng);
            $("#pac-input").val("");
            $("#lat").val("");
            $("#long").val("");

            $("#pac-input").val(name);
            $("#lat").val(lat);
            $("#long").val(lng);
            $("#locationlist").hide();
        }

        </script>
 <script src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_API_KEY ?>&callback=initMap&libraries=places">
        </script>
        <script>


            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

          function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: -33.8688, lng: 151.2195},
                    zoom: 13
                });

                geocoder = new google.maps.Geocoder();
                infoWindow = new google.maps.InfoWindow;
                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
//                alert(pos.lat);
//                alert(pos.lng);

//                $("#lat").val(pos.lat);
//                $("#long").val(pos.lng);

//                   $("#latitude").val(pos.lat);
//                    $("#longitude").val(pos.lng);

//                var lat = $("#latitude").val();
//                var lng =  $("#longitude").val();
                        codeLatLng(pos.lat,pos.lng);



                    }, function() {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }

                //   var input = document.getElementById('pac-input');
                //  var autocomplete = new google.maps.places.Autocomplete(input);

//        autocomplete.bindTo('bounds', map);
//
//        var infowindow = new google.maps.InfoWindow();
//        var infowindowContent = document.getElementById('infowindow-content');
//        infowindow.setContent(infowindowContent);
//        var marker = new google.maps.Marker({
//            map: map,
//            anchorPoint: new google.maps.Point(0, -29)
//        });
//
//        autocomplete.addListener('place_changed', function() {
//            infowindow.close();
//            marker.setVisible(false);
//            var place = autocomplete.getPlace();
//            alert(place.geometry.location.lat());
//            alert(place.geometry.location.lng());
////            document.getElementById("lat").setAttribute("type", "text");
////            document.getElementById("long").setAttribute("type", "text");
////            document.getElementById("lat").val(place.geometry.location.lat());
////            document.getElementById("long").val(place.geometry.location.lng());
////            $("#lat").val(place.geometry.location.lat());
////            $("#long").val(place.geometry.location.lng());
//            if (!place.geometry) {
//                window.alert("No details available for input: '" + place.name + "'");
//                return false;
//            }
//        });

            }

            function codeLatLng(lat, lng) {
                var latlng = new google.maps.LatLng(lat, lng);
                geocoder.geocode({'latLng': latlng}, function(results, status) {
                    if(status == google.maps.GeocoderStatus.OK) {
                        console.log(results);

                        if(results[1]) {
                            //formatted address
                            var address = results[0].formatted_address;
//                    alert(results[0].geometry.location.lat());
                            var lat = results[0].geometry.location.lat();
                            var long = results[0].geometry.location.lng();
                            $("#latitude").val(lat);
                            $("#longitude").val(long);
//                    $("#lat").val(lat);
//                    $("#long").val(long);
////                    alert("address = " + address);
////                    alert(lat + "-" + long + "-" + address);
////                    $("#pac-input").val(address);
////                    get_user_location(lat,long,"\"" + address + "\"");
//                    var lat = lat;
//                    var lng =  long;
//                    var locpath = $("#locpath").text();
//                    var userid = $('#userid').text();
////            var loc = $("#pac-input").val();
////                    var loc = address;
////                    alert(lat);
////                    alert(lng);
////                    alert(loc);
//                    $.post(locpath,
//                        {
//                            'id': userid,
//                            'lat': lat,
//                            'long': lng,
//                            'action': "path"
////                            'place' :loc
//
//                        },function(data){
////                            alert(data);
////                    data = JSON.parse(data);
//
////                            alert(JSON.stringify(data));
//
//
//                        });

                        } else {

//                    alert("No results found");
                        }
                    } else {
//                alert("Geocoder failed due to: " + status);
                    }
                });
            }
 
        </script>

    <?php } ?>


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

            // For the Second level Dropdown menu, highlight the parent
            $( ".dropdown-menu" )
                .mouseenter(function() {
                    $(this).parent('li').addClass('active');
                })
                .mouseleave(function() {
                    $(this).parent('li').removeClass('active');
                });

        });

//        $(document).click(function(){
//
//            var isMobileVersion = document.getElementsByClassName('popover-title');
//            if (isMobileVersion.length > 0) {
//
//                setTimeout(function(){
//                    $("[data-toggle=popover]").popover('hide');
//                },5000);
//
//            }
//
//        });
    </script>

    <script>
        window.intercomSettings = {
            app_id: "o8hzmmih",
            name: "<?= session('fullname'); ?>",
            email: "<?= session('username'); ?>",
            created_at: "<?= strtotime(session('user_created')); ?>"
        };
    </script>
    <script>(function(){var w=window;varic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/o8hzmmih';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>

    <script type="text/javascript">
        window._mfq = window._mfq || [];
        (function() {
            var mf = document.createElement("script");
            mf.type = "text/javascript"; mf.async= true;
            mf.src = "//cdn.mouseflow.com/projects/6752dee8-83e2-46a5-a08d-60aaa2e55a89.js";
            document.getElementsByTagName("head")[0].appendChild(mf);
        })();
    </script>
	
</body>

</html>