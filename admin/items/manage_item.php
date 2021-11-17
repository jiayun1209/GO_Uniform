<?php
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `inventory` where id = '{$_GET['id']}' ");
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
<form action="" id="item-form">
     <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
    <div class="container-fluid">
        <div class="form-group">
            <label for="item_code" class="control-label">Item Code</label>
            <input type="text" name="item_code" id="item_code" class="form-control rounded-0" value="<?php echo isset($item_code) ? $item_code :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="catalog_ID" class="control-label">Catalog_ID</label>
            <select name="catalog_ID" id="catalog_ID" class="form-control rounded-0" required>
                <option value="" disabled <?php echo !isset($catalog_ID) ? "selected": "" ?> >Catalog</option>
                <?php 
							$cat_qry = $conn->query("SELECT * FROM `catalog`");
							while($row = $cat_qry->fetch_assoc()):
						?>
						<option value="<?php echo $row['id'] ?>" <?php echo isset($id) && $id == $row['id'] ? 'selected' : '' ?>><?php echo $row['description'] ?></option>
						<?php endwhile; ?>
					</select>
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Item Name</label>
            <input type="text" name="name" id="name" class="form-control rounded-0" value="<?php echo isset($name) ? $name :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <textarea rows="3" name="description" id="description" class="form-control rounded-0" required><?php echo isset($description) ? $description :"" ?></textarea>
        </div>
        <div class="form-group">
            <label for="quantity" class="control-label">Quantity on hand</label>
            <input type="text" name="quantity" id="quantity" class="form-control rounded-0" value="<?php echo isset($quantity) ? $quantity :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="price" class="control-label">Price per unit</label>
            <input type="text" name="price" id="price" class="form-control rounded-0" value="<?php echo isset($price) ? $price :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="status" class="control-label">Status</label>
            <select name="status" id="status" class="form-control rounded-0" required>
                <option value="1" <?php echo isset($status) && $status =="" ? "selected": "1" ?> >Active</option>
                <option value="0" <?php echo isset($status) && $status =="" ? "selected": "0" ?>>Inactive</option>
            </select>
        </div>
    </div>
</form>
<script>
    $(function(){
        $('#item-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_item",
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