<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Request for Quotataion</h3>
        <div class="card-tools">
            <a href="?page=rfq/manage_rfq" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>Create New</a>
            <a href="?page=rfq/manage_rfq_pr" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>Create New with PR</a>
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
                            <th>#</th>
                            <th>Date Created</th>
                            <th>RFQ #</th>
                            <th>Supplier ID</th>
                            <th>Material Details</th>
                            <th>Quantity Request</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT r.*, s.name as sname FROM `rfq` r inner join `vendor` s on r.vendor_ID  = s.vendor_ID");
                        while ($row = $qry->fetch_assoc()):       
                            $row['total_amount'] = $conn->query("SELECT sum(quantity_request * unit_price) as total FROM rfq where rfq_ID = '{$row['rfq_ID']}'")->fetch_array()['total'];
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class=""><?php echo date("M d,Y H:i", strtotime($row['date_created'])); ?></td>
                                <td class=""><?php echo $row['rfq_ID'] ?></td>
                                <td class=""><?php echo $row['vendor_ID'] ?></td>
                                <td class=""><?php echo $row['material_details'] ?></td>
                                <td class=""><?php echo $row['quantity_request'] ?></td>
                                <td class=""><?php echo $row['unit_price'] ?></td>
                                <td class="text-right"><?php echo number_format($row['total_amount']) ?></td>
                                <td>
                                    <?php
                                    switch ($row['status']) {
                                        case '1':
                                            echo '<span class="badge badge-success">Approved</span>';
                                            break;
                                        case '2':
                                            echo '<span class="badge badge-danger">Denied</span>';
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
                                        <a class="dropdown-item" href="?page=RFQ/view_rfq&rfq_ID=<?php echo $row['rfq_ID'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="?page=RFQ/manage_rfq&rfq_ID=<?php echo $row['rfq_ID'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="'<?php echo $row['rfq_ID'] ?>'"><span class="fa fa-trash text-danger"></span> Delete</a>
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
            $('.delete_data').click(function () {
    _conf("Are you sure to delete this RFQ permanently?", "delete_rfq", [$(this).attr('data-id')])
    })
            $('#create_new').click(function () {
    uni_modal("<i class='fa fa-plus'></i> Create New RFQ", "RFQ/manage_rfq.php")
    })
            $('#create_new_withpr').click(function () {
    uni_modal("<i class='fa fa-plus'></i> Create New RFQ", "RFQ/manage_rfq_pr.php")
    })
            $('.view_data').click(function () {
    uni_modal("<i class='fa fa-info-circle'></i> RFQ's Details", "RFQ/view_rfq.php?rfq_ID=" + $(this).attr('data-id'), "")
    })
            $('.edit_data').click(function () {
    uni_modal("<i class='fa fa-edit'></i> Edit RFQ's Details", "RFQ/manage_rfq.php?rfq_ID=" + $(this).attr('data-id'))
    })
            $('.table th,.table td').addClass('px-1 py-0 align-middle')
            $('.table').dataTable();
    })
            function delete_rfq($id){
            start_loader();
            $.ajax({
            url:_base_url_ + "classes/Master.php?f=delete_rfq",
                    method:"POST",
                    data:{id: $id},
                    dataType:"json",
                    error:err => {
                    console.log(err)
                            alert_toast("An error occured.", 'error');
                    end_loader();
                    },
                    success:function(resp){
                    if (typeof resp == 'object' && resp.status == 'success'){
                    location.reload();
                    } else{
                    alert_toast("An error occured.", 'error');
                    end_loader();
                    }
                    }
            })
            }
    /*function renew_rent($id){
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
     }*/
</script>