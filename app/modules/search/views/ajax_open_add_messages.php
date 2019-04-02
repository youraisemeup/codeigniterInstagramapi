<div class="modal fade" id="PopupAddMessages" tabindex="-1" role="dialog" style="background-color: #0009;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="defaultModalLabel"><?=l('Add Messages')?></h4>
            </div>
            <div class="modal-body pt0">
                <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                    Add multiple messages at the same time by using semicolon as delimiter.
                </p>
                <div class="form-group">
                    <div class="form-line box_popup_comments p15">
                        <textarea rows="4" class="form-control no-resize popup_list_messages" placeholder="<?=l('Messages')?>"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn new-blue waves-effect btnAddMessages" style="display: none;text-transform: none !important;"><?=l('Add Messages')?></button>
                <button type="button" class="btn bg-grey waves-effect closebtn" data-dismiss="modal" style="text-transform: none !important;"><?=l('Close')?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $(".popup_list_messages").emojioneArea({
        hideSource: true,
        useSprite: false,
        pickerPosition    : "bottom",
        filtersPosition   : "bottom"
    });
  });

  $(document).on("keyup", ".popup_list_messages", function(){
//          alert(54654);
      $('.btnAddMessages').css('display',"block");
      $('.btnAddMessages').css('margin',"0 auto");
      $('.closebtn').css('display',"none");

  });
</script>