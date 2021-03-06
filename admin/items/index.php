<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Inventory</h3>
		<div class="card-tools">
			<a id="btn-import" class="btn btn-flat btn-primary">
                <span class="fas fa-file-import"></span>
                Import
                <input id="file-upload" type="file" style="display:none" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
            </a>
			<a id="btn-export" class="btn btn-flat btn-primary">
                <span class="fas fa-file-export"></span>
                Export
            </a>
			<a href="?page=catalog/product_detail" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="15%">
					<col width="15%">
                                        <col width="10%">
                                        <col width="10%">
                                        <col width="15%">
				</colgroup>
				<thead>
					<tr class="bg-navy disabled">
						<th>#</th>
						<th>Date Created</th>
						<th>Item Code</th>
                                                <th>Catalog ID</th>
                                                <th>Item Name</th>
						<th>Description</th>
                                                <th>Quantity on hand</th>
                                                <th>Price per unit</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					$qry = $conn->query("SELECT * from `inventory` order by (`name`) asc ");
					while($row = $qry->fetch_assoc()):
						$row['description'] = html_entity_decode($row['description']);
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                                                        <td><?php echo $row['item_code'] ?></td>
                                                        <td><?php echo $row['catalog_ID'] ?></td>
							<td><?php echo $row['name'] ?></td>
							<td class='truncate-3' title="<?php echo $row['description'] ?>"><?php echo $row['description'] ?></td>
                                                        <td><?php echo $row['quantity'] ?></td>
                                                        <td><?php echo $row['price'] ?></td>
							<td class="text-center">
								<?php if($row['status'] == 1): ?>
									<span class="badge badge-success">Active</span>
								<?php else: ?>
									<span class="badge badge-secondary">Inactive</span>
								<?php endif; ?>
							</td>
							<td align="center">
								 
				                  <a class="btn btn-flat btn-primary" href="?page=catalog/product_detail&id=<?php echo $row['id'] ?>" data-id = "<?php echo $row['id'] ?>" >
                                       View</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script src="../dist/js/xlsx.min.js"></script>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Item permanently?","delete_item",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Create New Item","items/manage_item.php")
		})
		$('.view_data').click(function(){
			uni_modal("<i class='fa fa-info-circle'></i> Item's Details","items/view_details.php?id="+$(this).attr('data-id'),"")
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Edit Item's Details","items/manage_item.php?id="+$(this).attr('data-id'))
		})
		$('.table th,.table td').addClass('px-1 py-0 align-middle')
		$('.table').dataTable();
        
        $("#btn-export").click(function(){
            $.ajax({
                url: _base_url_ + "admin/api/item/getList.php",
                method:"POST",
                dataType:"json",
                error:err=>{
                    console.log(err)
                    alert_toast("An error occured.",'error');
                    end_loader();
                },
                success:function(response){
                    if(response == -1){
                        alert_toast("An error occured.",'error');
                        return;
                    }
                    
                    var itemList = response;
                    
                    var data = itemList.map(function(item, index){
                        var statusArr = ["Inactive", "Active"];
                        return [++index, item["item_code"], item["name"], item["img"], item["description"], item["quantity"], "RM "+item["price"], statusArr[item["status"]], item["catalog_name"], item["catalog_ID"], item["vendor_ID"],item["date_created"]];
                    });
                    
                    var filename = `inventory.xlsx`;
                    var ws_name = "Inventory";
                    
                    data = [["No", "Item Code", "Name", "IMG", "Description", "Quantity", "Price", "Status", "Catalog Name", "Catalog ID","Vendor ID", "Date Created"], ...data];
                    
                    var wb = XLSX.utils.book_new();
                    var ws = XLSX.utils.aoa_to_sheet(data);
                    
                    var wscols = [
                        {wch: 3},
                        {wch: 25},
                        {wch: 25},
                        {wch: 25},
                        {wch: 25},
                        {wch: 25},
                        {wch: 25},
                        {wch: 25},
                        {wch: 25},
                        {wch: 25}
                    ];
                    ws['!cols'] = wscols;
                    
                    XLSX.utils.book_append_sheet(wb, ws, ws_name);
                    XLSX.writeFile(wb, filename);
                }
            })
        });
        
        $("#btn-import").click(function(){
            $("#file-upload")[0].click();
        });
        
        $("#file-upload").on("change", function(e){
            var elFile = this.files[0];

            var reader = new FileReader();
            reader.readAsDataURL(elFile);
            reader.onload = function (){
                e.currentTarget.file = reader.result;
                
                var data = {
                    file: $("#file-upload")[0].file
                }

                $.ajax({
                    url: _base_url_ + "admin/api/item/import.php",
                    method: "POST",
                    data: data,
                    error:err=>{
                        console.log(err);
                        alert_toast("An error occured.",'error');
                        end_loader();
                    },
                    success:function(response){
                        if(response == 1){
                            location.reload();
                        }
                    }
                })
            };
            
            
        });
	})
    
	function delete_item($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_item",
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