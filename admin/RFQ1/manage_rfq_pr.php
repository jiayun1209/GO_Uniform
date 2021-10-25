<?php
if(isset($_GET['vendor_ID']) && $_GET['vendor_ID'] > 0){
    $qry = $conn->query("SELECT * from `vendor` where vendor_ID = '{$_GET['vendor_ID']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
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
	/* Chrome, Safari, Edge, Opera */
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
		}

		/* Firefox */
		input[type=number] {
		-moz-appearance: textfield;
		}
		[name="tax_percentage"],[name="discount_percentage"]{
			width:5vw;
		}
</style>
<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($rfq_ID) ? "Update RFQ Details": "New RFQ" ?> </h3>
	</div>
	<div class="card-body">
		<form action="" id="po-form">
			<input type="hidden" name ="rfq_ID" value="<?php echo isset($rfq_ID) ? $rfq_ID : '' ?>">
			<div class="row">
				<div class="col-md-6 form-group">
				<label for="vendor_ID">Vendor ID</label>
				<select name="vendor_ID" id="vendor_id" class="custom-select custom-select-sm rounded-0 select2">
						<option value="" disabled <?php echo !isset($vendor_ID) ? "selected" :'' ?>></option>
						<?php 
							$rfq_qry = $conn->query("SELECT * FROM `rfq` order by `name` asc");
							while($row = $rfq_qry->fetch_assoc()):
						?>
						<option value="<?php echo $row['vendor_ID'] ?>" <?php echo isset($vendor_ID) && $vendor_ID== $row['vendor_ID'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="col-md-6 form-group">
					<label for="rfq_ID">RFQ # <span class="po_err_msg text-danger"></span></label>
					<input type="text" class="form-control form-control-sm rounded-0" id="rfq_ID" name="rfq_ID" value="<?php echo isset($rfq_ID) ? $rfq_ID : '' ?>">
					<small><i>Leave this blank to Automatically Generate upon saving.</i></small>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered" id="item-list">
						<colgroup>
							<col width="5%">
							<col width="5%">
							<col width="10%">
							<col width="20%">
							<col width="30%">
							<col width="15%">
							<col width="15%">
						</colgroup>
						<thead>
							<tr class="bg-navy disabled">
								<th class="px-1 py-1 text-center"></th>
								<th class="px-1 py-1 text-center">Material Details</th>
								<th class="px-1 py-1 text-center">Vendor Address</th>
								<th class="px-1 py-1 text-center">Quantity</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if(isset($id)):
							$rfq_qry = $conn->query("SELECT o.*,i.item_name, i.description FROM `purchase_order_details` o inner join item_code i on o.item_code = i.id where o.`po_id` = '$id' ");
							echo $conn->error;
							while($row = $rfq_qry->fetch_assoc()):
							?>
							<tr class="po-item" data-id="">                                 
								<td class="align-middle p-1 text-center">
									<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
								</td>
                                                                     <td class="align-middle p-1">
									<input type="text" class="text-center w-100 border-0" name="material_details[]" value="<?php echo $row['material_details'] ?>"/>
								</td>
								<td class="align-middle p-0 text-center">
									<input type="address" class="text-center w-100 border-0" name="vendor_address[]" value="<?php echo $row['vendor_address'] ?>"/>
								</td>
                                                                <td class="align-middle p-0 text-center">
									<input type="number" class="text-center w-100 border-0" name="quantity_request[]" value="<?php echo $row['quantity_request'] ?>"/>
								</td>
						
							<?php endwhile;endif; ?>
						</tbody>
					</table>
					<div class="row">
						<div class="col-md-6">
							<label for="notes" class="control-label">Remarks</label>
							<textarea name="notes" id="notes" cols="10" rows="4" class="form-control rounded-0"><?php echo isset($notes) ? $notes : '' ?></textarea>
						</div>
						<div class="col-md-6">
							<label for="status" class="control-label">Status</label>
							<select name="status" id="status" class="form-control form-control-sm rounded-0">
								<option value="0" <?php echo isset($status) && $status == 0 ? 'selected': '' ?>>Pending</option>
								<option value="1" <?php echo isset($status) && $status == 1 ? 'selected': '' ?>>Approved</option>
								<option value="2" <?php echo isset($status) && $status == 2 ? 'selected': '' ?>>Denied</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="card-footer">
		<button class="btn btn-flat btn-primary" form="po-form">Save</button>
		<a class="btn btn-flat btn-default" href="?page=purchase_orders">Cancel</a>
	</div>
</div>
<table class="d-none" id="item-clone">
	<tr class="po-item" data-id="">
		<td class="align-middle p-1 text-center">
			<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
		</td>
		<td class="align-middle p-0 text-center">
			<input type="text" class="text-center w-100 border-0" name="material_details[]"/>
		</td>
                <td class="align-middle p-0 text-center">
			<input type="address" class="text-center w-100 border-0" name="vendor_address[]"/>
		</td>
		<td class="align-middle p-1">
			<input type="number" class="text-center w-100 border-0" name="quantity_request[]"/>
		</td>
	</tr>
</table>
<script>
	function rem_item(_this){
		_this.closest('tr').remove()
	}
	$(document).ready(function(){
		$('#add_row').click(function(){
			var tr = $('#item-clone tr').clone()
			$('#item-list tbody').append(tr)
			_autocomplete(tr)
			tr.find('[name="material_details",[name="unit_price[]"]').on('input keypress',function(e){
				calculate()
			})
		})
		if($('#item-list .po-item').length > 0){
			$('#item-list .po-item').each(function(){
				var tr = $(this)
				_autocomplete(tr)
				tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress',function(e){
					calculate()
				})
				$('#item-list tfoot').find('[name="discount_percentage"],[name="tax_percentage"]').on('input keypress',function(e){
					calculate()
				})
				tr.find('[name="qty[]"],[name="unit_price[]"]').trigger('keypress')
			})
		}else{
		$('#add_row').trigger('click')
		}
        $('.select2').select2({placeholder:"Please Select here",width:"relative"})
		$('#po-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			$('.err-msg').remove();
			$('[name="po_no"]').removeClass('border-danger')
			if($('#item-list .po-item').length <= 0){
				alert_toast(" Please add atleast 1 item on the list.",'warning')
				return false;
			}
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_po",
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
						location.href = "./?page=purchase_orders/view_po&id="+resp.id;
					}else if((resp.status == 'failed' || resp.status == 'po_failed') && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: 0 }, "fast");
                            end_loader()
							if(resp.status == 'po_failed'){
								$('[name="po_no"]').addClass('border-danger').focus()
							}
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})

        
	})
</script>