<div class="vttags">
	<?php if(!empty($result)){
	foreach ($result as $row) {
	?>
    <div class="item" data-tag="<?=$row->getName()?>">
        <input type="checkbox" id="md_checkbox_<?=$row->getName()?>" class="filled-in chk-col-blue" />
        <label for="md_checkbox_<?=$row->getName()?>" style="position: absolute;right: -30px;top: 7px;">&nbsp;</label>
        <?=$row->getName()?> (<?=format_number($row->getMediaCount())?>)
        <div class="icon-tag"></div>
    </div>
    <?php }}?>
</div>		