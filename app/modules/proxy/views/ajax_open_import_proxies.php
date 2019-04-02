<div class="modal fade" id="PopupImportProxies" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-grey">
                    <h4 class="modal-title" id="defaultModalLabel"><?=l('Import Proxies')?></h4>
                </div>
                <div class="modal-body pt0">
                    <div class="form-group">
                        <div class="form-line p15">
							<label>Select XLS or CSV file to import</label>
							<input type="file" name="import_proxies" class="form-control popup_import" placeholder="" />
                            <!--<textarea rows="8" name="import_proxies" class="form-control popup_import" placeholder="<?=l('Enter Proxies (Example: ProxyName,Proxy;)')?>"></textarea>-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background: #F5F5F5;">
                    <button type="submit" class="btn bg-light-green waves-effect"><?=l('Import')?></button>
                    <button type="button" class="btn bg-grey waves-effect" data-dismiss="modal"><?=l('Close')?></button>
                </div>
            </form>
        </div>
    </div>
</div>
