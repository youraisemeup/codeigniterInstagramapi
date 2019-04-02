<div class="modal fade" id="PopupAddTags" tabindex="-1" role="dialog" style="background-color: #0009;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="defaultModalLabel"><?=l('Add Hashtags')?></h4>
            </div>
            <div class="modal-body pt0">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="profile">
                        <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                            Add multiple hashtags at the same time by using comma as delimiter.
                        </p>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="4" class="form-control no-resize popup_list_tags" placeholder="<?=l('Hashtags')?>"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn new-blue waves-effect btnAddBlacklistTags" style="display: none;text-transform: none !important;"><?=l('Add Hashtags')?></button>
                <button type="button" class="btn bg-grey waves-effect closebtn" data-dismiss="modal" style="text-transform: none !important;"><?=l('Close')?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).on("keyup", ".popup_list_tags", function(){
//          alert(54654);
        $('.btnAddBlacklistTags').css('display',"block");
        $('.btnAddBlacklistTags').css('margin',"0 auto");
        $('.closebtn').css('display',"none");

    });
</script>