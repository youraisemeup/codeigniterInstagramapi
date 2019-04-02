<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th><?=l('No.')?></th>
            <th><?=l('ID')?></th>
            <th><?=l('Name')?></th>
            <th><?=l('Media count')?></th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($result)){
        foreach ($result as $key => $row) {
        ?>
        <tr>
            <th scope="row"><?=$key+1?></th>
            <td><?=$row->id?></td>
            <td><a href="https://www.instagram.com/explore/tags/<?=$row->name?>/" target="_blank"><?=$row->name?></a></td>
            <td><?=format_number($row->media_count)?></td>
        </tr>
        <?php }}?>
    </tbody>
</table>
