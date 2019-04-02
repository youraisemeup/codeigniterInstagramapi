<form class="ScheduleList" action="<?=cn('ajax_action_multiple')?>">
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header"> 
                    <h2>
                        <i class="fa fa-bars" aria-hidden="true"></i> <?=l('Schedules')?>
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
                            <a class="btn bg-grey waves-effect btnActionModule" data-action="delete_all" data-categoty="<?=segment(2)?>" data-confirm="<?=l('Are you sure you want to delete all items?')?>" href="javascript:void(0);">
                                <?=l('Delete all')?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="body p0">
                    <table class="table table-bordered table-striped table-hover js-dataTableScheduleAjax dataTable mb0">
                        <thead>
                            <tr>
                                <th style="width: 10px;">
                                    <input type="checkbox" id="md_checkbox_all" class="filled-in chk-col-red checkAll">
                                    <label class="p0 m0" for="md_checkbox_all">&nbsp;</label>
                                </th>
                                <th><?=l('Account')?></th>
                                <th><?=l('Name')?></th>
                                <th><?=l('Type')?></th>
                                <th><?=l('Time Post')?></th>
                                <th><?=l('Repeat Post')?></th>
                                <th><?=l('Status')?></th>
                                <th><?=l('Created')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>