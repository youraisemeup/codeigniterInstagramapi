<form class="formListModule" action="<?=cn('ajax_action_multiple')?>">
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-user" aria-hidden="true"></i> <?=l('User management')?>
                    </h2>
                </div>
                <div class="header">
                    <div class="form-inline">
                        <div class="btn-group" role="group">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn bg-red waves-effect orange_action dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?=l('Action')?>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="btnActionModule" data-action="active" href="javascript:void(0);"><?=l('Activate')?></a></li>
                                    <li><a class="btnActionModule" data-action="disable" href="javascript:void(0);"><?=l('Deactivate')?></a></li>
                                    <li><a class="btnActionModule" data-action="delete" data-confirm="<?=l('Are you sure you want to delete this items?')?>" href="javascript:void(0);"><?=l('Delete')?></a></li>
                                </ul>
                            </div>
                            <a href="<?=cn('update')?>" class="btn bg-light-green blue_add waves-effect"><i class="fa fa-plus" aria-hidden="true"></i> <?=l('Add new')?></a>
                        </div>
                    </div>
                </div>
                <div class="body p0">
                    <table class="table table-bordered table-striped table-hover js-dataTableSchedule mb0">
                        <thead>
                            <tr>
                                <th style="width: 10px;">
                                    <input type="checkbox" id="md_checkbox_211" class="filled-in chk-col-red checkAll">
                                    <label class="p0 m0" for="md_checkbox_211">&nbsp;</label>
                                </th>
                                <th><?=l('Admin')?></th> 
                                <th><?=l('Type')?></th> 
                                <th><?=l('Fullname')?></th>
                                <th><?=l('Email')?></th>
                                <th><?=l('PayPal Email')?></th>
                                <th><?=l('Package')?></th>
                                <th><?=l('Expiration date')?></th>
                                <th><?=l('Timezone')?></th>
                                <th><?=l('Status')?></th>
                                <th><?=l('Changed')?></th>
                                <th><?=l('Created')?></th>
                                <th><?=l('Option')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(!empty($result)){
                            foreach ($result as $key => $row) {
                            ?>
                            <tr class="pending" data-action="<?=cn('ajax_action_item')?>" data-id="<?=$row->id?>">
                                <td>
                                    <input type="checkbox" name="id[]" id="md_checkbox_<?=$key?>" class="filled-in chk-col-red checkItem" value="<?=$row->id?>">
                                    <label class="p0 m0" for="md_checkbox_<?=$key?>">&nbsp;</label>
                                </td>
                                <td><?=($row->admin == 1)?l("Yes"):l("No")?></td>
                                <td><?=$row->type?></td>
                                <td><?=$row->fullname?></td>
                                <td><?=$row->email?></td>
                                <td><?=$row->paypal_email?></td>
                                <td><?=(isset($row->package_name))?$row->package_name:l('No package')?></td>
                                <td><?=$row->expiration_date?></td>
                                <td><?=$row->timezone?></td>
                                <td style="width: 60px;">
                                    <div class="switch">
                                        <label><input type="checkbox" class="btnActionModuleItem" <?=$row->status==1?"checked":""?>><span class="lever switch-col-light-blue"></span></label>
                                    </div>
                                </td>
                                <td><?=date("h:i Y/m/d", strtotime($row->changed))?></td>
                                <td><?=date("h:i Y/m/d", strtotime($row->created))?></td>
                                <td style="width: 80px;">
                                    <?php if($row->admin != 1) { ?>
                                    <button type="button" style="width:34% !important;" class="btn bg-light-green waves-effect blue_add btnActionViewUser" data-type="viewUser" data-action="<?=cn('ajax_action_view_user')?>"><?=l("View user")?></button>

                                    <?php } ?>                                
                                    <div class="btn-group" role="group">
                                        <a href="<?=cn('update?id='.$row->id)?>" style="width:34% !important;" class="btn blue_add bg-light-green waves-effect"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <button type="button" style="width:34% !important;" class="btn blue_add bg-light-green waves-effect btnActionModuleItem" data-action="delete" data-confirm="<?=l('Are you sure you want to delete this item?')?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php }}?>
                        </tbody>
                    </table>   
                </div>
            </div>
        </div>
    </div>
</form>