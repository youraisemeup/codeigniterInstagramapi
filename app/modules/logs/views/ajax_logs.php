<?php if(!empty($result)){
foreach ($result as $key => $row) {
    $data = json_decode($row->data);
    switch ($row->type) {
        case 'like':
            $icon = '<i class="fa fa-heart-o" aria-hidden="true"></i>';
            $text = l('Liked media');
            break;
        case 'comment':
            $icon = '<i class="fa fa-comments-o" aria-hidden="true"></i>';
            $text = l('Commented media');
            break;
        case 'follow':
//            $icon = '<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>';
            $icon = '<i class="fa fa-user" aria-hidden="true"></i>';
            $text = l('Followed user');
            break;
        case 'like_follow':
//            $icon = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
            $icon = '<i class="fa fa-user" aria-hidden="true"></i>';
            $text = l('Like + Followed user');
            break;
        case 'unfollow':
            $icon = '<i class="fa fa-user-times" aria-hidden="true"></i>';
//            $icon = '<i class="fa fa-user" aria-hidden="true"></i>';
            $text = l('Unfollowed user');
            break;
        case 'followback':
            $icon = '<i class="fa fa-undo" aria-hidden="true"></i>';
            $text = l('Followed back user');
            break;
        case 'repost':
            $icon = '<i class="fa fa-retweet" aria-hidden="true"></i>';
            $text = l('Reposted media');
            break;
        case 'deletemedia':
            $icon = '<i class="fa fa-trash-o" aria-hidden="true"></i>';
            $text = l('Deleted media');
            break;
    }
?>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <?php if($row->type == "like" || $row->type == "comment" || $row->type == "repost" || $row->type == "deletemedia"){?>
        <div class="item">
            <div class="info">
                <div class="time"><?=time_elapsed_string($row->created)?></div>
                <div class="type">
                    <?=$text?><br/>
                    <span><?=$data->code?></span>
                </div>
            </div>
            <a href="https://www.instagram.com/p/<?=$data->code?>" target="_blank">
                <div class="icon">
                    <?=$icon?>
                </div>
                <?php if(!empty($data->carousel_media)){?>
                    <div class="image" style="background-image: url('<?=$data->carousel_media[0]->image_versions2->candidates[0]->url?>')"></div>
                <?php }else{?>
                    <div class="image" style="background-image: url('<?=$data->image_versions2->candidates[0]->url?>')"></div>
                <?php }?>
            </a>
        </div>
    <?php }else{?>
        <div class="item">
            <div class="info">
                <div class="time"><?=time_elapsed_string($row->created)?></div>
                <div class="type">
                    <?=$text?><br/>
                    <span><?=$data->username?></span>
                </div>
            </div>
            <a href="https://www.instagram.com/<?=$data->username?>" target="_blank">
                <div class="icon">
                    <?=$icon?>
                </div>
                <div class="image" style="background-image: url('<?=$data->profile_pic_url?>')"></div>
            </a>
        </div>
    <?php }?>
</div>
<?php }}?>
