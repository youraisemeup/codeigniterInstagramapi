<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th><?=l('No.')?></th>
            <th><?=l('Avatar')?></th>
            <th><?=l('ID')?></th>
            <th><?=l('Username')?></th>
            <th><?=l('Fullname')?></th>
            <th><?=l('Followers')?></th>
            <th><?=l('Private')?></th>
            <th><?=l('Verified')?></th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($result)){
        foreach ($result as $key => $row) {
        ?>
        <tr>
            <th scope="row"><?=$key+1?></th>
            <td class="text-center"><img src="<?=$row->profile_pic_url?>" style="max-width: 40px;"></td>
            <td><?=$row->pk?></td>
            <td><a href="https://www.instagram.com/<?=$row->username?>/" target="_blank"><?=$row->username?></a></td>
            <td><?=$row->full_name?></td>
            <td><?=format_number($row->follower_count)?></td>
            <td class="text-center"><?=($row->is_private == 1)?'<i class="fa fa-lock col-orange" aria-hidden="true"></i>':'<i class="fa fa-unlock col-green" aria-hidden="true"></i>'?></td>
            <td class="text-center"><?=($row->is_verified == 1)?'<i class="fa fa-check-circle col-green" aria-hidden="true"></i>':'<i class="fa fa-check-circle col-red" aria-hidden="true"></i>'?></td>
        </tr>
        <?php }}?>
    </tbody>
</table>
