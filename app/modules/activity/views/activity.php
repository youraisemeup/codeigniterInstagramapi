    <style>
        /*#sticky {*/
            /*padding: 0.5ex;*/
            /*width: 100%;*/
            /*background-color: #333;*/
            /*color: #fff;*/
            /*font-size: 2em;*/
            /*border-radius: 0.5ex;*/
        /*}*/

        #UpdateAlert.stick {
            position: fixed;
            top: 0;
            z-index: 10000;
            width: 84.5%;
            /*border-radius: 0 0 0.5em 0.5em;*/
        }

        @media only screen and (max-width: 560px) and (min-width: 280px){
            #UpdateAlert.stick {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 760px) and (min-width: 561px){
            #UpdateAlert.stick {
                width: 95.5%;
            }
        }

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

        /*.slider_go:hover{color: #fff; text-decoration: none;}*/
        /*a:focus, a:hover {*/
            /*color: #fff;*/
            /*text-decoration: none;*/
        /*}*/

        /*body {*/
            /*margin: 1em;*/
        /*}*/

        /*p {*/
            /*margin: 1em auto;*/
        /*}*/
    </style>

<div class="row SchedulesListActivity activity-page rowadjust" data-action="<?=url("schedules/ajax_enable_activity")?>">
        <div id="sticky-anchor"></div>
        <div class="updatealert" id="UpdateAlert" hidden="" style="font-size: 16px;">
            <span class="label label-warning" style="font-size: 16px;">Important</span> You updated your settings. To apply the new settings, you need to restart (stop + start) your Activity.
        </div>
        <?= $this->common_model->instagram_activity_header(); ?>

    </div>
    <?php include('update.php') ?>
