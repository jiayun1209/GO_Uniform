<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<style>

    img#cimg{
        height: 15vh;
        width: 15vh;
        object-fit: cover;
        border-radius: 100% 100%;
    }
    img#cimg2{
        height: 50vh;
        width: 100%;
        object-fit: contain;
        /* border-radius: 100% 100%; */
    }


</style>
<div class="col-lg-12">
   <div class="card card-outline card-primary">
        <div class="card-header">
            <h5 class="card-title">General Settings</h5>
            <!-- <div class="card-tools">
                    <a class="btn btn-block btn-sm btn-default btn-flat border-primary new_department" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
            </div> -->
        </div>
        <div class="card-body">
            <form action="" id="general-setting">
                <div id="msg" class="form-group"></div>
                <div class="form-group">
                    <label for="pwd_min" class="control-label">Password Minimum Length</label>
                    <input type="number" class="form-control form-control-sm" name="pwd_min" id="name" value="<?php echo $_settings->info('pwd_min') ?>">
                </div>

                <div class="form-group">
                    <label for="theme_colour" class="control-label">Theme Colour</label>
                    <select class="form-control" id="theme_colour" name="theme_colour">
                        <option value="800000">Maroon</option>
                        <option value="8B0000">Dark Red</option>
                        <option value="A52A2A">Brown</option>
                        <option value="FF0000">Red</option>
                        <option value="FF6347">Tomato</option>
                        <option value="FF7F50">Coral</option>
                        <option value="CD5C5C">Indian Red</option>
                        <option value="F08080">Light Coral</option>
                        <option value="E9967A">Dark Salmon</option>
                        <option value="FA8072">Salmon</option>
                        <option value="FFA07A">Light Salmon</option>
                        <option value="FF4500">Orange Red</option>
                        <option value="FF8C00">Dark Orange</option>
                        <option value="FFA500">Orange</option>
                        <option value="FFD700">Gold</option>
                        <option value="B8860B">Dark Golden Rod</option>
                    </select>
                </div>
        </div>
        </form>
    </div>
    <div class="card-footer">
        <div class="col-md-12">
            <div class="row">
                <button class="btn btn-sm btn-primary" form="general-setting">Update</button>
            </div>
        </div>
    </div>

</div>
</div>
<script>   
    $(document).ready(function () {
        $('#general-setting').submit(function(e){
		e.preventDefault();
		start_loader();
		if($('.err_msg').length > 0){
                    $('.err_msg').remove();
                }
			
		$.ajax({
			url:_base_url_+'classes/GeneralSettings.php?f=update_settings',
			data: new FormData($(this)[0]),
                        cache: false,
                        contentType: false,
                        processData: false,
                        method: 'POST',
                        type: 'POST',
			success:function(resp){
				if(resp == 1){
					// alert_toast("Data successfully saved",'success')
                                    location.reload()
				}
                                else{
					$('#msg').html('<div class="alert alert-danger err_msg">An Error occured</div>')
					end_load()
				}
			}
		})
	})
        
        $("#theme_colour").val("<?php echo $_settings->info('theme_colour') ?>");
    })
</script>