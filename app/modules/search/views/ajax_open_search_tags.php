<div class="modal fade" id="PopupAddTags" tabindex="-1" role="dialog" style="background-color: #0009;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="defaultModalLabel"><?=l('Add Hashtags')?></h4>
            </div>
            <div class="modal-body pt0">
                <!-- Nav tabs -->
<!--                <ul class="nav nav-tabs tab-nav-right" role="tablist">-->
<!--                    <li role="presentation" class="active"><a href="#home" data-toggle="tab" aria-expanded="false">--><?//=l('Search Hashtag')?><!-- </a></li>-->
<!--                    <li role="presentation" class=""><a href="#profile" data-toggle="tab" aria-expanded="true">--><?//=l('Add Multi Hashtags')?><!--</a></li>-->
<!--                </ul>-->

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="home">
                        <div class="input-group mb0 formSearchPopup">
                            <span class="input-group-btn" style="display: none;">
<!--                            <span class="input-group-btn">-->
                              <select name="account" class="form-control account" style="min-width: 120px;">
                                <?php if(!empty($accounts)){
                                foreach ($accounts as $row) {
                                ?>
                                  <option value="<?=$row->id?>" <?php if($row->id == $accid){ echo "selected"; }?>><?=$row->username?></option>
                                <?php }}?>
                              </select>
                            </span>
                            <div class="form-line newinput">
                                <input type="text" name="popup_tag" class="form-control popup_tag" placeholder="<?=l('Hashtag')?>">
                            </div>
                            <span class="input-group-btn">
                              <a class="btn bg-dashboard-primary waves-effect btnSearchTags newbutton"><?=l('Search')?></a>
                            </span>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ajax_dataSearchTag">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" align="center" style="margin-top: 20px;">
<!--                                <a href="#home" data-toggle="tab" aria-expanded="false">--><?//=l('Search Hashtag')?><!-- </a>-->
                                <a href="#profile" data-toggle="tab" aria-expanded="true" style="border-bottom: 1px dashed;"><?=l('Add Multi Hashtags')?>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile">
                        <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                            Add multiple hashtags at the same time by using comma as delimiter.
                        </p>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="4" class="form-control no-resize popup_list_tags" placeholder="<?=l('Hashtags')?>"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" align="center" style="margin-top: 20px;">
                                <a href="#home" data-toggle="tab" aria-expanded="false" style="border-bottom: 1px dashed;"><?=l('Search Hashtag')?> </a>
<!--                                <a href="#profile" data-toggle="tab" aria-expanded="true">--><?//=l('Add Multi Hashtags')?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn new-blue waves-effect btnAddTags" style="display: none;text-transform: none !important;"><?=l('Add Hashtag')?></button>
                <button type="button" class="btn bg-grey waves-effect closebtn" data-dismiss="modal" style="text-transform: none !important;"><?=l('Close')?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).on("keyup", ".popup_list_tags", function(){
//          alert(54654);
        $('.btnAddTags').css('display',"block");
        $('.btnAddTags').css('margin',"0 auto");
        $('.closebtn').css('display',"none");

    });
</script>