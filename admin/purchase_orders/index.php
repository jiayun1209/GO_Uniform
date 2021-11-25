<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
            <h3 class="card-title"><b>List of Purchase Orders</b></h3>
		<div class="card-tools">
                    <a href="?page=purchase_orders/create_po" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create Standard PO</a>
                    <a href="?page=purchase_orders/create_recurring_po" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create Recurring PO</a>
                    <a href="?page=purchase_orders/approved_po_list" class="btn btn-flat btn-info"><span class="fas fa-envelope"></span>  Send PO</a>
                    <a href="?page=purchase_orders/track_po" class="btn btn-flat btn-success"><span class="fas fa-search"></span>  Track PO</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="20%">
					<col width="10%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr class="bg-navy disabled">
						<th class="px-1 py-1 text-center">No.</th>
						<th class="px-1 py-1 text-left">Date Created</th>
						<th class="px-1 py-1 text-left">PO No.</th>
						<th class="px-1 py-1 text-left">Supplier Name</th>
						<th class="px-1 py-1 text-center">Items</th>
						<th class="px-1 py-1 text-right">Total Amount (RM)</th>
						<th class="px-1 py-1 text-center">Status</th>
						<th class="px-1 py-1 text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT po.*, s.name as sname FROM `purchase_order` po inner join `vendor` s on po.vendor_ID  = s.vendor_ID order by unix_timestamp(po.date_updated) ");
						while($row = $qry->fetch_assoc()):
							$row['item_count'] = $conn->query("SELECT * FROM purchase_order_details where po_id = '{$row['id']}'")->num_rows;
							$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM purchase_order_details where po_id = '{$row['id']}'")->fetch_array()['total'];
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
							<td class=""><?php echo $row['po_no'] ?></td>
							<td class="text-left"><?php echo $row['sname'] ?></td>
							<td class="text-center"><?php echo number_format($row['item_count']) ?></td>
							<td class="text-right"><?php echo number_format($row['total_amount']) ?></td>
							<td class="text-center">
								<?php 
									switch ($row['status']) {
										case '1':
											echo '<span class="badge badge-success">Approved</span>';
											break;
										case '2':
											echo '<span class="badge badge-danger">Rejected</span>';
											break;
                                                                                case '3':
											echo '<span class="badge badge-warning text-danger">Cancelled</span>';
											break;
										default:
											echo '<span class="badge badge-secondary">Pending</span>';
											break;
									}
								?>
							</td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
								  	<a class="dropdown-item" href="?page=purchase_orders/view_po&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item" href="?page=purchase_orders/manage_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this PO permanently?","delete_rent",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Reservaton Details","purchase_orders/view_details.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.renew_data').click(function(){
			_conf("Are you sure to renew this rent data?","renew_rent",[$(this).attr('data-id')]);
		})
		$('.table th,.table td').addClass('px-1 py-0 align-middle')
		$('.table').dataTable();
	})
	function delete_rent($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_po",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
	function renew_rent($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=renew_rent",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
