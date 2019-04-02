<div class="row dashboard">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box-2 hover-zoom-effect">
            <div class="icon">
                <i class="material-icons col-<?=THEME?>">contacts</i>
            </div>
            <div class="content">
                <div class="text uc"><?=l('Account')?></div>
                <div class="number"><?=$group->profile?></div>
            </div>
        </div>

        <div class="panel-group full-body" id="accordion_23" role="tablist" aria-multiselectable="true">
            <div class="panel panel-settings mb20" style="background-color: transparent;">
                <div class="panel-heading" role="tab" id="headingThree_23">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_23" aria-expanded="false" aria-controls="collapseThree_23">
                            <?=l('ACTIVITY REPORT')?>
                        </a>
                    </h4>
                </div>
                <div id="collapseThree_23" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_23" aria-expanded="true">
                    <div class="panel-body row mb0 pb0">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-pink">favorite</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Likes')?></div>
                                        <div class="number"><?=$activity->like_count?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-purple">comment</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Comments')?></div>
                                        <div class="number"><?=$activity->comment_count?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-light-green">thumb_up</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Follows')?></div>
                                        <div class="number"><?=$activity->follow_count?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-light-blue">thumbs_up_down</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Follows back')?></div>
                                        <div class="number"><?=$activity->followback_count?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-blue-grey">thumb_down</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Unfollow')?></div>
                                        <div class="number"><?=$activity->unfollow_count?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-teal">cached</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Repost')?></div>
                                        <div class="number"><?=$activity->repost_count?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-orange">delete_forever</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Delete media')?></div>
                                        <div class="number"><?=$activity->deletemedia_count?></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-group full-body" id="accordion_22" role="tablist" aria-multiselectable="true">
            <div class="panel panel-settings mb20" style="background-color: transparent;">
                <div class="panel-heading" role="tab" id="headingThree_22">
                    <h4 class="panel-title">
                        <a class="collapsed uc" role="button" data-toggle="collapse" href="#collapseThree_22" aria-expanded="false" aria-controls="collapseThree_22">
                            <?=l('Post Report')?>
                        </a>
                    </h4>
                </div>
                <div id="collapseThree_22" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_22" aria-expanded="true">
                    <div class="panel-body row mb0 pb0">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-orange">send</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Total process')?></div>
                                        <div class="number"><?=($post->total >= 10000)?"10000+":$post->total?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-light-green">beenhere</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l("Total success")?></div>
                                        <div class="number"><?=($post->success >= 10000)?"10000+":$post->success?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-red">sms_failed</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l("Total failure")?></div>
                                        <div class="number"><?=($post->failure >= 10000)?"10000+":$post->failure?></div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-blue ">layers</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l("Total processing")?></div>
                                        <div class="number"><?=($post->processing >= 10000)?"10000+":$post->processing?></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-group full-body" id="accordion_24" role="tablist" aria-multiselectable="true">
            <div class="panel panel-settings mb20" style="background-color: transparent;">
                <div class="panel-heading" role="tab" id="headingThree_24">
                    <h4 class="panel-title">
                        <a class="collapsed uc" role="button" data-toggle="collapse" href="#collapseThree_24" aria-expanded="false" aria-controls="collapseThree_24">
                            <?=l('Message Report')?>
                        </a>
                    </h4>
                </div>
                <div id="collapseThree_24" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_24" aria-expanded="true">
                    <div class="panel-body row mb0 pb0">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-orange">send</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Total process')?></div>
                                        <div class="number"><?=($message->total >= 10000)?"10000+":$message->total?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-light-green">beenhere</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l("message success")?></div>
                                        <div class="number"><?=($message->success >= 10000)?"10000+":$message->success?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-red">sms_failed</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l("message failure")?></div>
                                        <div class="number"><?=($message->failure >= 10000)?"10000+":$message->failure?></div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box-2 hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons col-blue">layers</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l("message processing")?></div>
                                        <div class="number"><?=($message->processing >= 10000)?"10000+":$message->processing?></div>
                                        
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
