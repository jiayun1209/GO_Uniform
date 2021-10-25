<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">List of RFQ</h3>
        <div class="card-tools">
            <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>Create New</a>
            <a href="javascript:void(0)" id="create_new_withpr" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>Create New with PR</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-hover table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled">
                            <th>#</th>
                            <th>Date Created</th>
                            <th>PR ID</th>
                            <th>Vendor ID</th>
                            <th>Material Details</th>
                            <th>Deadline</th>
                            <th>Vendor Address</th>
                            <th>Quantity Request</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT * from `rfq` order by (`rfq_ID`) asc ");
                        while ($row = $qry->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                                <td><?php echo $row['pr_ID'] ?></td>
                                 <td><?php echo $row['vendor_ID'] ?></td>
                                <td><?php echo $row['material_details'] ?></td>
                                <td><?php echo $row['deadline'] ?></td>
                                <td class='truncate-3' title="<?php echo $row['vendor_address'] ?>"><?php echo $row['vendor_address'] ?></td>
                                <td><?php echo $row['quantity_request'] ?></td>
                                <td class="text-center">
                                    <?php if ($row['status'] == 1): ?>
                                        <span class="badge badge-success">Approve</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Pending</span>
                                    <?php endif; ?>
                                </td>

                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon py-0" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item view_data" href="javascript:void(0)" data-rfq_ID = "<?php echo $row['rfq_ID'] ?>"><span class="fa fa-info text-primary"></span> View</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item edit_data" href="javascript:void(0)" data-rfq_ID = "<?php echo $row['rfq_ID'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-rfq_ID="'<?php echo $row['rfq_ID'] ?>'"><span class="fa fa-trash text-danger"></span> Delete</a>
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
    $(document).ready(function () {
        $('.delete_data').click(function () {
            _conf("Are you sure to delete this RFQ permanently?", "delete_rfq", [$(this).attr('data-rfq_ID')])
        })
        $('#create_new').click(function () {
            uni_modal("<i class='fa fa-plus'></i> Create New RFQ", "RFQ/manage_rfq.php")
        })
        $('#create_new_withpr').click(function () {
            uni_modal("<i class='fa fa-plus'></i> Create New RFQ", "RFQ/manage_rfq_pr.php")
        })
        $('.view_data').click(function () {
            uni_modal("<i class='fa fa-info-circle'></i> RFQ's Details", "RFQ/view_details.php?rfq_ID=" + $(this).attr('data-rfq_ID'), "")
        })
        $('.edit_data').click(function () {
            uni_modal("<i class='fa fa-edit'></i> Edit RFQ's Details", "RFQ/manage_rfq.php?rfq_ID=" + $(this).attr('data-rfq_ID'))
        })
        $('.table th,.table td').addClass('px-1 py-0 align-middle')
        $('.table').dataTable();
    })
    function delete_rfq($rfq_ID) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_rfq",
            method: "POST",
            data: {rfq_ID: $rfq_ID},
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