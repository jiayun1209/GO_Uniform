<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
            <h3 class="card-title"><b>List of RFQ</b></h3>
		<div class="card-tools">
                    <a href="?page=RFQ/create_rfq" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Create Quotation</a>
                    <a href="?page=RFQ/approved_rfq" class="btn btn-flat btn-info"><span class="fas fa-envelope"></span> Send RFQ</a>                    
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
                                            <th class="px-1 py-1 text-left">No. </th>
						<th class="px-1 py-1 text-left">Date Created</th>
						<th class="px-1 py-1 text-left">RFQ No.</th>
						<th class="px-1 py-1 text-left">Supplier Name</th>
						<th class="px-1 py-1 text-center">Material Details</th>
						<th class="px-1 py-1 text-right">Total Amount (RM)</th>
						<th class="px-1 py-1 text-center">Status</th>
						<th class="px-1 py-1 text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT q.*, s.name as sname FROM `quotation` q inner join `vendor` s on q.vendor_ID  = s.vendor_ID order by unix_timestamp(q.date_updated) ");
						while($row = $qry->fetch_assoc()):
							$row['item_count'] = $conn->query("SELECT * FROM rfq where rfq_no = '{$row['id']}'")->num_rows;
							$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM rfq where rfq_no = '{$row['id']}'")->fetch_array()['total'];
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
							<td class=""><?php echo $row['q_ID'] ?></td>
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
											echo '<span class="badge badge-danger">Inactive</span>';
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
								  	<a class="dropdown-item" href="?page=RFQ/view_rfq&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item" href="?page=RFQ/manage_rfq&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>				                   
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
			_conf("Are you sure to delete this RFQ permanently?","delete_rfq",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Reservaton Details","RFQ/view_rfq.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.renew_data').click(function(){
			_conf("Are you sure to renew this rent data?","renew_rent",[$(this).attr('data-id')]);
		})
		$('.table th,.table td').addClass('px-1 py-0 align-middle')
		$('.table').dataTable();
	})
	function delete_rfq($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_rfq",
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
