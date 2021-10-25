<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
    <div class="card-header">

            <h3 class="card-title">List of Reports</h3>
            <div class="card-tools">
		<a href="?page=report/view_PO_details" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  test New</a>
            </div>
            
    </div>
    <div class="card-body">
            <div class="container-fluid">
    <div class="container-fluid">
                    <table class="table table-hover table-striped">
                            <colgroup>
                                    <col width="5%">
                                    <col width="85%">
                                    <col width="10%">
                            </colgroup>
                            <thead>
                                    <tr class="bg-navy disabled">
                                            <th>No.</th>
                                            <th>Report</th>
                                            <th>Action</th>
                                    </tr>
                            </thead>
                            <tbody>
                                    <?php 
                                    $i = 1;
                                    ?>
                                            <tr>
                                                    <td class="text-center"><?php echo $i++; ?></td>
                                                    <td class="">Purchase Order Details Report</td>
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

                                            <tr>
                                                    <td class="text-center"><?php echo $i++; ?></td>
                                                    <td class="">Cancelled Purchase Order Report</td>
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

                                            <tr>
                                                    <td class="text-center"><?php echo $i++; ?></td>
                                                    <td class="">Purchase Order Outstanding Report</td>
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

                                            <tr>
                                                    <td class="text-center"><?php echo $i++; ?></td>
                                                    <td class="">Purchase Quotation Comparison Report</td>
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

                                            <tr>
                                                    <td class="text-center"><?php echo $i++; ?></td>
                                                    <td class="">Total Purchase by Vendor Analysis Report</td>
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

                                            <tr>
                                                    <td class="text-center"><?php echo $i++; ?></td>
                                                    <td class="">Supplier Performance Rating Report</td>
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

                                            <tr>
                                                    <td class="text-center"><?php echo $i++; ?></td>
                                                    <td class="">Supplier Price Performance Analysis Report</td>
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

                                            <tr>
                                                    <td class="text-center"><?php echo $i++; ?></td>
                                                    <td class="">Supplier Purchase Summary Report</td>
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

                                            <tr>
                                                    <td class="text-center"><?php echo $i++; ?></td>
                                                    <td class="">Supplier Approved List</td>
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

                                            <tr>
                                                    <td class="text-center"><?php echo $i++; ?></td>
                                                    <td class="">PR Report</td>
                                                    <td align="center">
                                                             <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                            Action
                                                <span class="sr-only">Toggle Dropdown</span>
                                              </button>
                                              <div class="dropdown-menu" role="menu">
                                                                    <a class="dropdown-item" href="?page=purchase_orders/view_po&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
                                                <div class="dropdown-divider"></div>
<!--				                    <a class="dropdown-item" href="?page=purchase_orders/manage_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>-->
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                              </div>
                                                    </td>
                                            </tr>

                                    <?php; ?>
                            </tbody>
                    </table>
            </div>
            </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this rent permanently?","delete_rent",[$(this).attr('data-id')])
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
			url:_base_url_+"classes/Master.php?f=delete_rent",
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