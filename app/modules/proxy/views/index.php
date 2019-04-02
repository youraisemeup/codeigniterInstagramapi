<form class="ScheduleList" action="<?=cn('ajax_action_multiple')?>">
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-deaf" aria-hidden="true"></i> <?=l('Proxy management')?>
                    </h2>
                </div>
                <div class="header">
                    <div class="form-inline">
                        <div class="btn-group" role="group">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn bg-red waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?=l('Action')?>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="btnActionModule" data-action="active" href="javascript:void(0);"><?=l('Active')?></a></li>
                                    <li><a class="btnActionModule" data-action="disable" href="javascript:void(0);"><?=l('Deactivate')?></a></li>
                                    <li><a class="btnActionModule" data-action="delete" data-confirm="<?=l('Are you sure you want to delete this items?')?>" href="javascript:void(0);"><?=l('Delete')?></a></li>
                                    <li><a class="btnActionModule" data-action="verify" href="javascript:void(0);"><?=l('Verify')?></a></li>
                                </ul>
                            </div>
                            <a href="<?=cn('update')?>" style="padding: 6px 20px;font-size: 16px !important;text-align: center;width: 30% !important;" class="btn bg-light-green waves-effect"><i class="fa fa-plus" aria-hidden="true"></i> <?=l('Add new')?></a>
                            <a class="btn bg-light-blue waves-effect btnOpenImportProxies"><i class="fa fa-upload" aria-hidden="true"></i> <?=l('Import')?></a>
                            <a href="<?= BASE.'index.php/proxy/applyproxy' ?>" class="btn bg-orange waves-effect" ><?=l('Apply Proxy')?></a>
                        </div>
<!--                        <div class="btn-group m-t-5 m-l-20">-->
<!--                            <input type="checkbox" name="proxy-filter" id="md_checkbox_filter" class="filled-in chk-col-red checkItem">-->
<!--                            <label class="" for="md_checkbox_filter">Proxy with error</label>-->
<!--                        </div>-->
                        <div class="btn-group m-t-5 m-l-20">
                            <div class="switch" style="width: 200px;">
                                <label><input type="checkbox" name="proxy-filter"><span class="lever switch-col-light-blue"></span>Proxy with error</label>
                            </div>
                        </div>
                        <div class="dataTable-custom-buttons pull-right">
                        </div>
                    </div>
                </div>
                <div class="body p0">
                    <table class="table table-bordered table-striped table-hover js-dataTable dataTable mb0" style="text-align: center;">
                        <thead>
                            <tr>
                                <th style="width: 10px;">
                                    <input type="checkbox" id="md_checkbox_211" class="filled-in chk-col-red checkAll">
                                    <label class="p0 m0" for="md_checkbox_211">&nbsp;</label>
                                </th>
                                <th><?=l('Name')?></th>
                                <th><?=l('Proxy')?></th>
                                <th><?=l('Instagram Accounts')?></th>
                                <th><?=l('Created')?></th>
                                <th><?=l('Changed')?></th>
                                <th><?=l('Working')?></th>
                                <th><?=l('Status')?></th>
                                <th><?=l('Option')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(!empty($result)){
                            foreach ($result as $key => $row) {
                            ?>
                            <tr class="pending" data-action="<?=cn('ajax_action_item')?>" data-id="<?=$row['id']?>">
                                <td>
                                    <input type="checkbox" name="id[]" id="md_checkbox_<?=$key?>" class="filled-in chk-col-red checkItem" value="<?=$row['id']?>">
                                    <label class="p0 m0" for="md_checkbox_<?=$key?>">&nbsp;</label>
                                </td>
                                <td><?=$row['name']?></td>
                                <td><?=$row['proxy']?></td>
                                <td><?=$row['ig_accounts']?><a href="#" data-toggle="modal" class="btnActionViewProxyDetail" data-target="#proxyDetail"> <?=l("(View Detail)")?></a></td>
                                <td><?=date("h:i Y/m/d", strtotime($row['created']))?></td>
                                <td><?=date("h:i Y/m/d", strtotime($row['changed']))?></td>
                                <td class="text-center">
                                    <i class="fa <?=$row['is_working'] ? 'fa-check-circle text-success' : 'fa-times-circle text-danger'?> font-26" aria-hidden="true"><span class="hide"><?=$row['is_working'] ? 'Proxy working' : 'Proxy error'?></span></i>
                                </td>
                                <td style="width: 60px;">
                                    <div class="switch">
                                        <label><input type="checkbox" class="btnActionModuleItem" <?=$row['status']==1?"checked":""?>><span class="lever switch-col-light-blue"></span></label>
                                    </div>
                                </td>
                                <td style="width: 120px;">
                                    <div class="btn-group" role="group">
                                        <button type="button" style="padding: 6px 20px;font-size: 13px !important;text-align: center;width: 30% !important;" class="btn bg-light-green waves-effect btnActionModuleItem" data-action="verify"><i class="fa fa-check" aria-hidden="true"></i></button>
                                        <a href="<?=cn('update?id='.$row['id'])?>" style="padding: 6px 20px;font-size: 13px !important;text-align: center;width: 30% !important;" class="btn bg-light-green waves-effect"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <button type="button" style="padding: 6px 20px;font-size: 13px !important;text-align: center;width: 30% !important;" class="btn bg-light-green waves-effect btnActionModuleItem" data-action="delete" data-confirm="<?=l('Are you sure you want to delete this item?')?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
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

<!--Modal Proxy Detail-->
<div id="proxyDetail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="modal-header bg-owner" style="margin-bottom: 0px;padding-bottom: 0px;text-align: center;">
                        <button type="button" class="close btnActionCloseProxyDetail" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><?=l('List of instagram accounts on proxy')?></h3>
                    </div>
                    <div class="body table-responsive" style="padding: 4px 0px 20px;">
                        <hr>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th >No.</th>
                                    <th ><?=l('Instagram Accounts')?></th>
                                    <th ><?=l('Username')?></th>
                                    <th ><?=l('email')?></th>
                                    <th ><?=l('status')?></th>
                                </tr>
                            </thead>
                            <tbody id="proxy_list">
                                <!-- Insert proxy list -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
//    function applyproxy(){
//        var newdata = {
//            uid : <?php// echo $this->session->userdata('uid'); ?>
//        }
//        $.ajax({
//            url: <?php// echo BASE.'index.php/proxy/applyproxy' ?>//,
//            data: newdata,
//            processData: false,
//            type: 'POST',
//            success: function ( data ) {
//                alert( data );
//            }
//        });
//    }
</script>
