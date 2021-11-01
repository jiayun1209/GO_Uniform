<?php
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] != ""){
    $qry = $conn->query("SELECT * from `events` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}
?>
<style>
    span.select2-selection.select2-selection--single {
        border-radius: 0;
        padding: 0.25rem 0.5rem;
        padding-top: 0.25rem;
        padding-right: 0.5rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        height: auto;
    }
</style>
<form action="" id="event-form">
     <input type="hidden" name="id" value="<?php echo($id) ? $id :"" ?>" readonly>
    <div class="container-fluid">
        <div class="form-group">
            <label for="title" class="control-label">Title</label>
            <input type="text" name="title" id="title" class="form-control rounded-0" value="<?php echo isset($title) ? $title :" " ?>" required>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <input type ="text" name="description" id="description" class="form-control rounded-0" value="<?php echo isset($description) ? $description :" " ?>" required>
        </div>
        
        <div class="form-group">
            <label for="start_date" class="control-label">Start Date</label>
            <input type="text" name="start_date" id="start_date" class="form-control rounded-0" value="<?php echo isset($start_date) ? $start_date :" " ?>" required>
        </div>
        <div class="form-group">
            <label for="end_date" class="control-label">End Date</label>
            <input type="end_date" name="end_date" id="end_date" class="form-control rounded-0" value="<?php echo isset($end_date) ? $end_date :" " ?>" required>
        </div>
        
        <div class="form-group">
            <label for="status" class="control-label">Status</label>
            <select name="status" id="status" class="form-control rounded-0" required>
                <option value="1" <?php echo isset($status) && $status =="" ? "selected": "1" ?> >Active</option>
                <option value="0" <?php echo isset($status) && $status =="" ? "selected": "0" ?>>Block</option>
            </select>
        </div>
    </div>
</form>
<script>
    $(function(){
        $('#event-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_event",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.reload();
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: 0 }, "fast");
                    }else{
						alert_toast("An error occured",'error');
                        console.log(resp)
					}
                    end_loader()
				}
			})
		})
	})
</script>