<div class="modal fade" id="PopupAddLocations" tabindex="-1" role="dialog" style="background-color: #0009;">
    <div class="modal-dialog" role="document">
        <form class="location">
            <div class="modal-content">
                <div class="modal-header new-grey">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="defaultModalLabel"><?=l('Add Locations')?></h4>
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
                        <div class="form-line" style="width: 95%;height: 40px !important;padding: 3px 10px !important;">
                            <input type="text" name="popup_location" class="form-control popup_location" placeholder="<?=l('Enter location name')?>">
                        </div>
                        <span class="input-group-btn">
                          <a class="btn bg-dashboard-primary waves-effect btnSearchLocations" style="height: 40px !important; border-radius: 4px !important; margin-top: -5px !important;padding: 10px !important;color: #fff;"><?=l('Search')?></a>
                        </span>
                    </div>
                    <div class="row">
<!--                        <div class="col-md-12 newloc" style="display: none;">-->
                        <div class="col-md-12 newloc">
                            <div id="map_canvas" class="map_canvas" style="width: 100%; height: 250px;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input name="formatted_address" type="hidden" value="">
                            <input name="lat" type="hidden" value="">
                            <input name="lng" type="hidden" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ajax_dataSearchLocation">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn new-blue waves-effect btnAddLocations" style="display: none;"><?=l('Add Locations')?></button>
                    <button type="button" class="btn bg-grey waves-effect closebtn" data-dismiss="modal"><?=l('Close')?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        var options = {
            details: "form.location",
            map: ".map_canvas"
        };
//        $('.newloc').css('display','block');
        setTimeout(function(){
            $(".popup_location").geocomplete(options).bind("geocode:result", function(event, result){});
        },1000);

        $(".btnSearchLocations").click(function(){
            $("#geocomplete").trigger("geocode");
            $(window).resize();
        });

    });

</script>

