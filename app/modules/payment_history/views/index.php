<form class="formListModule" action="<?=cn('ajax_action_multiple')?>">
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php if(hashcheck()){?>
            <div class="alert alert-danger">
                <?=l("You need Extended License to your users can payment via paypal to use")?>
            </div>
            <?php }?>
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-history" aria-hidden="true"></i> <?=l('Payment history')?>
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
                                    <li><a class="btnActionModule" data-action="delete" data-confirm="<?=l('Are you sure you want to delete this items?')?>" href="javascript:void(0);"><?=l('Delete')?></a></li>
                                </ul>
                            </div>
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
                                <th><?=l('User')?></th> 
                                <th><?=l('Invoice')?></th> 
                                <th><?=l('First name')?></th>
                                <th><?=l('Last name')?></th>
                                <th><?=l('Receiver email')?></th>
                                <th><?=l('Payer email')?></th>
                                <th><?=l('Package')?></th>
                                <th><?=l('Price')?></th>
                                <th><?=l('Currency')?></th>
                                <th><?=l('Street')?></th>
                                <th><?=l('City')?></th>
                                <th><?=l('Country')?></th>
                                <th><?=l('Payment date')?></th>
                                <th><?=l('Payment status')?></th>
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
                                <td><a href="<?=url('user_management/update?id='.$row->uid)?>"><?=$row->user?></a></td> 
                                <td><?=$row->invoice?></td> 
                                <td><?=$row->first_name?></td>
                                <td><?=$row->last_name?></td>
                                <td><?=$row->receiver_email?></td>
                                <td><?=$row->payer_email?></td>
                                <td><?=$row->item_name?></td>
                                <td><?=$row->mc_gross?></td>
                                <td><?=$row->mc_currency?></td>
                                <td><?=$row->address_street?></td>
                                <td><?=$row->address_city?></td>
                                <td><?=$row->address_country?></td>
                                <td><?=$row->payment_date?></td>
                                <td><?=$row->payment_status?></td>
                                <td style="width: 80px;">
                                    <div class="btn-group" role="group">
                                        <a href="<?=cn('update?id='.$row->id)?>" class="btn bg-light-green waves-effect" style="padding: 6px 20px;font-size: 13px !important;text-align: center;width: 30% !important;"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <button type="button" style="padding: 6px 20px;font-size: 13px !important;text-align: center;width: 50% !important;" class="btn bg-light-green waves-effect btnActionModuleItem" data-action="delete" data-confirm="<?=l('Are you sure you want to delete this item?')?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
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