<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
    <div class="card-header">

            <h3 class="card-title">Reporting</h3>
            <div class="card-tools">
            
            <a class="btn btn-sm btn-flat btn-default" href="?page=report/report_list">Back</a>
        </div>
    </div>
    <div class="card-body">
            <div class="container-fluid">
    <div class="container-fluid">
                    <table class="table table-hover table-striped">
                            <colgroup>
                                <col width="5">
                                <col width="15">
                                <col width="55%">
                                <col width="15%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr class="bg-navy disabled">
                                    <th>NO.</th>
                                    <th>PO. No</th>
                                    <th>Supplier Name</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $i = 1;
                                    $qry = $conn->query("SELECT po.*, s.name as sname FROM `purchase_order` po inner join `vendor` s on po.vendor_ID  = s.vendor_ID order by unix_timestamp(po.date_updated) ");
                                    while($row = $qry->fetch_assoc()):												
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td class=""><?php echo $row['po_no'] ?></td>
                                        <td class=""><?php echo $row['sname'] ?></td>
                                        <td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
                                        <td align="center">
                                        <a class="dropdown-item" href=  "?page=report/view_details&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
                                        
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