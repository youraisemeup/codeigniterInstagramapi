<div class="modal fade" id="PopupAddComments" tabindex="-1" role="dialog" style="background-color: #0009;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="defaultModalLabel"><?=l('Add Comments')?></h4>
            </div>
            <div class="modal-body pt0">
                <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                    Add multiple comments at the same time by using comma as delimiter.
                </p>
                <div class="form-group">
                    <div class="form-line box_popup_comments p15">
                        <textarea rows="4" class="form-control no-resize popup_list_comments" placeholder="<?=l('Comments')?>"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn new-blue waves-effect btnAddComnents" style="display: none;text-transform: none !important;"><?=l('Add Comments')?></button>
                <button type="button" class="btn bg-grey waves-effect closebtn" data-dismiss="modal" style="text-transform: none !important;"><?=l('Close')?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $(".popup_list_comments").emojioneArea({
        hideSource: true,
        useSprite: false,
        pickerPosition    : "bottom",
        filtersPosition   : "bottom"
    });

      $(document).on("keyup", ".popup_list_comments", function(){
//          alert(54654);
          $('.btnAddComnents').css('display',"block");
          $('.btnAddComnents').css('margin',"0 auto");
          $('.closebtn').css('display',"none");

      });

  });

</script>