<div class="row dashboard">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel-group full-body" id="accordion_23" role="tablist" aria-multiselectable="true">
            <div class="panel panel-settings mb20" style="background-color: transparent;">
                <div class="panel-heading" role="tab" id="headingThree_23">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_23" aria-expanded="false" aria-controls="collapseThree_23">
                            <?=l('AFFILIATE REPORT')?>
                        </a>
                    </h4>
                </div>
                <div id="collapseThree_23" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_23" aria-expanded="true">
                    <div class="panel-body row mb0 pb0">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="info-box-2">
                                    <div class="icon">
                                        <i class="material-icons col-dark-blue">supervisor_account</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Total Referrals')?></div>
                                        <div class="number"><?=$referralCounts['total_referrals']?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="info-box-2">
                                    <div class="icon">
                                        <i class="material-icons col-dark-blue">query_builder</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Total Pending Referrals')?></div>
                                        <div class="number"><?=$referralCounts['pending_referrals']?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="info-box-2">
                                    <div class="icon">
                                        <i class="material-icons col-dark-blue">check_circle</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Total Paid Referrals')?></div>
                                        <div class="number"><?=$referralCounts['paid_referrals']?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="info-box-2">
                                    <div class="icon">
                                        <i class="material-icons col-dark-blue">highlight_off</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Total Unpaid Referrals')?></div>
                                        <div class="number"><?=$referralCounts['unpaid_referrals']?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="info-box-2">
                                    <div class="icon">
                                        <i class="material-icons col-dark-blue">monetization_on</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Total Earnings')?></div>
                                        <div class="number">$<?=$referralCounts['total_earning']?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="info-box-2">
                                    <div class="icon">
                                        <i class="material-icons col-dark-blue">screen_share</i>
                                    </div>
                                    <div class="content">
                                        <div class="text uc"><?=l('Total Referral Spends')?></div>
                                        <div class="number">$<?=$referralCounts['total_referral_spends']?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<form class="ScheduleList" action="<?=cn('ajax_action_multiple')?>">
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-usd" aria-hidden="true"></i> <?=l('User Referrals')?>
                    </h2>
                </div>
                <div class="header">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-inline">
                                <div class="btn-group" role="group">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn bg-red waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?=l('Action')?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="btnActionModule" data-action="confirm" data-confirm="<?=l('Are you sure you want to confirm all pending referrals of all selected users?')?>" href="javascript:void(0);"><?=l('Confirm')?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pull-right">
                            <div id="affiliate-range" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                <span></span> <b class="caret"></b>
                                <input type="hidden" name="date_range">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="body p0">
                    <table class="table table-bordered table-striped table-hover js-dataTable dataTable mb0 affiliate-table">
                        <thead>
                            <tr>
                                <th style="width: 10px;">
                                    <input type="checkbox" id="md_checkbox_211" class="filled-in chk-col-red checkAll">
                                    <label class="p0 m0" for="md_checkbox_211">&nbsp;</label>
                                </th>
                                <th><?=l('Name')?></th>
                                <th><?=l('Email')?></th>
                                <th><?=l('Paypal Email')?></th>
                                <th><?=l('Paid Amount')?></th>
                                <th><?=l('Unpaid Amount')?></th>
                                <th><?=l('Cancelled Referrals')?></th>
                                <th><?=l('Pending Referrals')?></th>
                                <th><?=l('Paid Referrals')?></th>
                                <th><?=l('Unpaid Referrals')?></th>
                                <th><?=l('Action')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(!empty($usersReferrals)){
                            foreach ($usersReferrals as $key => $row) {
                            ?>
                            <tr class="pending" data-action="<?=cn('ajax_action_item')?>" data-id="<?=$row['id']?>">
                                <td>
                                    <input type="checkbox" name="id[]" id="md_checkbox_<?=$key?>" class="filled-in chk-col-red checkItem" value="<?=$row['id']?>">
                                    <label class="p0 m0" for="md_checkbox_<?=$key?>">&nbsp;</label>
                                </td>
                                <td><?=$row['fullname']?></td>
                                <td><?=$row['email']?></td>
                                <td><?=$row['paypal_email']?></td>
                                <td>$<?=$row['paid_referrals_amount']?></td>
                                <td>$<?=$row['unpaid_referrals_amount']?></td>
                                <td class="details-control" data-type="cancelled">
                                    <button type="button" class="btn bg-deep-orange waves-effect">
                                        <?=$row['cancelled_referrals']?>
                                    </button>
                                </td>
                                <td class="details-control" data-type="pending">
                                    <button type="button" class="btn bg-yellow waves-effect">
                                        <?=$row['pending_referrals']?>
                                    </button>
                                </td>
                                <td class="details-control" data-type="paid">
                                    <button type="button" class="btn bg-light-green waves-effect">
                                        <?=$row['paid_referrals']?>
                                    </button>
                                </td>
                                <td class="details-control" data-type="unpaid">
                                    <button type="button" class="btn bg-light-blue waves-effect">
                                        <?=$row['unpaid_referrals']?>
                                    </button>
                                </td>
                                <td style="width: 80px;">
                                    <?php if ($row['unpaid_referrals'] > 0) { ?>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn bg-light-green waves-effect btnActionModuleItem" data-action="confirm" data-confirm="<?=l('Are you sure you want to confirm all pending referrals of ' .$row['fullname']. '?')?>"><i class="fa fa-check" aria-hidden="true"></i> Confirm</button>
                                    </div>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php }}?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong style="float: right">Total</strong></td>
                                <td><strong>$<?=$tableFooter['totalPaidAmount']?></strong></td>
                                <td><strong>$<?=$tableFooter['totalUnpaidAmount']?></strong></td>
                                <td><strong><?=$tableFooter['totalCancelledReferrals']?></strong></td>
                                <td><strong><?=$tableFooter['totalPendingReferrals']?></strong></td>
                                <td><strong><?=$tableFooter['totalPaidReferrals']?></strong></td>
                                <td><strong><?=$tableFooter['totalUnpaidReferrals']?></strong></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </table>
            </div>
        </div>
    </div>
</form>

<script>
    let referrals       = <?=json_encode($userWise)?>;
    let dateRangePicker = <?=json_encode($dateRangePicker)?>;
</script>