<div class="vttags">
	<?php if(!empty($result)){
	foreach ($result as $row) {
	?>
    <div class="item" data-id="<?=$row->getPk()?>" data-username="<?=$row->getUsername()?>">
        <input type="checkbox" id="md_checkbox_<?=$row->getUsername()?>" class="filled-in chk-col-blue" />
        <label for="md_checkbox_<?=$row->getUsername()?>" style="position: absolute;right: -30px;top: 7px;">&nbsp;</label>
        <img src="<?=$row->getProfilePicUrl()?>">
        <a href="https://www.instagram.com/<?=$row->getUsername()?>" target="_blank"><?=$row->getUsername()?> (<?=format_number($row->getFollowerCount())?>)<a>
        <div class="icon-tag"></div>
    </div>
    <?php }}?>
</div>		