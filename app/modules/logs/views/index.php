<div class="logs">
    <?= $this->common_model->instagram_activity_header(); ?>
<!--    <h3 class="mt0 col-light-green">--><?//=l('Activity Log')?><!--</h3>-->
    <h3 class="mt0 col-black"><?=l('Activity Log')?></h3>
    <div class="box_tab_log_list">
        <ul class="nav nav-tabs tab-nav-right tab_logs_list" role="tablist">
            <li role="presentation" class="<?=get("action")==''?'active':''?>"><a href="<?=url("logs")?>" style="color: #0d509f !important;"><?=l('All')?></a></li>
            <li role="presentation" class="<?=get("action")=='like'?'active':''?>"><a href="<?=url("logs?action=")?>like&account=<?=(int)get("account")?>" style="color: #0d509f !important;"><?=l('Like')?></a></li>
            <li role="presentation" class="<?=get("action")=='comment'?'active':''?>"><a href="<?=url("logs?action=")?>comment&account=<?=(int)get("account")?>" style="color: #0d509f !important;"><?=l('Comment')?></a></li>
            <li role="presentation" class="<?=get("action")=='follow'?'active':''?>"><a href="<?=url("logs?action=")?>follow&account=<?=(int)get("account")?>" style="color: #0d509f !important;"><?=l('Follow')?></a></li>
            <li role="presentation" class="<?=get("action")=='unfollow'?'active':''?>"><a href="<?=url("logs?action=")?>unfollow&account=<?=(int)get("account")?>" style="color: #0d509f !important;"><?=l('Unfollow')?></a></li>
			<?php /*<li role="presentation" class="<?=get("action")=='like_follow'?'active':''?>"><a href="<?=url("logs?action=")?>like_follow&account=<?=(int)get("account")?>"><?=l('Like + Folow')?></a></li>
            <li role="presentation" class="<?=get("action")=='followback'?'active':''?>"><a href="<?=url("logs?action=")?>followback&account=<?=(int)get("account")?>"><?=l('Follow Back')?></a></li>
            
            <li role="presentation" class="<?=get("action")=='repost'?'active':''?>"><a href="<?=url("logs?action=")?>repost&account=<?=(int)get("account")?>"><?=l('Repost media')?></a></li>
            <li role="presentation" class="<?=get("action")=='deletemedia'?'active':''?>"><a href="<?=url("logs?action=")?>deletemedia&account=<?=(int)get("account")?>"><?=l('Delete Media')?></a></li>
			*/?>
		</ul>
    </div>
    <div class="clearfix"></div>
    <div class="logs_filter" style="display:none;">
        <div class="row">
            <div class="col-md-2 col-sm-3">
                <form>
                    <input type="hidden" name="action" value="<?=get("action")?>"/>
                    <select name="account" class="logs_accounts form-control show-tick">
                        <option value=""><?=l('All accounts')?></option>
                        <?php if(!empty($accounts)){
                        foreach ($accounts as $row) {
                        ?>
                        <option value="<?=$row->id?>" <?=(int)get("account")==$row->id?'selected':''?> ><?=$row->username?></option>
                        <?php }}?>
                    </select>
                </form>
            </div>
            <div class="col-md-10 col-sm-9">
                <p class="lead mb0 text-right">
<!--                    <span class="col-red">--><?//=$result?><!--</span> <span class="col-grey">--><?//=l('results')?><!--</span>-->
                    <span class="col-black"><?=$result?></span> <span class="col-grey"><?=l('results')?></span>
                </p>
            </div>
        </div>
    </div>
    <?php if($result == 0){?>
    <div class="logs_empty">
        <i class="fa fa-chain-broken" aria-hidden="true"></i>
        <div class="text"><?=l('No recent actions')?></div>
    </div>
    <?php }else{?>
    <div class="logs_list row">
        <div class="logs_load" data-page="0" data-action="<?=cn("ajax_page")?>" data-type="<?=get("action")?>"></div>
    </div>
    <?php }?>
</div>
