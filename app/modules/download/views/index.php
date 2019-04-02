<form class="formSchedule" action="<?=cn('ajax_search')?>">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header uc">
                    <h2>
                        <i class="fa fa-download col-purple" aria-hidden="true"></i> Instagram download
                    </h2>
                </div>
                <div class="body pb0">
                    <div class="row mb0">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select name="account" class="form-control show-tick">
                                    <?php if(!empty($accounts)){
                                    foreach ($accounts as $row) {
                                    ?>
                                    <option value="<?=$row->id?>"><?=$row->username?></option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="hidden" name="type" class="form-control date" value="download">
                                    <input type="text" name="keyword" class="form-control date" placeholder="<?=l('Link media or media ID')?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <button type="submit" class="btn btn-block btn-lg btn-danger waves-effect btnActionSearch">
                                    <i class="fa fa-search" aria-hidden="true"></i> <?=l('Search')?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p0 ajax_data_search table-responsive">
                    
                </div>
            </div>
        </div> 
    </div>
</form>
