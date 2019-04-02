<form class="actionForm" action="<?=cn('ajax_bulk_post')?>">
    <div class="card">
        <div class="header">
            <h2 class="title"><i class="fa fa-paper-plane-o"></i> <?=l("Bulk post")?></h2>
        </div>
        <div class="body" style="padding: 15px;">
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" class="form-control" name="link">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Instagram accounts</label>
                        <select name="account"  class="form-control">
                            <?php if(!empty($result)){
                            foreach ($result as $row) {
                            ?>
                            <option value="<?=$row->id?>"><?=$row->username?></option>
                            <?php }}?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block">Created schedules</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(function(){
        $(document).on('submit', ".actionForm", function(event) {
            event.preventDefault();    
            _that           = $(this);
            _action         = _that.attr("action");
            _data           = _that.serialize();
            _data           = _data + '&' + $.param({token:token});
            $.post(_action, _data, function(result){
                $("input").val("");
                Page.showNotification(result['label'], result['txt'], 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
            },'json');

            return false;
        });
    }); 
</script>