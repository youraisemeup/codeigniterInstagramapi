<div class="modal fade" id="PopupAddUsernames" tabindex="-1" role="dialog" style="background-color: #0009;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="defaultModalLabel"><?=l('Add Usernames')?></h4>
            </div>
            <div class="modal-body pt0">
               <div class="input-group mb0 formSearchPopup">
                    <span class="input-group-btn" style="display: none;">
                      <select name="account" class="form-control account" style="min-width: 120px;">
                        <?php if(!empty($accounts)){
                        foreach ($accounts as $row) {
                        ?>
                          <option value="<?=$row->id?>" <?php if($row->id == $accid){ echo "selected"; }?>><?=$row->username?></option>
                        <?php }}?>
                      </select>
                    </span>
                    <div class="form-line newinput">
                        <input type="text" name="popup_username" class="form-control popup_username" placeholder="<?=l('Username')?>">
                    </div>
                    <span class="input-group-btn">
                      <a class="btn bg-dashboard-primary waves-effect btnSearchUsernames newbutton"><?=l('Search')?></a>
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="ajax_dataSearchUsername">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn new-blue waves-effect btnAddUsernames" style="display: none;text-transform: none !important;"><?=l('Add Usernames')?></button>
                <button type="button" class="btn bg-grey waves-effect closebtn" data-dismiss="modal" style="text-transform: none !important;"><?=l('Close')?></button>
            </div>
        </div>
    </div>
</div>