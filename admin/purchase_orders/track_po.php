<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title"><b>Tracking & Monitoring Purchase Orders</b></h3>
        <div class="card-tools">
            <a href="?page=report/view_outstanding" class="btn btn-sm btn btn-flat btn-primary"><span class="fas fa-search"></span>  Outstanding PO Report</a>
            <a href="?page=purchase_orders" class="btn btn-sm btn-flat btn-default" > Back</a>
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
                        <col width="8%">
                        <col width="15%">
                        <col width="10%">
                        <col width="12%">
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
                            <th class="px-1 py-1 text-center">Notify Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT po.*, s.name as sname FROM `purchase_order` po inner join `vendor` s on po.vendor_ID  = s.vendor_ID where status='4' order by unix_timestamp(po.date_updated) ");
                        while ($row = $qry->fetch_assoc()):
                            $row['item_count'] = $conn->query("SELECT * FROM purchase_order_details where po_id = '{$row['id']}'")->num_rows;
                            $row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM purchase_order_details where po_id = '{$row['id']}'")->fetch_array()['total'];
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class=""><?php echo date("d-m-Y H:i", strtotime($row['date_created'])); ?></td>
                                <td class=""><?php echo $row['po_no'] ?></td>
                                <td class="text-left"><?php echo $row['sname'] ?></td>
                                <td class="text-center"><?php echo number_format($row['item_count']) ?></td>
                                <td class="text-right"><?php echo number_format($row['total_amount']) ?></td>
                                <td class="text-center">
                                    <?php
                                    switch ($row['status']) {
                                        case '1':
                                            echo '<span class="badge badge-success text-center">Approved</span>';
                                            break;
                                        case '2':
                                            echo '<span class="badge badge-danger text-center">Rejected</span>';
                                            break;
                                        case '3':
                                            echo '<span class="badge badge-warning text-danger text-center">Cancelled</span>';
                                            break;
                                        case '4':
                                            echo '<span class="badge badge-info text-center">Sent</span>';
                                            break;
                                        case '5':
                                            echo '<span class="badge badge-success text-center">Sent</span>';
                                            break;
                                        default:
                                            echo '<span class="badge badge-secondary text-center">Pending</span>';
                                            break;
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <a class="btn btn-sm btn-flat btn-default" href="?page=purchase_orders/reminder&id=<?php echo $row['id'] ?>"> <span class="fa fa-envelope"></span></a>   
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
    $(document).ready(function () {
        $('.delete_data').click(function () {
            _conf("Are you sure to delete this PO permanently?", "delete_rent", [$(this).attr('data-id')])
        })
        $('.view_details').click(function () {
            uni_modal("Reservaton Details", "purchase_orders/view_details.php?id=" + $(this).attr('data-id'), 'mid-large')
        })
        $('.renew_data').click(function () {
            _conf("Are you sure to renew this rent data?", "renew_rent", [$(this).attr('data-id')]);
        })
        $('.table th,.table td').addClass('px-1 py-0 align-middle')
        $('.table').dataTable();
    })
    function delete_rent($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_po",
            method: "POST",
            data: {id: $id},
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function (resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
    function renew_rent($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=renew_rent",
            method: "POST",
            data: {id: $id},
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function (resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
</script>