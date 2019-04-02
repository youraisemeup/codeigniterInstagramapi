<div class="vttags">
	<?php if(!empty($result)){
	foreach ($result as $row) {
	?>
    <div class="item" data-name="<?=$row->getName()?>" data-location="<?=$row->getName()."|".$row->getLat()."|".$row->getLng()."|".$row->getExternalId()?>">
        <input type="checkbox" id="md_checkbox_<?=$row->getName()?>" class="filled-in chk-col-blue" />
        <label for="md_checkbox_<?=$row->getName()?>" style="position: absolute;right: -30px;top: 7px;">&nbsp;</label>
        <a href="https://www.instagram.com/explore/locations/<?=$row->getExternalId()?>" target="_blank"><?=$row->getName()?></a>
        <div class="icon-tag"></div>
    </div>
    <?php }}?>
</div>		