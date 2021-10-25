<?php
require_once('../../config.php');
if(isset($_GET['vendor_ID']) && $_GET['vendor_ID'] != ""){
    $qry = $conn->query("SELECT * from `vendor` where vendor_ID = '{$_GET['vendor_ID']}' ");
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
<form action="" id="supplier-form">
     <input type="hidden" name="vendor_ID" value="'<?php isset($vendor_ID) ? $vendor_ID :"" ?>'" required>
    <div class="container-fluid">
        <div class="form-group">
            <label for="name" class="control-label">Supplier Name</label>
            <input type="text" name="name" id="name" class="form-control rounded-0" value="<?php isset($name) ? $name :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="company_code" class="control-label">Company Code</label>
            <input type ="text" name="company_code" id="company_code" class="form-control rounded-0" value="<?php isset ($company_code) ? $company_code :"" ?>"required>
        </div>
        <div class="form-group">
            <label for="registration_status" class="control-label">Registration Status</label>
            <select name="registration_status" id="registration_status" class="form-control rounded-0" required>
                <option value="1" <?php echo isset($registration_status) && $registration_status =="" ? "selected": "1" ?> >Approved</option>
                <option value="0" <?php echo isset($registration_status) && $registration_status =="" ? "selected": "0" ?>>Rejected</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email</label>
            <input type="email" name="email" id="email" class="form-control rounded-0" value="<?php isset ($email) ? $email :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="product" class="control-label">Product</label>
            <input type="text" name="product" id="product" class="form-control rounded-0" value="<?php isset ($product) ? $product :"" ?>" required>
        </div>
          <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <input type="text" name="description" id="description" class="form-control rounded-0" value="<?php isset ($description) ? $description :"" ?>" required>
        </div>
    </div>
</form>
<script>
    $(function(){
        $('#supplier-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_supplier",
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